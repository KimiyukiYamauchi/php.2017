<?php

require_once(__DIR__ . '/config.php');

$twitterLogin = new MyApp\TwitterLogin();

if ($twitterLogin->isLoggedIn()) {
  $me = $_SESSION['me'];
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Twitter Connect!</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div id="container">
    <h1>My Timeline</h1>
    <?php if ($twitterLogin->isLoggedIn()) : ?>
      
      <form action="logout.php" method="post" id="logout">
        <input type="submit" value="Log Out">
      </form>

      <h1>@<?= h($me->tw_screen_name); ?>'s Timeline</h1>
    <?php else : ?>
      <div id="login">
        <a href="login.php"><img src="signin_button.png"></a>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>