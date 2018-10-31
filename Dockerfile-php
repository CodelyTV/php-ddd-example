FROM composer:1.7 as builder

COPY composer.json composer.lock /app/
RUN composer install  \
    --ignore-platform-reqs \
    --no-ansi \
    --no-autoloader \
    --no-interaction \
    --no-scripts

COPY . /app/
RUN composer dump-autoload --optimize --classmap-authoritative

FROM php:7.2-fpm-alpine
WORKDIR /app

RUN apk --update upgrade \
    && apk add autoconf automake make gcc g++ rabbitmq-c rabbitmq-c-dev \
    && pecl install amqp-1.9.3 \
    && pecl install apcu-5.1.12 \
    && pecl install xdebug-2.6.1 \
    && docker-php-ext-enable amqp apcu xdebug \
    && docker-php-ext-install pdo pdo_mysql

COPY --from=builder /app /var/www/
COPY etc/infrastructure/php/ /usr/local/etc/php/