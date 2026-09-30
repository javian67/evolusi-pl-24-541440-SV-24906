FROM php:8.4-cli

RUN apt-get update && apt-get install -y unzip libzip-dev git \
    && docker-php-ext-install zip pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Langkah 3: Optimasi Cache (Salin composer dulu baru install)
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# BARU salin sisa kode aplikasi
COPY . .

RUN composer dump-autoload

# Otomatis buat file .env dan key generator agar tidak 500 error
RUN cp .env.example .env && php artisan key:generate

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]