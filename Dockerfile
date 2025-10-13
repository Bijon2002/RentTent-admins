# Stage 1: Base PHP with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions needed for Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip unzip git curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql pdo_pgsql mbstring zip opcache \
    && a2enmod rewrite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy project files into container
COPY . .

# Install Composer from official Composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies (Laravel)
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# Set permissions for storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 for HTTP
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
