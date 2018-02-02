<?php

define('DB_DATABASE', 'myapp');
define('DB_USERNAME', 'myapp');
define('DB_PASSWORD', 'pass');
define('PDO_DSN', 'mysql:dbhost=localhost;dbname=' . DB_DATABASE . ';charset=utf8');

class User {

  public function show() {
    echo "$this->name($this->score)" . '<br>';
  }
}

try {

  $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  /*
  (1) exec(): 結果を返さない、安全なSQL文を実行
  (2) query(): 結果を返す、安全なSQL文を実行
  (3) prepare(): 結果を返す、安全対策が必要なSQL文を実行
  */
 
 $db->beginTransaction();
 
 // update
  $stmt  = $db->prepare("update users set score = :score where name = :name");
  $stmt->execute([
    ':score' => 0,
    ':name' => 'やまうち'
  ]);

  echo $stmt->rowCount() . ' records updated<br>';

  // delete
  $stmt = $db->prepare("delete from users where name = :name");
  $stmt->execute([
    ':name' => 'なかま'
  ]);

  echo $stmt->rowCount() . ' records deleteded';

  $db->commit();


  // select
  // $stmt = $db->query('select * from users');
  // $stmt = $db->prepare('select * from users where score > ?');
  // $stmt->execute([70]);
  // $stmt = $db->prepare('select * from users where name like ?');
  // $stmt->execute(['%ま%']);
  // $stmt->bindValue(1, '%や%', PDO::PARAM_STR);
  // $stmt->bindParam(1, $name, PDO::PARAM_STR);
  // $name = '%ち%';
  // $stmt->execute();

  // $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
  // $users = $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
  // foreach ($users as $user) {
  //   // var_dump($user);
  //   $user->show();
  // }
  
  // var_dump($users);


  // insert
  // $db->exec("insert into users(name, score) values('やまうち', 55)");
  
  // $stmt = $db->prepare("insert into users(name, score) values(?,?)");
  // $stmt->execute(['ざやす', 80]);
  
  // $stmt = $db->prepare("insert into users(name, score) values(:name, :score)");
  // $stmt->execute([':name' => 'なつき', ':score' => 80]);

  // $stmt = $db->prepare("insert into users(name, score) values(:name, :score)");
  // $stmt->execute([':name' => 'とうま', ':score' => 80]);
  // $stmt->execute([':name' => 'とうま', ':score' => 90]);
  // $stmt->execute([':name' => 'とうま', ':score' => 50]);

  // $name = 'なかま';
  // $stmt->bindValue(':name', $name, PDO::PARAM_STR);
  // $stmt->bindParam(':score', $score, PDO::PARAM_INT);
  // $score = 80;
  // $stmt->execute();
  // $score = 88;
  // $stmt->execute();
  // $score = 55;
  // $stmt->execute();


  // $stmt->bindValue(':score', $score, PDO::PARAM_INT);
  // $stmt->execute();
  // $score = 90;
  // $stmt->bindValue(':score', $score, PDO::PARAM_INT);
  // $stmt->execute();
  // $score = 50;
  // $stmt->bindValue(':score', $score, PDO::PARAM_INT);
  // $stmt->execute();

  // PDO::PARAM_NULL
  // PDO::PARAM_BOOL

  // echo 'user added! : ' . $db->lastInsertId();

  // disconnect
  $db = null;

} catch (PDOException $e) {
  $db->rollback();
  echo $e->getMessage();
  exit;
}