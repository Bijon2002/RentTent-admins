# Use official PHP image with Apache
FROM php:8.2-apache

# Install PHP extensions Laravel needs
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite for Laravel routes
RUN a2enmod rewrite

# Copy project into the container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions for storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 for HTTP
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
