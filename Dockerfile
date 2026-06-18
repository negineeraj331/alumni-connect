# Laravel 13 on PHP 8.4 + Apache, deployed as a Docker service on Render.
FROM php:8.4-apache

# --- System packages + PHP extensions (Postgres, zip, intl, mbstring, bcmath) ---
RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libzip-dev \
        libpq-dev \
        libonig-dev \
        libicu-dev \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_pgsql \
        pgsql \
        zip \
        intl \
        mbstring \
        bcmath \
        opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# --- Composer ---
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# --- Apache: serve from public/, allow .htaccess, enable rewrite ---
RUN a2enmod rewrite headers
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

# Install PHP dependencies first to leverage Docker layer caching.
# --no-scripts because artisan/package discovery needs the full app (copied below)
# and the runtime environment; it is run at container start instead.
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-interaction --prefer-dist \
        --optimize-autoloader --no-progress

# --- Application code ---
COPY . .
RUN composer dump-autoload --no-dev --optimize --no-scripts \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chmod +x docker/start.sh

EXPOSE 80

CMD ["docker/start.sh"]
