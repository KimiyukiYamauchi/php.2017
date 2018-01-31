/*
number:
- int
- float
- double
- int unsigned

string:
- char(4)
- varchar(255)
- text

date/time
- date
- time
- datetime '2018-01-29 21:30'

true/false
- boolean -> tinyint(1)
  - true -> 1
  - false -> 0

*/

drop table if exists users;
create table users (
  id int unsigned primary key auto_increment,
  name varchar(20),
  score float
);

show tables;

desc users;

insert into users(name, score) values
  ('やまうち', 5.8),
  ('ざやす', 8.2),
  ('おおしろ', 8.0),
  ('なつき', 8.8),
  ('とうま', 8.5);

select * from users;