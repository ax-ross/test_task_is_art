# test_task_is_art

Для запуска:

docker-compose up -d

docker-compose exec app composer install

docker-comoose exec app php artisan migrate

docker-compose exec app php artisan db:seed
