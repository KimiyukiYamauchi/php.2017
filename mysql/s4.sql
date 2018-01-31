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

-- select * from users where score >= 6.0;
-- select * from users where score >= 3.0 and score <= 6.0;
-- select * from users where score between 3.0 and 6.0;
-- select * from users where name = 'ざやす' or name = 'なつき';
-- select * from users where name in ('ざやす','なつき');
-- select * from users where name like '%ま';
-- select * from users where score is null;
-- select * from users where score is not null;
-- select * from users order by score desc limit 3 offset 1;


-- select * from users;

-- update users set score = 5.9;
-- update users set score = 5.9 where id = 2;
-- update users set score = 9.0, name = 'ふくだ' where id = 1;
-- update users set score = score * 1.2 where id % 2 = 0;


-- delete from  users;
-- delete from  users where score <= 5.0;

-- select * from users;

-- select round(5.355); -- 5
-- select round(5.355, 1); -- 5.4
-- select round(5.355, 2); -- 5.36
-- select floor(5.355); -- 5
-- select ceil(5.355); -- 6
-- select rand();

-- select * from users order by rand() limit 1;

select length('Hello');
select substr('Hello', 2);
select substr('Hello', 2, 2);
select upper('Hello');
select lower('Hello');
select concat('hello', 'world');