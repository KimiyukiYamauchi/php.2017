create database poll;

grant all on poll.* to dbuser@localhost;

use poll;

drop table if exists answers;
create table answers (
  id int not null auto_increment primary key,
  answer int not null,
  created datetime,
  remote_addr varchar(15),
  user_agent varchar(255),
  answer_date date,
  unique unique_answer(remote_addr, user_agent, answer_date)
);