FROM php:8.0.0RC3-fpm-alpine
WORKDIR /app

RUN wget https://github.com/FriendsOfPHP/pickle/releases/download/v0.6.0/pickle.phar \
    && mv pickle.phar /usr/local/bin/pickle \
    && chmod +x /usr/local/bin/pickle

RUN apk --update upgrade \
    && apk add --no-cache autoconf automake make gcc g++ bash icu-dev libzip-dev rabbitmq-c rabbitmq-c-dev \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        opcache \
        intl \
        zip \
        pdo_mysql

RUN pickle install apcu-5.1.19

ADD etc/infrastructure/php/extensions/rabbitmq.sh /root/install-rabbitmq.sh
ADD etc/infrastructure/php/extensions/xdebug.sh /root/install-xdebug.sh
RUN apk add git
RUN sh /root/install-rabbitmq.sh
RUN sh /root/install-xdebug.sh

RUN docker-php-ext-enable \
        amqp \
        apcu \
        opcache

RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

COPY etc/infrastructure/php/ /usr/local/etc/php/
