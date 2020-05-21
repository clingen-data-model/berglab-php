FROM docker.io/php:7.4-apache

LABEL maintainer="TJ Ward" \
    io.openshift.tags="berglab/php:7.4-apache" \
    io.k8s.description="A base php 7.4 image with apache with a non-root user" \
    io.openshift.expose-services="8080:http,8443:https" \
    io.k8s.display-name="BergLab PHP 7.4-apache" \
    io.openshift.tags="php,apache"

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY .docker/php/conf.d/* "$PHP_INI_DIR/conf.d/"

COPY .docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY .docker/apache/conf.d/ports.conf /etc/apache2/ports.conf
COPY composer-installer.sh /usr/local/bin/composer-installer
COPY index.php /srv/app/public/index.php

# Debian
RUN apt-get -yqq update \
    && apt-get -yqq install --no-install-recommends unzip \
        bash-completion \
        less \
        libzip-dev \
        zlib1g-dev \
    && echo "if [ -f /etc/bash_completion ]; then . /etc/bash_completion fi" >> ~/.bash_profile

# Apache
RUN chgrp -R 0 /var/log/apache2 \
    && chmod -R g+w /var/log/apache2 \
    && a2enmod rewrite negotiation \
    && ln -s /etc/apache2/mods-available/headers.load /etc/apache2/mods-enabled/headers.load

# Php
RUN docker-php-ext-install pdo_mysql \
        opcache \
        zip \
        pcntl \
    && chmod +x /usr/local/bin/composer-installer \ 
    && composer-installer \
    && mv composer.phar /usr/local/bin/composer \
    && composer --version
    

# USER 1001

EXPOSE 8080/tcp
EXPOSE 8443/tcp