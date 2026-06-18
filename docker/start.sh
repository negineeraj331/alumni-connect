#!/usr/bin/env bash
# Container entrypoint: prepare the app with the runtime environment, then serve.
set -e

cd /var/www/html

# Ensure a valid Laravel APP_KEY. Render's generateValue lacks the base64: prefix
# Laravel needs, so APP_KEY is a dashboard secret; if it's unset/invalid we mint a
# temporary one so the app still boots (set a permanent key to keep sessions valid).
if ! printf '%s' "${APP_KEY:-}" | grep -q '^base64:'; then
  echo "==> APP_KEY missing/invalid; generating a temporary key for this run."
  export APP_KEY="base64:$(php -r 'echo base64_encode(random_bytes(32));')"
fi

# composer install ran with --no-scripts; regenerate the package manifest now.
php artisan package:discover --ansi || true

# Rebuild caches against the runtime environment.
php artisan optimize:clear || true
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Database: apply pending migrations and seed roles + demo accounts.
# DatabaseSeeder runs RoleSeeder then SampleDataSeeder; both are idempotent
# (firstOrCreate), so this is safe to run on every container start.
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link || true

# Bind Apache to the port Render assigns (defaults to 80 locally).
: "${PORT:=80}"
sed -ri "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/\*:80>/*:${PORT}>/" /etc/apache2/sites-available/000-default.conf

echo "==> Starting Apache on port ${PORT}"
exec apache2-foreground
