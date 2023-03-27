FROM nginx

RUN apt-get update -y
RUN apt-get upgrade -y
RUN apt-get install git -y
RUN apt-get install php -y
RUN apt-get install php-fpm -y
RUN apt-get install mariadb-server -y

RUN mkdir -p /var/www/html/
RUN rm -rf /var/www/html/
RUN git clone https://github.com/ankitpipalia/Explore-Gujarat-Php.git /var/www/html

WORKDIR /var/www/html

service mariadb start
RUN mysql -u root --socket=/var/run/mysqld/mysqld.sock -e "CREATE DATABASE gujarat"
RUN mysql -u root gujarat < gujarat_database.sql

RUN sed -i 's,listen = /run/php/php8.1-fpm.sock,listen = /var/run/php-fpm/www.sock,g' /etc/php/8.1/fpm/pool.d/www.conf
RUN touch /var/run/php/www.sock
RUN chown nginx:nginx /var/run/php/www.sock

ENTRYPOINT service php8.1-fpm start && /bin/bash
