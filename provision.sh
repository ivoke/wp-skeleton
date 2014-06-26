#!/usr/bin/env bash

# Update Package List

apt-get update

apt-get upgrade -y

# Provision the VM

# Install PPAs

sudo apt-get install python-software-properties -y
sudo apt-add-repository ppa:ondrej/php5
sudo add-apt-repository ppa:git-core/ppa

# Update Package Lists

apt-get update

# Install Some Basic Packages

apt-get install -y vim curl git libmcrypt4 libpcre3-dev

# Install Apache
apt-get install -y apache2
apt-get install -y libapache2-mod-php5

# Install PHP Stuffs

apt-get install -y php5 php5-cli php5-dev php5-fpm php5-cgi
apt-get install -y php5-mysql php5-xmlrpc php5-curl php5-gd php-apc php-pear php5-imap php5-mcrypt php5-pspell

# Make MCrypt Available

ln -s /etc/php5/conf.d/mcrypt.ini /etc/php5/mods-available
sudo php5enmod mcrypt

# Install MySQL

debconf-set-selections <<< "mysql-server mysql-server/root_password password secret"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password secret"
apt-get install -y mysql-server

# Configure MySQL Remote Access

sed -i '/^bind-address/s/bind-address.*=.*/bind-address = 10.0.2.15/' /etc/mysql/my.cnf
mysql --user="root" --password="secret" -e "GRANT ALL ON *.* TO root@'10.0.2.2' IDENTIFIED BY 'secret';"
service mysql restart

mysql --user="root" --password="secret" -e "CREATE USER 'skeleton'@'10.0.2.2' IDENTIFIED BY 'secret';"
mysql --user="root" --password="secret" -e "GRANT ALL ON *.* TO 'skeleton'@'10.0.2.2' IDENTIFIED BY 'secret';"
mysql --user="root" --password="secret" -e "GRANT ALL ON *.* TO 'skeleton'@'%' IDENTIFIED BY 'secret';"
mysql --user="root" --password="secret" -e "FLUSH PRIVILEGES;"
mysql --user="root" --password="secret" -e "CREATE DATABASE skeleton;"
service mysql restart

# Setup Apache

rm /etc/apache2/sites-enabled/000-default
rm /etc/apache2/sites-enabled/skeleton # Remove vhost file, so provision can run multiple times.

touch /etc/apache2/sites-enabled/skeleton

echo '<VirtualHost *:80>
  DocumentRoot "/skeleton"
</VirtualHost>' >> /etc/apache2/sites-enabled/skeleton

ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load # Enable rewirte mod

service apache2 restart

# Install PhpMyAdmin
sudo apt-get install phpmyadmin

# Switch To Project Dir

cd /skeleton

# Fetch Git Submodules

#git submodule init
#git submodule update

# Remove Git

#find . -type d | grep -i "\.git$" | xargs rm -rf

# Initialize Git Again

#git init
#git add -A
#git commit -am 'Intial Commit'

# Run Composer

curl -sS https://getcomposer.org/installer | php

php composer.phar install
