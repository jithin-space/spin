#!/bin/bash

# step1--install necessary packages

apt-get update

apt-get install apache2 sqlite3 php7.0 php7.0-cli php7.0-common php7.0-sqlite3 php7.0-xml php7.0-xml mongodb-server php7.0-mongodb -y

# step2 -- place the code in proper location

mkdir /var/www/html/extras

cp -av extras/ /var/www/html/extras/

rm /etc/apache2/sites-enabled/000-default.conf 

mv /var/www/html/extras/000-default.conf /etc/apache2/sites-enabled/000-default.conf

a2enmod rewrite

service apache2 restart

chown -R www-data:www-data /var/www/html


