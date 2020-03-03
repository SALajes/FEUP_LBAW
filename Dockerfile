FROM php:7.2-apache
MAINTAINER up201708807@fe.up.pt

# Copy application source
COPY src /var/www/html/
