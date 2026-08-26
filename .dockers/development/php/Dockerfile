# syntax=docker/dockerfile:1.7
FROM php:8.3-fpm-bookworm

ARG user=web
ARG group=web
ARG uid=1000
ARG gid=1000
ARG TZ=Europe/Rome

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/home/${user}/.composer \
    DEBIAN_FRONTEND=noninteractive

# System deps + PHP extensions used by Laravel 12
RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        ca-certificates curl git zip unzip less vim ssh \
        libpq-dev libzip-dev libicu-dev libpng-dev libonig-dev libxml2-dev libcurl4-openssl-dev libssl-dev; \
    docker-php-ext-configure intl; \
    docker-php-ext-install -j"$(nproc)" \
        pdo_pgsql \
        pdo_mysql \
        pgsql \
        zip \
        intl \
        gd \
        opcache \
        bcmath \
        pcntl; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/*

# Xdebug (dev only)
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Composer (latest)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# App user
RUN groupadd -g "${gid}" "${group}" \
    && useradd -m -g "${gid}" -G www-data,root -u "${uid}" -s /bin/bash "${user}" \
    && mkdir -p "/home/${user}/.ssh" "/home/${user}/.composer" \
    && chown -R "${user}:${group}" "/home/${user}"

# Timezone
RUN ln -snf "/usr/share/zoneinfo/${TZ}" /etc/localtime && echo "${TZ}" > /etc/timezone

# php-fpm pool: run as app user
RUN { \
        echo "user = ${user}"; \
        echo "group = ${group}"; \
        echo "listen.owner = ${user}"; \
        echo "listen.group = ${group}"; \
    } >> /usr/local/etc/php-fpm.d/zz-docker.conf

# Nice prompt for interactive shells
RUN echo 'alias ll="ls -la"' >> "/home/${user}/.bashrc" \
    && echo "PS1='🐳 \[\e[31m\]\u\[\e[m\]@\[\e[36m\]\h\[\e[m\]:\[\e[32m\]\w\[\e[m\]\\$ '" >> "/home/${user}/.bashrc"

WORKDIR /var/www/html
