FROM php:8.4-apache

# 1. Enable Apache mod_rewrite right out of the gate
RUN a2enmod rewrite

# 2. Allow .htaccess files to override rules inside /var/www/html
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# CRITICAL FIX FOR PERSISTENT 400 ERROR:
# Increase Apache's HTTP Header Field acceptance limit to handle large proxy/ingress cookie payloads
RUN echo "LimitRequestFieldSize 65536" >> /etc/apache2/apache2.conf

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

# Set working directory
WORKDIR /var/www/html

# Copy the entire application codebase
COPY . /var/www/html

# Set overall permissions to Apache's default user
RUN chown -R www-data:www-data /var/www/html

# Ensure the app can write to its temporary and asset folders
RUN mkdir -p runtime web/assets \
    && chmod -R 775 /var/www/html/runtime /var/www/html/web/assets

EXPOSE 80