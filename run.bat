docker-compose exec --user devilbox php  /bin/sh -c "mysql -u root -h 127.0.0.1 -proot -e 'CREATE DATABASE IF NOT EXISTS '${MYSQL_DATABASE}';'"
docker-compose exec --user devilbox php  /bin/sh -c "composer install --working-dir=/shared/httpd/test/htdocs;"
docker-compose exec --user devilbox php  /bin/sh -c "php /shared/httpd/test/htdocs/artisan migrate:fresh --seed"
