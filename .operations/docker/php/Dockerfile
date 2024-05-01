FROM php:8.3-fpm
LABEL authors="robsteuber"

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2 \
    zip \
    unzip

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN pecl install xdebug && docker-php-ext-enable xdebug

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/topfeest

COPY --chown=www-data:www-data . /var/www/topfeest

USER www-data

EXPOSE 9000