FROM php:7.2.10-fpm-alpine

LABEL mantainer="sdecandelario@gmail.com"

COPY --from=composer:1.7.2 /usr/bin/composer /usr/bin/composer

RUN apk --update upgrade \
    && apk add autoconf automake make gcc g++

RUN apk add rabbitmq-c rabbitmq-c-dev \
    && pecl install amqp apcu\
    && docker-php-ext-enable amqp apcu

WORKDIR /app

CMD ["sh", "-c", "composer install && php-fpm"]
