FROM php:7.4-apache

WORKDIR /var/www/html

COPY . .

RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    && docker-php-ext-install mysqli pdo pdo_mysql gd \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create missing directories
RUN mkdir -p resources/svg storage bootstrap/cache

# Set proper permissions
RUN chmod -R 777 storage bootstrap/cache

RUN composer install --no-interaction --prefer-dist

RUN a2enmod rewrite

CMD ["apache2-foreground"]
