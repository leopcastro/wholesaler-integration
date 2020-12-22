# Wholesaler Integration 

Requirements: 
 - GNU make
 - Docker 19.03.0+ 
 - Docker Compose

## Infrastructure
 - `Docker Compose` is used to manage the containers

 - `PHP` version 7.4 running on Alpine

 - `Xdebug` is running on port 9003 (additional config in docker/php-fpm/dev.xdebug.ini)

## Application
 - No framework used

 - PHPUnit for tests

 - PHPCS for static analysis using PSR-12

Created classes to enforce the enums in the Product and encapsulate this logic there.

Created a ProductFetcher interface to abstract the processes of getting the product itself from the different data 
sources and formats, so more formats can be added from it.

Some auxiliary classes were used in the ProductFetcher (reader, normalizer) that could possibly be abstracted when 
having more cases to make sure the abstraction makes sense and is the right one.

Unit tests were used trying to cover most of the logic, but I think it is necessary to add a higher level too 
(integration, functional, acceptance, e2e, etc) so that the integrated code can be checked.

## Running the application
GNU `make` is being used for shortcuts of Docker and Docker Compose commands.

When starting the application for the first time, run the following command:

`make initial-setup`

It should build the containers and do a composer install. 

For getting the Json output of the application:

`make print-products`

This is a list of some additional useful commands, more can be found in the `Makefile` 
 - `run` for starting the container in interactive mode for sh
 - `code-style` to run static code analyzers
 - `tests` to run the tests
 - `logs` to print the docker logs