
DOCKER-COMPOSE-FILE-DEV="docker/docker-compose-dev.yml"

###########
### RUN ###
###########
initial-setup: build-php-fpm-dev composer_install

print-products:
	docker-compose -f $(DOCKER-COMPOSE-FILE-DEV) run --rm ws-php php src/entrypoint.php

run:
	docker-compose -f $(DOCKER-COMPOSE-FILE-DEV) run --rm ws-php sh

php-sh:
	docker-compose -f $(DOCKER-COMPOSE-FILE-DEV) exec ws-php sh


############
### LOGS ###
############
logs:
	docker-compose -f $(DOCKER-COMPOSE-FILE-DEV) logs


#############
### BUILD ###
#############

build-php-fpm-dev:
	docker build -f docker/php-fpm/Dockerfile . \
	--target DEV \
	-t private/wholesaler/php-fpm-dev:latest

composer_install:
	docker-compose -f $(DOCKER-COMPOSE-FILE-DEV) run --rm ws-php sh -c "composer install"


######################
### TESTS/ANALYSIS ###
######################
.PHONY: tests
tests:
	docker-compose -f $(DOCKER-COMPOSE-FILE-DEV) run --rm ws-php sh -c "composer tests"

code-style:
	docker-compose -f $(DOCKER-COMPOSE-FILE-DEV) run --rm ws-php sh -c "composer code-style"

phpcbf:
	docker-compose -f $(DOCKER-COMPOSE-FILE-DEV) run --rm ws-php sh -c "composer phpcbf"