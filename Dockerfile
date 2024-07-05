# Use a imagem oficial do Ubuntu como base
FROM ubuntu:latest

# Atualize o sistema e instale pacotes desejados
RUN apt-get update
RUN apt-get install unzip -y
RUN apt-get install curl -y
RUN apt-get install wget -y
RUN apt update
RUN apt-get install software-properties-common -y
RUN apt update
RUN ln -snf /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime && echo $America/Sao_Paulo > /etc/timezone
RUN apt-get install -y apache2 
RUN apt-get install -y php
RUN apt-get install -y php-mysql
RUN apt-get install -y php-mbstring
RUN apt-get install -y php-xml
RUN apt-get install -y php-fpm
RUN apt update
RUN apt-get install -y php-zip
RUN apt-get install -y php-common
RUN apt-get install -y php-cli
RUN apt-get install -y php-curl
RUN apt-get update
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm composer-setup.php
RUN apt-get install vim -y
RUN apt-get install nginx -y
RUN a2enmod rewrite
RUN a2enmod headers
RUN a2enmod ssl
# Define o diretório de trabalho padrão
EXPOSE 80

WORKDIR /var/www/html

ENTRYPOINT /etc/init.d/apache2 start && /bin/bash

CMD [ "true" ]