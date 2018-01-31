drop table if exists comments;
drop table if exists posts;
create table posts(
  id int unsigned primary key auto_increment,
  title varchar(255),
  body text
);
create table comments(
  id int unsigned primary key auto_increment,
  post_id int unsigned not null,
  body text,
  constraint fk_comments foreign key (post_id)
references posts(id)
);

desc comments;


insert into posts(title, body) values
('title 1', 'body 1'),
('title 2', 'body 2'),
('title 3', 'body 3');

insert into comments(post_id, body) values
(1, 'first comment for post 1');
insert into comments(post_id, body) values
(1, 'second comment for post 1');
insert into comments(post_id, body) values
(3, 'first comment for post 3');

/*select * from posts
-- inner join comments
-- left outer join comments
right outer join comments
on posts.id = comments.post_id;*/

delete from posts where id = 2;

-- select * from posts;
-- select * from comments;