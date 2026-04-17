FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    curl unzip git

RUN docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . .

# Fix git issue
RUN git config --global --add safe.directory /var/www/html

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

# Laravel auto setup
RUN cp .env.example .env \
 && php artisan key:generate \
 && touch database/database.sqlite \
 && chmod -R 777 storage bootstrap/cache database \
 && php artisan migrate

# Apache public folder
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80
