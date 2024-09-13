FROM php:8.3.11-fpm-alpine

# Install system dependencies
RUN apk update && apk add --no-cache \
    libzip-dev \
    unzip \
    bash \
    curl \
    && docker-php-ext-install pdo pdo_mysql zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
