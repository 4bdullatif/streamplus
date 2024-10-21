# Stage 1: Build the app artifact (composer dependencies, optimized files)
FROM composer:latest AS build

WORKDIR /app

# Copy the composer files
COPY composer.json composer.lock ./


# Copy the application source
COPY . .

RUN composer install  --prefer-dist --optimize-autoloader

# Ensure proper permissions for the Laravel storage and bootstrap directories
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Stage 2: Final image with PHP and Nginx
FROM php:8.3-fpm

WORKDIR /var/www/html

# Install system dependencies required for Laravel
RUN apt-get update && apt-get install -y \
    nginx \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev

# Install PHP extensions required by Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Copy the build artifacts from the build stage
COPY --from=build /app /var/www/html

# Nginx configuration
RUN rm /etc/nginx/sites-enabled/default
COPY ./.docker/nginx/default.conf /etc/nginx/sites-available/default
RUN ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 for the application
EXPOSE 80

# Start PHP-FPM and Nginx together
CMD service nginx start && php-fpm
