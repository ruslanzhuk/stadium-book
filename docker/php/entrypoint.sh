#!/bin/sh

set -e

if [ ! -d "vendor" ]; then
    echo "Installing Composer dependencies..."

    composer install \
        --prefer-dist \
        --no-interaction \
        --optimize-autoloader
fi


exec php-fpm