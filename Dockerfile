FROM composer:1.8 as builder
WORKDIR /app

COPY composer.json composer.lock /app/
# Composer parallel
RUN composer global require hirak/prestissimo
RUN composer install  \
    --ignore-platform-reqs \
    --no-ansi \
    --no-autoloader \
    --no-interaction \
    --no-scripts

COPY . /app/
RUN composer dump-autoload --optimize --classmap-authoritative

FROM php:7.3-fpm-alpine
WORKDIR /app

COPY . /app/
COPY --from=builder /app/vendor /app/vendor
COPY etc/infrastructure/php/ /usr/local/etc/php/

RUN apk --update upgrade \
    && apk add autoconf automake make gcc g++ rabbitmq-c rabbitmq-c-dev \
    && pecl install amqp-1.9.4 \
    && pecl install apcu-5.1.17 \
    && pecl install xdebug-2.7.0RC2 \
    && docker-php-ext-enable amqp apcu xdebug \
    && docker-php-ext-install pdo pdo_mysql

EXPOSE 9001
