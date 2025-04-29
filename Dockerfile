FROM php:8.2-cli
COPY public /var/www/html
WORKDIR /var/www/html
CMD php -S 0.0.0.0:10000 -t .
