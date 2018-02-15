create database poll;

grant all on poll.* to dbuser@localhost;

use poll;

create table answers (
  id int not null auto_increment primary key,
  answer int not null,
  created datetime
);