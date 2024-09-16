#!/bin/sh

# Exit immediately if a command exits with a non-zero status
set -e

# Ensure wait-for-it.sh is executable
chmod +x /var/www/docker/php/wait-for-it.sh

# Wait for MySQL to be ready
/var/www/docker/php/wait-for-it.sh db:3306 --timeout=60 --strict -- echo "MySQL is up"

# Start php-fpm in the background
php-fpm &

# Check if .env file exists, and copy .env.example to .env if not
if [ ! -f .env ]; then
    echo ".env file not found. Copying .env.example to .env..."
    cp .env.example .env
fi

# Install Composer dependencies
composer install

# Check if the APP_KEY is set in the .env file
if ! grep -q '^APP_KEY=' .env || [ -z "$(grep '^APP_KEY=' .env | cut -d'=' -f2)" ]; then
    echo "APP_KEY is not set or empty. Generating application key..."
    php artisan key:generate
fi

# Run database migrations and seeders
php artisan migrate
php artisan db:seed
php artisan exchange-rates:fetch

# Run Laravel Queue Worker
php artisan queue:work &

# Set proper permissions for storage and cache directories
echo "Setting proper permissions for storage and cache directories..."
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

npm install
npm run build

# Keep the container running
wait
