FROM php:8.4.3-fpm-alpine3.21

RUN apk update && apk upgrade && \
	apk add git bash

RUN docker-php-ext-install pdo pdo_mysql mysqli

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /srv/
