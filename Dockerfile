FROM php:apache

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html/ \
    && chmod -R 755 /var/www/html/
