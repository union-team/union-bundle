FROM php:8.2

RUN apt-get update && \
    apt-get install -y --no-install-recommends libssl-dev zlib1g-dev libxml2-dev libpq-dev libzip-dev && \
    pecl install apcu && \
    docker-php-ext-install -j$(nproc) zip opcache intl && \
    docker-php-ext-enable apcu && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

CMD php
