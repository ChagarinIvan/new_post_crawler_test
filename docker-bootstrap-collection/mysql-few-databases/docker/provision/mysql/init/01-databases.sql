# create databases
CREATE DATABASE IF NOT EXISTS `laravel`;
CREATE DATABASE IF NOT EXISTS `laravel_test`;

# create root user and grant rights
CREATE USER 'root'@'localhost' IDENTIFIED BY 'laravel';
GRANT ALL ON *.* TO 'root'@'%';
