drop table if exists users;
create table users (
  id int unsigned primary key auto_increment,
  name varchar(20),
  score float
);

desc users;

-- alter table users add column email varchar(255);
alter table users add column email varchar(255) after name;
alter table users drop column score;
alter table users change name user_name varchar(80) default 'nobody';

desc users;

alter table users rename persons;

show tables;