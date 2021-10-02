FROM php:8.0.5-fpm-alpine@sha256:d0ca3bb7ac1328193ef5c246da1de3ff33f663ab5576ef05ad60a9b956707222

RUN apk add --no-cache mysql-client bash
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www
RUN rm -rf /var/www/html

ADD . /var/www
RUN chown -R www-data:www-data /var/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000
CMD ["php-fpm"]