FROM php:7.1-fpm

# Woking dir
WORKDIR /var/www/application

# Install latest composer
RUN php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php
RUN php composer-setup.php --install-dir=/usr/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

# Install main packages
RUN apt-get update
RUN apt-get install -y git vim htop wget
RUN apt-get install -y libmcrypt-dev libxml2-dev zlib1g zlib1g-dev libcurl3-dev libicu-dev sqlite3 libsqlite3-dev

# PHP Extensions
RUN docker-php-ext-install curl iconv mbstring bcmath soap zip pdo pdo_mysql intl json mysqli pdo_sqlite simplexml sockets xmlwriter

## Install PHP Debug
RUN yes | pecl install xdebug-2.5.0
RUN docker-php-ext-enable xdebug

# Adjust datetime (docker containers are in UTC)
RUN echo "Europe/Madrid" > /etc/timezone && dpkg-reconfigure --frontend noninteractive tzdata
