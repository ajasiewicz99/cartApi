# Cart-api
## Add to your host file:
```text
127.0.0.1 cart.local
```
## Make sure you have installed docker
### Run following commands:
```text
make fr
make php
composer install
php artisan migrate
php artisan db:seed --class=ProductsSeeder
```
If already installed
```text
make run #for run application
make stop #for stop application
make restart #for restart cart container
```
Unit tests:
```text
make phpunit
```
###PhpMyAdmin
http://cart.local:81
###App
http://cart.local
