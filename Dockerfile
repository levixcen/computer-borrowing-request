FROM php:7.4-apache

WORKDIR /var/www/html

COPY . .

RUN apt-get update && apt-get install -y libmariadb-dev unzip \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
