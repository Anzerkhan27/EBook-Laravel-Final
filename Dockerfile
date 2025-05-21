# ───────────────────────────────
# 🌟 Laravel + Node build image
# ───────────────────────────────
FROM php:8.1-fpm

# ---------- system deps ----------
RUN apt-get update && apt-get install -y \
    git unzip curl zip gnupg \
    libpng-dev libjpeg-dev libpq-dev libzip-dev \
    libonig-dev libxml2-dev \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install \
         pdo pdo_mysql pdo_pgsql pgsql \
         mbstring zip exif pcntl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# ---------- Composer ----------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ---------- project files ----------
WORKDIR /var/www
COPY . .

# ---------- PHP deps & assets ----------
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist
RUN npm install && npm run build

# ---------- runtime ----------
ENV PORT=8080
EXPOSE 8080
CMD ["sh", "-c", "php /var/www/artisan migrate --force && php /var/www/artisan serve --host=0.0.0.0 --port=$PORT"]
