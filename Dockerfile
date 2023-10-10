FROM php:7.4-apache
COPY . /var/www/html/

# PHP extensions

RUN docker-php-ext-install pdo pdo_mysql