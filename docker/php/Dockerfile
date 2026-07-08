FROM php:8.4-fpm-bookworm


WORKDIR /var/www/html


# ==========================================================
# System packages + PHP extensions
# ==========================================================
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


# ==========================================================
# Composer
# ==========================================================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ==========================================================
# Entrypoint
# ==========================================================
COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint


ENTRYPOINT ["entrypoint"]


CMD ["php-fpm"]