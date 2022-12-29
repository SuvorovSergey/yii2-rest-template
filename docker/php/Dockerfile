FROM php:8.1-fpm

ENV DEPENDENSIES="curl wget git libfreetype6-dev libjpeg62-turbo-dev libpng-dev libzip-dev libicu-dev zlib1g-dev libpq-dev"
ENV EXTENSIONS="bcmath pdo pdo_pgsql intl sockets zip"

ARG REMOTE_HOST
ARG REMOTE_ENABLE

# Install system dependencies
RUN apt-get update && apt-get install -y ${DEPENDENSIES}

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP dependencies
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) ${EXTENSIONS}

# Install Xdebug
RUN pecl install -f xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.client_host=$REMOTE_HOST" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && mkdir -p /var/xdebug/profiler \
    && chmod -R 777 /var/xdebug \
    && touch /tmp/xdebug.log \
    && chmod 777 /tmp/xdebug.log

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY ./web.php.ini /usr/local/etc/php/conf.d/40-custom.ini

WORKDIR /var/www/html

CMD ["php-fpm"]