FROM php:8.0-fpm-alpine
RUN apk update && apk upgrade
RUN apk add autoconf gcc g++ pkgconf git make nginx nginx-mod-http-headers-more libpng-dev libzip-dev openssh ca-certificates
RUN pecl install apcu
RUN docker-php-ext-enable apcu
RUN docker-php-ext-install zip sockets gd opcache pdo pdo_mysql
ADD .default.nginx.conf /etc/nginx/conf.d/default.conf
ADD .nginx.conf /etc/nginx/nginx.conf
ADD . /var/www/html


RUN mkdir -p /etc/sv/nginx
RUN mkdir -p /etc/sv/php
RUN echo "#!/bin/sh" > /etc/sv/nginx/run
RUN echo "$(which nginx) -g'daemon off;'" >> /etc/sv/nginx/run
RUN chmod +x /etc/sv/nginx/run

RUN echo "#!/bin/sh" > /etc/sv/php/run
RUN echo "$(which php-fpm) -F" >> /etc/sv/php/run
RUN chmod +x /etc/sv/php/run

RUN sed -E "s/^listen.*$/listen = 127.0.0.1:9000/g" -i /usr/local/etc/php-fpm.d/zz-docker.conf
RUN echo "memory_limit = 256M" > /usr/local/etc/php/conf.d/memory.ini

WORKDIR /var/www/html
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN php -d memory_limit=2048M composer.phar install
RUN php ./vendor/bin/openapi --format yaml --output ./swagger/swagger.yaml ./swagger/swagger.php src

RUN mkdir -p /run/nginx
ADD http://smarden.org/runit/runit-2.1.2.tar.gz /tmp/runit.tar.gz
WORKDIR /tmp
RUN tar zxvpf runit.tar.gz
WORKDIR /tmp/admin/runit-2.1.2
RUN package/install
RUN rm -rf /tmp/runit.tar.gz
WORKDIR /var/www/html

EXPOSE 80

CMD ["runsvdir", "/etc/sv"]