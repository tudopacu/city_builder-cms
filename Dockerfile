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

# Set working directory
WORKDIR /var/www/html

# Copy app files
COPY . /var/www/html

# Configure Apache with your custom virtual host file
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Set overall permissions to Apache's default user
RUN chown -R www-data:www-data /var/www/html

# Crucial for Yii 2: Ensure the app can write to its temporary and asset folders
RUN chmod -R 775 /var/www/html/runtime /var/www/html/web/assets

EXPOSE 80