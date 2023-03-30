FROM phpmyadmin

RUN apt-get update -y 
RUN apt-get install -y git

RUN rm -rf /var/www/html/*
RUN rm /var/www/html/.rtlcssrc.json

RUN git clone https://github.com/ankitpipalia/Explore-Gujarat-Php.git /var/www/html
RUN chown -R $USER:$USER /var/www/html


ENTRYPOINT service apache2 restart && /bin/bash 

