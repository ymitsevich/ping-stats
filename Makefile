DOCKER_COMPOSE = docker compose

.PHONY: build-dev build-prod init composer dev prod test
build-dev:
	$(DOCKER_COMPOSE) -f docker-compose.dev.yml build

build-prod:
	$(DOCKER_COMPOSE) -f docker-compose.prod.yml build

init:
	$(DOCKER_COMPOSE) -f docker-compose.dev.yml run --rm app bin/console doctrine:database:create
	$(DOCKER_COMPOSE) -f docker-compose.dev.yml run --rm app bin/console doctrine:migrations:migrate -n

composer:
	$(DOCKER_COMPOSE) -f docker-compose.dev.yml run --rm app composer install --no-interaction --no-progress --optimize-autoloader

dev:
	$(DOCKER_COMPOSE) -f docker-compose.dev.yml run --rm app bin/console run:monitor

prod:
	$(DOCKER_COMPOSE) -f docker-compose.prod.yml run --rm app bin/console run:monitor

test:
	$(DOCKER_COMPOSE) -f docker-compose.dev.yml run --rm app vendor/bin/phpunit
