FROM debian:bullseye
# TODO: might also try slim image

LABEL maintainer="UNC ClinGen Developers"

WORKDIR /srv/app

ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get install -y --no-install-recommends lsb-release ca-certificates curl ca-certificates zip unzip git \
    && curl -sSLo /usr/share/keyrings/deb.sury.org-php.gpg https://packages.sury.org/php/apt.gpg \
    && sh -c 'echo "deb [signed-by=/usr/share/keyrings/deb.sury.org-php.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list' \
    && apt-get update \
    && apt-get install -y --no-install-recommends php8.0-cli \
       php8.0-sqlite3 php8.0-gd \
       php8.0-curl php8.0-rdkafka \
       php8.0-imap php8.0-opcache php8.0-mysql \
       php8.0-xml php8.0-zip \
       php8.0-readline php8.0-pcov \
       php8.0-redis php8.0-xdebug \
    && update-alternatives --set php /usr/bin/php8.0 \
    && curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


EXPOSE 8000

ENTRYPOINT ["bash"]
