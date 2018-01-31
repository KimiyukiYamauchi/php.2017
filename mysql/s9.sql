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

select * from users;

start transaction;
update users set score = score * 1.2 where name = 'やまうち';
update users set score = score * 1.2 where name = 'とうま';
select * from users;
-- rollback;
commit;
select * from users;