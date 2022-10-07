
# Makefile
build-and-serve:
	@eval $(ssh-agent); docker run --rm --interactive --tty \
		--volume ${PWD}:/app \
  		--volume ${SSH_AUTH_SOCK}:/ssh-auth.sock \
  		--env SSH_AUTH_SOCK=/ssh-auth.sock \
  		composer:2.3.10 composer install --ignore-platform-reqs --no-scripts && \
	cp .env.example .env && \
  	docker-compose -f ./docker-compose.yaml up --build --remove-orphans

serve:
	@docker-compose -f ./docker-compose.yaml up

shell:
	@docker-compose -f ./docker-compose.yaml exec api bash

db_update:
	@docker-compose -f ./docker-compose.yaml exec -T api sh -c "php artisan migrate && php artisan db:seed"

all-tests:
	@docker-compose -f ./docker-compose.yaml exec -T api sh -c "./vendor/bin/phpunit -d memory_limit=-1"

key-generate:
	@docker-compose -f ./docker-compose.yaml exec -T api sh -c "php artisan key:generate"

test:
	@docker-compose -f ./docker-compose.yaml exec -T api sh -c "vendor/bin/phpunit --filter $(filter-out $@, $(MAKECMDGOALS))"







