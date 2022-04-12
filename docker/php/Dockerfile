FROM php:8.1-fpm

RUN apt-get update && apt-get install -y ssh git libpq-dev

RUN docker-php-ext-install pdo pdo_pgsql pgsql pdo_mysql

RUN pecl install xdebug && docker-php-ext-enable xdebug

CMD php-fpm -D; while true; do sleep 100; done;