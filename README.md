## Installation guide

1. Clone this repo
2. Copy .env.example to .env
3. Install php dependencies
````
composer install
````
4. Run docker (it will install all packages)
````
docker-compose up -d
````
5. Go into app container
````
docker exec -it cars_app bash
````
6. Generate app key
````
php artisan key:generate
````
7. Run migrations
````
php artisan migrate --seed
````

## Documentation

To generate documentation run inside docker container
````
php artisan l5-swagger:generate
````
and go to http://{APP_URL}/api/documentation
