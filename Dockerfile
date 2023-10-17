ARG BUILD_ROLE
ARG PHP_VERSION=8.2
ARG ALPINE_VERSION=3.16

##########################################################################
# Base CLI role
##########################################################################

FROM php:${PHP_VERSION}-fpm-alpine${ALPINE_VERSION} as base

ENV TZ="Europe/Riga"
ENV APP_USER_NAME="php-data"
ENV APP_USER_GROUP="php-data"
ENV APP_DIR="/var/www/app"

RUN addgroup -S "$APP_USER_GROUP" && adduser -S "$APP_USER_NAME" -G "$APP_USER_GROUP" -s /bin/sh

# Global dependencies
RUN apk add --update git gettext su-exec tzdata shadow openssh-client libpq-dev && rm -rf /tmp/* /var/cache/apk/*

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# PHP Extensions
RUN install-php-extensions @composer zip bcmath xdebug

RUN ln -s /usr/local/bin/php /usr/bin/php

##########################################################################
# CI
##########################################################################

ARG GITLAB_ACCESS_TOKEN

FROM base as ci

# PHP Production Configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY . ${APP_DIR}

WORKDIR ${APP_DIR}

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer config -g gitlab-token.gitlab.accrela.io ${GITLAB_ACCESS_TOKEN}
RUN composer install
RUN composer dump-autoload

COPY etc/entrypoint/ci.sh /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]

##########################################################################
# Development
##########################################################################

FROM base as dev

# PHP Configs
COPY etc/conf/php-fpm.conf /usr/local/etc/

COPY --chown=${APP_USER_NAME}:${APP_USER_GROUP} . ${APP_DIR}

# PHP Development Configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# NGinx
RUN apk update && apk add nginx && rm -rf /tmp/* /var/cache/apk/*
COPY etc/nginx/sites/app.conf.template /etc/nginx/sites-enabled/app.conf.template
COPY etc/nginx/snippets /etc/nginx/snippets
COPY etc/nginx/nginx.conf /etc/nginx/nginx.conf

EXPOSE 80

# Supervisor
RUN apk add --update supervisor && rm -rf /tmp/* /var/cache/apk/*
ADD etc/supervisor/supervisord.conf /etc/
ADD etc/supervisor/php-fpm.conf /etc/supervisor/conf.d/
ADD etc/supervisor/nginx.conf /etc/supervisor/conf.d/

COPY etc/entrypoint/web.sh /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]

CMD ["supervisord" , "--nodaemon", "--configuration", "/etc/supervisord.conf"]

##########################################################################
# Container build
##########################################################################

FROM $BUILD_ROLE

ARG BUILD_ROLE

ENV APP_ROLE=$BUILD_ROLE

# Ensure entrypoint is executable
RUN if test -f "/entrypoint.sh"; then chmod +x /entrypoint.sh ; fi

WORKDIR ${APP_DIR}
