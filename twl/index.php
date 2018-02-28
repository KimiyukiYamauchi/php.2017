<?php

require_once(__DIR__ . '/config.php');

$twitterLogin = new MyApp\TwitterLogin();

if ($twitterLogin->isLoggedIn()) {
  $me = $_SESSION['me'];

  $twitter = new MyApp\Twitter($me->tw_access_token, $me->tw_access_token_secret);
  $tweets = $twitter->getTweets();

  MyApp\Token::create();
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
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      </form>

      <h1>@<?= h($me->tw_screen_name); ?>'s Timeline</h1>

      <ul>
      <?php foreach ($tweets as $tweet) : ?>
        <li><?= $tweet->text; ?></li>
      <?php endforeach; ?>
      </ul>

    <?php else : ?>
      <div id="login">
        <a href="login.php"><img src="signin_button.png"></a>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>