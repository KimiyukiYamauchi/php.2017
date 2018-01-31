#
--
/*

*/
drop database if exists myapp;
create database myapp character set utf8;
grant all on myapp.* to myapp@localhost identified by 'pass';