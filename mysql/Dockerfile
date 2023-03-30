FROM mariadb

ENV MYSQL_ROOT_PASSWORD=root1234

RUN service mysql start && \
     mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '${MYSQL_ROOT_PASSWORD}'; FLUSH PRIVILEGES; CREATE DATABASE gujarat;"

COPY gujarat_database.sql /docker-entrypoint-initdb.d/

RUN service mysql start && \
    mysql < /docker-entrypoint-initdb.d/database.sql

ENTRYPOINT /bin/bash
