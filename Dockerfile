FROM php:8.2-cli
RUN apt-get update && apt-get install -y git zip unzip curl
RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN echo "xdebug.mode=debug,coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=digitalocean/doctl /app/doctl /usr/bin/doctl

WORKDIR /app