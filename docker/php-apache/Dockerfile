FROM php:8.1-apache

ARG AMBIENTE

RUN apt-get update

RUN mkdir /var/log/ispconfig
RUN mkdir /var/log/ispconfig/httpd/

RUN apt-get install nano
RUN apt-get install -y libzip-dev

RUN apt-get update -y
RUN apt-get install -y poppler-utils

RUN docker-php-ext-configure zip
RUN docker-php-ext-install mysqli pdo pdo_mysql zip calendar

RUN apt-get -y update
RUN apt-get install -y libicu-dev
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install pcntl

RUN apt-get update -y && apt-get install -y libpng-dev
RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev 
RUN docker-php-ext-install gd

RUN rm -rf /var/www/html/*

COPY ./conf/projetos.conf /etc/apache2/sites-available/projetos.conf

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf &&\
    a2enmod rewrite &&\
    a2dissite 000-default &&\
    a2ensite projetos &&\
    service apache2 restart

EXPOSE 80
EXPOSE 443

WORKDIR /var/www/html