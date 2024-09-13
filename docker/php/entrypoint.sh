#!/bin/sh

# Exit immediately if a command exits with a non-zero status
set -e

# Check if .env file exists, and copy .env.example to .env if not
if [ ! -f .env ]; then
    echo ".env file not found. Copying .env.example to .env..."
    cp .env.example .env
else
    echo ".env file already exists."
fi

# Check if the vendor directory exists and is not empty
if [ ! -d vendor ] || [ -z "$(ls -A vendor)" ]; then
    echo "Vendor directory not found or is empty. Running composer install..."
    composer install

    echo "Generating application key..."
    php artisan key:generate
else
    echo "Vendor directory exists and is not empty. Skipping composer install and key generation."
fi

