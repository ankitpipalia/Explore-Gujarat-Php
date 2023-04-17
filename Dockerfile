FROM php:7.4-apache

RUN docker-php-ext-install mysqli
RUN /etc/init.d/apache2 restart

WORKDIR /var/www/html
COPY . .

EXPOSE 80
CMD ["apache2-foreground"]