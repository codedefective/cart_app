#!/bin/sh
#
#
cp /shared/httpd/test/htdocs/.env.example /shared/httpd/test/htdocs/.env
composer install --working-dir=/shared/httpd/test/htdocs
mysql -u root -h 112.13.138.12 -proot -e "CREATE DATABASE IF NOT EXISTS products"
php /shared/httpd/test/htdocs/artisan migrate:fresh --seed
