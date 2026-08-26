# syntax=docker/dockerfile:1.7
FROM httpd:2.4-alpine

ARG user=web
ARG group=web
ARG uid=1000
ARG gid=1000
ARG TZ=Europe/Rome

RUN apk add --no-cache tzdata bash \
    && ln -snf "/usr/share/zoneinfo/${TZ}" /etc/localtime \
    && echo "${TZ}" > /etc/timezone

RUN addgroup -g "${gid}" "${group}" \
    && adduser -D -u "${uid}" -G "${group}" -s /bin/bash "${user}"

COPY app.apache.conf /usr/local/apache2/conf/app.apache.conf
RUN echo "Include /usr/local/apache2/conf/app.apache.conf" >> /usr/local/apache2/conf/httpd.conf
