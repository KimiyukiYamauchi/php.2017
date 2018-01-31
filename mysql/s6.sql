drop table if exists users;
create table users (
  id int unsigned primary key auto_increment,
  name varchar(20),
  score float,
  coins set('gold', 'silver', 'bronze')
);

-- desc users;

insert into users(name, score, coins) values
  ('やまうち', 5.8, 'gold,silver');
insert into users(name, score, coins) values
  ('なつき', 8.8, 'bronze,gold');
insert into users(name, score, coins) values
  ('とうま', 3.5, 'gold,silver,bronze');
insert into users(name, score, coins) values
  ('おおしろ', 3.5, 'silver,bronze');

-- select * from users;
-- select * from users where coins = 'gold,silver';
-- select * from users where coins like '%gold%';
select * from users where coins = 6;