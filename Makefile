DOCKER_COMPOSE := docker-compose -p cart

fr:
	docker-compose build
	docker-compose up -d
php:
	docker-compose exec cart sh
run:
	docker-compose up -d
stop:
	docker-compose down
restart:
	docker-compose restart cart
phpunit: apps/cart/vendor/bin/phpunit
	$(DOCKER_COMPOSE) exec cart php -n -d memory_linit=-1 vendor/bin/phpunit $(path) -c phpunit.xml $(params)
