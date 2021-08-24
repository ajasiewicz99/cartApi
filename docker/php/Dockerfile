FROM php:7.3-fpm

RUN docker-php-ext-install pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- \
  --install-dir=/usr/bin --filename=composer
RUN service apache2 restart
COPY . /app

RUN cd "/app"

WORKDIR /app

EXPOSE 80

CMD php -S 0.0.0.0:80 -t public
