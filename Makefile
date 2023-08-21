# Docker
init:
	docker-compose up -d --build
	docker-compose exec app composer install
	docker-compose exec app cp .env.example .env
	docker-compose exec app php artisan key:generate
	docker-compose exec app php artisan migrate:fresh --seed

up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose build

app:
	docker-compose exec app bash

# laravel
sanctum:
	docker-compose exec app composer require laravel/sanctum
	docker-compose exec app php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

route:
	docker-compose exec app php artisan route:list

seed:
    docker-compose exec app php artisan db:seed

# DB
# db:
#     docker-compose exec db bash
# 		mysql -u $MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE