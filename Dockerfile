FROM webdevops/php-apache-dev:7.0

EXPOSE 80 9000

ADD . /var/www/html

RUN rm /var/www/html/index.html