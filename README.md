# Wholesaler Integration 

Requirements: 
 - GNU make
 - Docker 19.03.0+ 
 - Docker Compose, 

## Infrastructure
 - `Docker Compose` is used to manage the containers

 - `PHP` version 7.4 running on Alpine

 - `Xdebug` is running on port 9003 (additional config in docker/php-fpm/dev.xdebug.ini)

## Application
 - PHPUnit for tests

 - PHPCS for static analysis using PSR-12

## Running the application
GNU `make` is being used for shortcuts of Docker and Docker Compose commands.

When starting the application for the first time, run the following command:

`make up-build-dev`

It should build the containers, do a composer install and start the containers. 

This is a list of some additional useful commands, more can be found in the `Makefile` 
 - `run` for starting the container in interactive mode for sh
 - `code-style` to access the PHP container
 - `tests` to run the tests
 - `logs` to print the docker logs