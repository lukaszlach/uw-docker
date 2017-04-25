FROM php:7-alpine

RUN apk update \
    && apk add -u bash supervisor curl \
    && mkdir -p /etc/supervisor.d

ENV PHPREDIS_VERSION 3.1.2

RUN cd /tmp \
    && curl -L -o /tmp/redis.tar.gz https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz \
    && tar vxfz /tmp/redis.tar.gz \
    && rm -r /tmp/redis.tar.gz \
    && mkdir -p /usr/src/php/ext/ \
    && mv phpredis-$PHPREDIS_VERSION /usr/src/php/ext/redis \
    && docker-php-ext-install redis

CMD ["supervisord", "-n", "-c", "/etc/supervisord.conf"]