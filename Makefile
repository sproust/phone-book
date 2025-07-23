PROJECT_NAME := phone-book
COMPOSE_FILE := .docker/docker-compose.yml

up:
	docker compose -f $(COMPOSE_FILE) -p $(PROJECT_NAME) up -d --remove-orphans

up\:build:
	docker compose -f $(COMPOSE_FILE) -p $(PROJECT_NAME) up --build -d --remove-orphans

down:
	docker compose -f $(COMPOSE_FILE) -p $(PROJECT_NAME) down

exec\:php:
	docker compose -f $(COMPOSE_FILE) -p $(PROJECT_NAME) exec php bash

init:
	docker compose -f $(COMPOSE_FILE) -p $(PROJECT_NAME) exec php composer install --ansi

diff:
	docker compose -f $(COMPOSE_FILE) -p $(PROJECT_NAME) exec php php bin/console doctrine:schema:drop --force --full-database
	docker compose -f $(COMPOSE_FILE) -p $(PROJECT_NAME) exec php php bin/console doctrine:migrations:migrate --allow-no-migration --no-interaction
	docker compose -f $(COMPOSE_FILE) -p $(PROJECT_NAME) exec php php bin/console doctrine:migrations:diff --allow-empty-diff
	git add migrations/*
	make init