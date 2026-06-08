FROM php:8.4-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libicu-dev \
    libzip-dev \
    unzip \
    git \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install intl pdo_mysql zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer from the official Docker image layer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy ONLY composer files first (optimizes Docker build caching layers)
COPY composer.json composer.lock /var/www/html/

# CRITICAL FIX: Disable memory limits and remove --no-scripts flag
# so that any required post-install scripts can run cleanly
RUN --network=host COMPOSER_MEMORY_LIMIT=-1 composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Copy the rest of your application files
COPY . /var/www/html

# Configure Apache with your custom virtual host file
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Set overall permissions to Apache's default user
RUN chown -R www-data:www-data /var/www/html

# Ensure the app can write to its temporary and asset folders (creating them if missing)
RUN mkdir -p runtime web/assets \
    && chmod -R 775 /var/www/html/runtime /var/www/html/web/assets

EXPOSE 80