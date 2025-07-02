# Use the official PHP image with FPM
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    curl \
    git \
    default-mysql-client \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif intl pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Install Laravel dependencies and build frontend
RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build

# Expose port
EXPOSE 80

# Start PHP-FPM
CMD ["php-fpm"]
