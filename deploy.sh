#!/bin/bash
set -e

echo "1. php artisan down"
echo "2. git pull origin main"
echo "3. composer install --optimize-autoloader --no-dev"
echo "4. php artisan migrate --force"
echo "5. php artisan config:cache"
echo "6. php artisan route:cache"
echo "7. php artisan up"