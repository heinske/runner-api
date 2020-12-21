#!/bin/bash
cd /var/www/html 
php composer.phar install 
php artisan migrate 
php-fpm