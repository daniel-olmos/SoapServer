FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl

WORKDIR /var/www/html

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions soap

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
