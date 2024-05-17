FROM php:8.3-apache
RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd
WORKDIR /var/www/html
COPY ./ /var/www/html