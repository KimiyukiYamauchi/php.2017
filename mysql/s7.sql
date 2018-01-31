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

-- select name, score,
-- if( score > 6.0, 'OK', 'NG') as result
-- from users;

-- drop table if exists users_with_team;
-- create table users_with_team as
-- select id, name, score,
-- case
--   when score > 8.0 then 'Team-A'
--   when score > 6.0 then 'Team-B'
--   else 'Team-C'
-- end as team
-- from users;

-- select * from users_with_team;

create table users_empty as
select * from users where 1 = 2;

show tables;

desc users_empty;

select * from users_empty;