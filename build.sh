#!/usr/bin/env bash
# Exit on error
set -e

echo "Ensuring a valid APP_KEY..."
# Laravel needs a base64:-prefixed 32-byte key. Render's generateValue does NOT
# add that prefix, so we set APP_KEY as a dashboard secret. If it's missing,
# generate a temporary one here so the app still boots (set a permanent key in
# the dashboard to keep sessions valid across deploys).
if ! printf '%s' "${APP_KEY:-}" | grep -q '^base64:'; then
  echo "  APP_KEY missing/invalid; generating a temporary key."
  touch .env
  grep -q '^APP_KEY=' .env && sed -i 's#^APP_KEY=.*#APP_KEY=base64:'"$(openssl rand -base64 32)"'#' .env \
    || echo "APP_KEY=base64:$(openssl rand -base64 32)" >> .env
fi

echo "Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

echo "Installing Node dependencies..."
npm install

echo "Building frontend assets..."
npm run build

echo "Clearing application cache..."
php artisan optimize:clear
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache

echo "Running migrations..."
php artisan migrate --force

echo "Seeding roles (idempotent)..."
# RoleSeeder uses firstOrCreate, so this is safe to run on every deploy.
# The app depends on these roles existing (registration, role checks, dashboards).
php artisan db:seed --class=RoleSeeder --force

echo "Linking public storage..."
php artisan storage:link || true

echo "Build completed successfully!"
