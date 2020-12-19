FROM php:7.4-fpm-alpine AS PROD

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/wholesaler

COPY ./ /var/www/wholesaler

FROM prod AS DEV

RUN apk --update --no-cache add autoconf g++ make && \
    pecl install -f xdebug && \
    docker-php-ext-enable xdebug && \
    apk del --purge autoconf g++ make

COPY ./docker/php-fpm/dev.xdebug.ini /usr/local/etc/php/conf.d/dev.xdebug.ini
