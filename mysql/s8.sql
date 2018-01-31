drop table if exists users;
create table users (
  id int unsigned primary key auto_increment,
  name varchar(20),
  score float
);

insert into users(name, score) values
  ('やまうち', 5.8),
  ('ざやす', 8.2),
  ('おおしろ', 6.1),
  ('なつき', 4.2),
  ('なかま', null),
  ('とうま', 7.9);


drop view if exists top3;
create view top3 as
select * from users order by score desc limit 3;

-- show tables;
show create view top3;

-- select * from top3;