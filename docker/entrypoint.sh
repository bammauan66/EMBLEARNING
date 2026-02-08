#!/bin/bash

# Exit on error
set -e

# Turn on bash's job control
set -m

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Clear and Cache config
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Start Apache in foreground
echo "Starting Apache..."
exec apache2-foreground
