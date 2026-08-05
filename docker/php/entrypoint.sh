#!/bin/sh

set -e

if [ ! -f "vendor/autoload.php" ]; then
    echo "Installing Composer dependencies..."

    composer install \
        --prefer-dist \
        --no-interaction \
        --optimize-autoloader
fi


exec php-fpm