#MARIA DB

CREATE USER '[project_name]'@'%' IDENTIFIED BY '[db_password]';
create database [project_name] character set utf8mb4;
grant all privileges on [project_name].* to '[project_name]'@'%';
flush privileges;


# MYSQL

CREATE USER '[project_name]'@'%' IDENTIFIED WITH mysql_native_password BY '[db_password]';
create database [project_name] character set utf8mb4;
grant all privileges on [project_name].* to '[project_name]'@'%';
flush privileges;


# PSQL

CREATE ROLE [project_name] WITH LOGIN PASSWORD '[project_name]';
CREATE DATABASE [project_name] WITH OWNER [project_name] ENCODING 'utf8';
