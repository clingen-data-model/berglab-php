FROM php:8.1-fpm

LABEL maintainer="TJ Ward" \
    io.openshift.tags="berglab/php:8.1-fpm" \
    io.k8s.description="A base php fpm 8.1 imagewith a non-root user" \
    io.openshift.expose-services="9000:tcp" \
    io.k8s.display-name="BergLab PHP 8.1-fpm" \
    io.openshift.tags="php,apache"

# USER root
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Debian
RUN apt-get -yqq update \
    && apt-get -yqq install --no-install-recommends unzip \
        bash-completion \
        less \
        libzip-dev \
        zlib1g-dev \
        vim \
        rsync \
        git \
    && echo "if [ -f /etc/bash_completion ]; then . /etc/bash_completion fi" >> ~/.bash_profile


COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Php
RUN docker-php-ext-install pdo_mysql \
        opcache \
        zip \
        pcntl \
    && pecl install redis

# Install kafka library
RUN apt-get install -yqq librdkafka-dev \
    && pecl install rdkafka \
    && apt-get install -y --no-install-recommends openssl \
    && sed -i 's,^\(MinProtocol[ ]*=\).*,\1'TLSv1.0',g' /etc/ssl/openssl.cnf \
    && sed -i 's,^\(CipherString[ ]*=\).*,\1'DEFAULT@SECLEVEL=1',g' /etc/ssl/openssl.cnf\
    && rm -rf /var/lib/apt/lists/* \
    && composer --version
    
COPY index.php /var/www/html
COPY .docker/php/conf.d/* "$PHP_INI_DIR/conf.d/"

# USER 1001

EXPOSE 9000/tcp