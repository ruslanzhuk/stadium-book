FROM php:8.3-fpm-bookworm


WORKDIR /var/www/html


RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    curl \
    libpq-dev \
    libicu-dev \
    libzip-dev \
    && docker-php-ext-install \
        pdo_pgsql \
        intl \
        zip \
        opcache \
        sockets \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*


COPY --from=composer:2 /usr/bin/composer /usr/bin/composer


COPY symfony-api/composer.json symfony-api/composer.lock ./


RUN composer install \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts


COPY symfony-api .


RUN composer dump-autoload --optimize


CMD ["php-fpm"]