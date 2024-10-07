FROM php:8.1-fpm

RUN apt-get update && \
    apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libzip-dev \
        unzip \
        git \
        curl \
        ca-certificates && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd zip pdo pdo_mysql && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN update-ca-certificates
COPY . /var/www/html
WORKDIR /var/www/html

EXPOSE 9000