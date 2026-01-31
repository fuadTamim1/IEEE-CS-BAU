# Multi-stage build for production
FROM php:8.3-fpm-alpine AS builder

WORKDIR /app

# Install system dependencies
RUN apk add --no-cache \
    build-base \
    autoconf \
    libpng-dev \
    libjpeg-turbo-dev \
    libxml2-dev \
    libzip-dev \
    zlib-dev \
    icu-dev \
    oniguruma-dev \
    curl \
    git \
    nodejs \
    npm \
    freetype-dev

# Install PHP extensions
RUN docker-php-ext-configure gd --with-jpeg --with-freetype && \
    docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    intl \
    zip \
    gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Build frontend assets
RUN npm install && npm run build || true

# Production stage
FROM php:8.3-fpm-alpine

WORKDIR /var/www/html

# Install build tools AND runtime dependencies
RUN apk add --no-cache \
    build-base \
    autoconf \
    libpng-dev \
    libjpeg-turbo-dev \
    libxml2-dev \
    libzip-dev \
    zlib-dev \
    icu-dev \
    oniguruma-dev \
    freetype-dev \
    mysql-client

# Install PHP extensions
RUN docker-php-ext-configure gd --with-jpeg --with-freetype && \
    docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    intl \
    zip \
    gd

# Install Composer for fallback dependency installation
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy built application from builder (includes vendor directory)
COPY --from=builder /app /var/www/html

# Verify vendor exists, if not run composer install as fallback
RUN if [ ! -d /var/www/html/vendor ]; then \
      echo "⚠️  Vendor directory missing, installing composer dependencies..."; \
      cd /var/www/html && composer install --no-dev --optimize-autoloader --no-interaction --no-progress; \
    fi

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Copy PHP configuration
COPY docker/php/php.ini /usr/local/etc/php/php.ini
COPY docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

EXPOSE 9000

CMD ["php-fpm"]