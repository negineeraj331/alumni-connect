#!/usr/bin/env bash
# Exit on error
set -e

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
# Only run migrations if we are in production and DB is available
php artisan migrate --force

echo "Build completed successfully!"
