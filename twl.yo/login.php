<?php

require_once(__DIR__ . '/config.php');

$twitterlogin = new MyApp\TwitterLogin();

try {
  $twitterlogin->login();

}catch (Exception $e) {
  echo $e->getMessage();
  exit;
}