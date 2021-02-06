FROM php:7.4-fpm
ARG TIMEZONE
ARG DOCKER_USER

RUN apt-get update -y \
    && apt-get upgrade -y \
    && apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql \
    && rm -rf /var/lib/apt/lists/* rm -rf /tmp/pear
