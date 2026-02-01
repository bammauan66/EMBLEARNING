#!/bin/bash

# This script runs during Vercel build phase
echo "Running Vercel build script..."

# Install dependencies
composer install --no-dev --optimize-autoloader

# Run migrations and seed
php artisan migrate --force
php artisan db:seed --force --class=DatabaseSeeder

echo "Build complete!"
