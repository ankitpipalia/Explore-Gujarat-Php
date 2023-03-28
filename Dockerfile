FROM nginx

SHELL ["/bin/bash", "-c"]
RUN apt-get update -y
RUN apt-get upgrade -y
RUN apt-get install git -y
RUN apt-get install php -y
RUN apt-get install php-fpm -y
RUN apt-get -y install mariadb-plugin-rocksdb && rm -rf /var/cache/apt/lists/*
RUN apt-get install mariadb-server -y
RUN apt-get --fix-broken install

RUN mkdir -p /var/www/html/
RUN rm -rf /var/www/html/
RUN git clone https://github.com/ankitpipalia/Explore-Gujarat-Php.git /var/www/html

WORKDIR /var/www/html

RUN sed -i "s,listen = /run/php/php7.4-fpm.sock,listen = /var/run/php/www.sock,g" /etc/php/7.4/fpm/pool.d/www.conf
RUN mkdir -p /var/run/php
RUN touch /var/run/php/www.sock
RUN chown nginx:nginx /var/run/php/www.sock

ENTRYPOINT service php7.4-fpm start && /bin/bash
