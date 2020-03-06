FROM php:7.2-apache

# Copy application sourc
WORKDIR /var/www/html/

COPY . /var/www/html/