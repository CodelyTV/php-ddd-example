FROM php:7.3-fpm-alpine
WORKDIR /app

COPY etc/infrastructure/php/ /usr/local/etc/php/

RUN apk --update upgrade \
    && apk add autoconf automake make gcc g++ rabbitmq-c rabbitmq-c-dev \
    && pecl install amqp-1.9.4 \
    && pecl install apcu-5.1.17 \
    && pecl install xdebug-2.7.0RC2 \
    && docker-php-ext-enable amqp apcu xdebug \
    && docker-php-ext-install pdo pdo_mysql
