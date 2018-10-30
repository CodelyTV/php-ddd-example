FROM php:7.2-fpm-alpine

COPY --from=composer:1.7 /usr/bin/composer /usr/bin/composer

RUN apk --update upgrade \
    && apk add autoconf automake make gcc g++ rabbitmq-c rabbitmq-c-dev \
    && pecl install amqp apcu xdebug-2.6.0 \
    && docker-php-ext-enable amqp apcu xdebug \
    && docker-php-ext-install pdo pdo_mysql

COPY php.ini xdebug.ini /usr/local/etc/php/

WORKDIR /app

CMD ["sh", "-c", "composer install --ignore-platform-reqs --no-ansi --no-autoloader --no-interaction --no-scripts --optimize-autoloader && php-fpm"]