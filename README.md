# Shop

## Laravel Installation

- run  `composer install`
- change the permission of storage by running `chmod -R 775 ./storage`
- change the nome of the corresponding `docker-compose.yml` file
- specify your database password in `docker-compose.yml` and run `docker-compose up -d`
> NOTE: you can use sail for local installation
- connect to postgresql container via `docker exec -it shop_postgres sh` and connect to database with `psql`
- install extension: `CREATE EXTENSION IF NOT EXISTS "uuid-ossp";`
- connect to laravel container via `docker exec -it shop_laravel sh` 
  - install passport `php artisan passport:keys && php artisan passport:install`
  - migrate your database with `php artisan migrate`
  - create a storage symlink with `php artisan storage:link`


- https://api.goose47.live
- https://admin.goose47.live
- https://customer.goose47.live
