<?php

// echo __DIR__;
// exit;

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/functions.php');
require_once(__DIR__ . '/Todo.php');

$todoApp = new \MyAPP\Todo();
$todos = $todoApp->getAll();

// var_dump($todos);
// exit;

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>My Todos</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div id="container">
    <h1>Todos</h1>
    <form action="">
      <input type="text" id="new_todo" placehholder="What needs to be done?">
    </form>
    <ul id="todos">
      <?php foreach( $todos as $todo) : ?>
      <li id="todo_<?php echo h($todo->id); ?>" data-id="<?php echo h($todo->id); ?>">
        <input type="checkbox" class="update_todo" <?php if($todo->state === '1') { echo 'checked'; } ?>>
        <span class="todo_title <?php if($todo->state === '1') { echo 'done'; } ?>"><?php echo h($todo->title); ?></span>
        <div class="delete_todo">x</div>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="todo.js"></script>
</body>
</html>