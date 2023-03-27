FROM php:8.2-cli-alpine as base

RUN apk add -U --no-cache procps git openssh-client autoconf gcc make libc-dev libzip-dev bzip2-dev libxml2-dev libpng-dev g++ icu-dev linux-headers
RUN docker-php-ext-install intl calendar gd zip pdo soap bcmath bz2
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY --chown=www-data ./app /app

WORKDIR /app

RUN composer install --no-interaction --no-progress --optimize-autoloader

FROM base as dev

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
