#!/bin/sh
set -e

printf '%s\n' "[$(date +"%T")] Setting up project directory permissions" >&1
chown -R ${APP_USER_NAME}:${APP_USER_GROUP} .

printf '%s\n' "[$(date +"%T")] Setting up nginx config" >&1
envsubst '$$APP_HOST $$APP_API_HOST' < /etc/nginx/sites-enabled/app.conf.template > /etc/nginx/sites-enabled/app.conf

printf '%s\n' "[$(date +"%T")] Setting up log directory" >&1
[ ! -d "${APP_DIR}/var/log" ] && mkdir -p "${APP_DIR}/var/log"
chmod -R 0777 "${APP_DIR}/var/log"

printf '%s\n' "[$(date +"%T")] Building project" >&1
su-exec ${APP_USER_NAME} ./bin/build.sh

printf '%s\n' "[$(date +"%T")] Starting $@" >&1
exec "$@"
