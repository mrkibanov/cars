## Installation guide

1. Clone this repo
2. Copy .env.example to .env
3. Run docker (it will install all packages)
````
sail up -d
````
4. Install php dependencies
````
sail composer install
````
5. Generate app key
````
sail php artisan key:generate
````
6. Generate JWT secret
````
sail php artisan jwt:secret
````
7. Run migrations
````
sail php artisan migrate --seed
````
8. Optimize files
````
sail php artisan optimize
````

## Documentation

To generate documentation run inside docker container
````
sail php artisan l5-swagger:generate
````
and go to [http://localhost/api/documentation](http://localhost/api/documentation)
