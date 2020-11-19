#!/bin/bash

cd /var/www/LaravelMarket
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
composer update
