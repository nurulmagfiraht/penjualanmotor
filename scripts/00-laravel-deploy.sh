#!/usr/bin/env bash
echo "Running composer"
composer global require hirak/prestissimo
composer install --no-dev --working-dir=/var/www/html

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

echo "Running seeder..."
php artisan db:seed

echo "Running optimize..."
php artisan optimize

echo "Running dir permission..."
su 
chmod 775 /var/www/html/storage/logs/laravel.log
exit
