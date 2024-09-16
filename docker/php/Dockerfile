FROM php:8.3.11-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev \
    unzip \
    bash \
    curl \
    && docker-php-ext-install pdo pdo_mysql zip bcmath\
    && rm -rf /var/lib/apt/lists/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js and npm (using NodeSource)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Copy custom PHP configuration
COPY custom-php.ini /usr/local/etc/php/conf.d/

# Expose port 9000 (standard for PHP-FPM)
EXPOSE 9000


