# Use the official PHP image with necessary extensions
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    curl \
    git \
    nodejs \
    npm \
    libonig-dev \
    libxml2-dev

# Install PHP extensions
RUN docker-php-ext-install \
        pdo pdo_pgsql pgsql \
        mbstring zip exif pcntl

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# … composer install / npm build steps …

# Let Railway know which port we’ll use
EXPOSE 8080

# Run migrations, then start Laravel
CMD ["sh", "-c", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT"]
