FROM nginx

SHELL ["/bin/bash", "-c"]
RUN apt-get update -y
RUN apt-get upgrade -y
RUN apt-get install git -y
RUN apt-get install php7.4-fpm php7.4-common php7.4-dom php7.4-intl php7.4-mysql php7.4-xml php7.4-xmlrpc php7.4-curl php7.4-gd php7.4-imagick php7.4-cli php7.4-dev php7.4-imap php7.4-mbstring php7.4-soap php7.4-zip php7.4-bcmath -y
RUN apt-get -y install mariadb-plugin-rocksdb && rm -rf /var/cache/apt/lists/*
RUN apt-get install mariadb-server -y
RUN apt-get --fix-broken install
RUN apt-get install expect -y

RUN rm -rf /var/www/html/
RUN git clone https://github.com/ankitpipalia/Explore-Gujarat-Php.git /var/www/html
RUN chmod 777 /var/www/html/script
RUN chmod 777 /var/www/html/script2

WORKDIR /var/www/html

RUN sed -i "s,listen = /run/php/php7.4-fpm.sock,listen = /var/run/php/www.sock,g" /etc/php/7.4/fpm/pool.d/www.conf
RUN mkdir -p /var/run/php
RUN touch /var/run/php/www.sock
RUN chown nginx:nginx /var/run/php/www.sock

ENTRYPOINT service php7.4-fpm start && /etc/init.d/nginx start && /etc/init.d/mariadb start && /var/www/html/script && /bin/bash
