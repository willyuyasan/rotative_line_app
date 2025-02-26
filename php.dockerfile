FROM php:8.3-fpm-alpine

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apk update && apk add icu-dev libpq-dev
RUN docker-php-ext-install pgsql pdo_pgsql intl
