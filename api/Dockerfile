FROM php:8.0-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    acl \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    libzip-dev \
    zlib1g-dev \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    git \
    libpq-dev \
    libonig-dev \
    curl

RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-configure zip
RUN docker-php-ext-install pdo pdo_pgsql pgsql mbstring zip exif pcntl
RUN docker-php-ext-configure gd
RUN docker-php-ext-install gd

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"

COPY composer.lock composer.json /var/www/

RUN set -eux; \
    composer install --prefer-dist --no-dev --no-scripts --no-progress; \
    composer clear-cache

#COPY . /var/www

COPY .env /var/www/
COPY bin /var/www/bin/
COPY config /var/www/config/
COPY migrations /var/www/migrations/
COPY public /var/www/public/
COPY src /var/www/src/
COPY templates /var/www/templates/

RUN set -eux; \
    mkdir -p var/cache var/log; \
    composer dump-autoload --classmap-authoritative --no-dev; \
    composer dump-env prod; \
    composer run-script --no-dev post-install-cmd; \
    chmod +x bin/console; sync

COPY --chown=www:www . /var/www

#USER www

ENV SYMFONY_PHPUNIT_VERSION=9

EXPOSE 9000

COPY docker/entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]