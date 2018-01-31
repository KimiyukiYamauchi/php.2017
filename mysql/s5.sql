drop table if exists users;
create table users (
  id int unsigned primary key auto_increment,
  name varchar(20),
  score float,
  rank enum('gold', 'silver', 'bronze')
);

-- desc users;

insert into users(name, score, rank) values
  ('やまうち', 5.8, 'silver');
insert into users(name, score, rank) values
  ('なつき', 8.8, 'gold');
insert into users(name, score, rank) values
  ('とうま', 3.5, 'bronze');

-- select * from users;
select * from users where rank = 'silver';
select * from users where rank = 1;