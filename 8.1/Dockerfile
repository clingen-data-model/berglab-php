FROM docker.io/php:8.1-apache

LABEL maintainer="TJ Ward" \
    io.openshift.tags="berglab/php:8.1-apache" \
    io.k8s.description="A base php 8.1 image with apache with a non-root user" \
    io.openshift.expose-services="8080:http,8443:https" \
    io.k8s.display-name="BergLab PHP 8.1-apache" \
    io.openshift.tags="php,apache"

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Debian
RUN apt-get -yqq update \
    && apt-get -yqq install --no-install-recommends unzip \
        bash-completion \
        less \
        libzip-dev \
        zlib1g-dev \
        vim \
        rsync \
    && echo "if [ -f /etc/bash_completion ]; then . /etc/bash_completion fi" >> ~/.bash_profile

# Apache
RUN chgrp -R 0 /var/log/apache2 \
    && chmod -R g+w /var/log/apache2 \
    && a2enmod rewrite negotiation \
    && ln -s /etc/apache2/mods-available/headers.load /etc/apache2/mods-enabled/headers.load \
    && cp /etc/apache2/mods-available/http2.* /etc/apache2/mods-enabled/
    # && cp /etc/apache2/mods-available/ssl.* /etc/apache2/mods-enabled

COPY composer-installer.sh /usr/local/bin/composer-installer

# Php
RUN docker-php-ext-install pdo_mysql \
        opcache \
        zip \
        pcntl \
    && pecl install redis \
    && chmod +x /usr/local/bin/composer-installer \ 
    && composer-installer \
    && mv composer.phar /usr/local/bin/composer \
    && composer --version
    
COPY .docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY .docker/apache/conf.d/ports.conf /etc/apache2/ports.conf
COPY index.php /srv/app/public/index.php
COPY .docker/php/conf.d/* "$PHP_INI_DIR/conf.d/"

# USER 1001

EXPOSE 8080/tcp
EXPOSE 8443/tcp