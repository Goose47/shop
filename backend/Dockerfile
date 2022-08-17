FROM php:8.1.0-fpm

WORKDIR /var/www/html

RUN apk update && apk add --no-cache \
    build-base shadow vim curl \
    php8 \
    php8-fpm \
    php8-common \
    php8-pdo \
    php8-pdo_mysql \
    php8-mysqli \
    php8-pgsql \
    php8-mcrypt \
    php8-mbstring \
    php8-xml \
    php8-openssl \
    php8-json \
    php8-phar \
    php8-zip \
    php8-gd \
    php8-dom \
    php8-session \
    php8-zlib
