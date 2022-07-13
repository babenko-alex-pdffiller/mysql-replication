FROM php:8.1-fpm

WORKDIR /var/www/html

RUN apt-get update

RUN docker-php-ext-install pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
