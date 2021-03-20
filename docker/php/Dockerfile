FROM composer:2.0 as composer

FROM php:7.4-fpm

RUN docker-php-ext-install pdo_mysql \
&& pecl install apcu \
&& apt-get update && \
apt-get install -y \
libzip-dev \
&& apt-get install git -y \
&& curl -sS https://getcomposer.org/installer -o composer_setup.php && php composer_setup.php --install-dir=/usr/local/bin --filename=composer && rm composer_setup.php \
&& docker-php-ext-install zip \
&& docker-php-ext-enable apcu

WORKDIR /usr/src/app

COPY --chown=1000:1000 . /usr/src/app

RUN PATH=$PATH:/usr/src/app/vendor/bin:bin \