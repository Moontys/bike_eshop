FROM php:8.0.0-fpm

RUN apt-get update && apt-get install -y git
#In this place you can specify all the extensions you need.

RUN docker-php-ext-install pdo_mysql

RUN apt-get install -y \
        libzip-dev \
        zip \
        curl \
        nano \
  && docker-php-ext-install zip

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        zlib1g-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN curl -sL https://deb.nodesource.com/setup_13.x | bash -
RUN apt-get update && apt-get install -y \
    nodejs

RUN docker-php-ext-install gd

COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

WORKDIR /var/www
