# STAGE 1: Build (Tahap besar untuk instalasi dependensi Composer)
FROM php:8.4-cli-alpine AS builder

RUN apk add --no-cache zip unzip libzip-dev git \
    && docker-php-ext-install zip pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

COPY . .
RUN composer dump-autoload
RUN cp .env.example .env && php artisan key:generate

# STAGE 2: Production (Tahap ramping, aman, dan tanpa file mentah)
FROM php:8.4-cli-alpine

# Install curl untuk keperluan Healthcheck
RUN apk add --no-cache curl zip unzip libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

WORKDIR /app

# Salin HANYA hasil akhir dari stage builder
COPY --from=builder /app /app

# Tambahkan user non-root untuk keamanan
RUN addgroup -S laravelgroup && adduser -S laraveluser -G laravelgroup \
    && chown -R laraveluser:laravelgroup /app
USER laraveluser

# Tambahkan Healthcheck
HEALTHCHECK --interval=30s --timeout=5s --start-period=5s --retries=3 \
  CMD curl -f http://localhost:8000/ || exit 1

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]