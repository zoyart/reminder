FROM php:8.1.8-fpm

WORKDIR /var/www

RUN apt-get update \
&& docker-php-ext-install pdo pdo_mysql
