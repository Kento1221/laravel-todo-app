MAKEFLAGS += --silent

ifneq (,$(wildcard ./.env))
    include .env
    export
endif

SHELL := /bin/bash

COMPOSER_CONTAINER := php-apache
NODE_CONTAINER := node

.PHONY: up
up: ##@Stack Start all containers defined in docker-compose.yml
	docker-compose up -d

.PHONY: down
down: ##@Stack Stops and removes all running containers
	docker-compose down

.PHONY: tty
tty: ##@System Open shell console
	docker-compose exec \
		 $(COMPOSER_CONTAINER) \
			/bin/bash

.PHONY: install
install: laravel-todo-app/composer.json \
			laravel-todo-app/package.json
install: ##@Application Install composer dependencies
	docker-compose \
	  run --rm --no-deps $(COMPOSER_CONTAINER)\
	    composer install --no-interaction --no-progress --prefer-dist \
	&& docker-compose \
	  run --rm --no-deps $(NODE_CONTAINER)\
	    npm install

.PHONY: update
update: laravel-todo-app/composer.lock \
			laravel-todo-app/package-lock.json
update: ##@Application Update composer dependencies
	docker-compose \
	  run --rm --no-deps $(COMPOSER_CONTAINER) \
	    composer update --no-interaction --no-progress --prefer-dist \
	&& docker-compose \
	  run --rm --no-deps $(NODE_CONTAINER) \
	    npm update