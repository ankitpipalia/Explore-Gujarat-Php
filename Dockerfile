FROM phpmyadmin/phpmyadmin:5.1.1
 
RUN apt-get update -y 
RUN apt-get install -y git

RUN rm -rf /var/www/html/*

RUN git clone https://github.com/ankitpipalia/Explore-Gujarat-Php.git /var/www/html

RUN service apache2 restart
