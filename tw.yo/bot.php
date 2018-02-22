<?php

require_once(__DIR__ . '/config.php');

use Abraham\TwitterOAuth\TwitterOAuth;

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

// $connection->setProxy([
//     'CURLOPT_PROXY' => '172.16.40.1',
//     'CURLOPT_PROXYUSERPWD' => '',
//     'CURLOPT_PROXYPORT' => 8888,
// ]);

// $content = $connection->get("account/verify_credentials");
// $content = $connection->get("statuses/home_timeline", 
//                               ['count' => 3]);

// var_dump($content);


$media = $connection->upload("media/upload", [
  'media' => __DIR__ . '/tw.jpg'
]);

if ($connection->getLastHttpCode() == 200) {
    // Tweet posted succesfully
    echo 'Success!' . PHP_EOL;
} else {
    // Handle error case
    echo 'Error!'. $media->errors[0]->message . PHP_EOL;
}

$res = $connection->post("statuses/update",[
  'status' => 'ボットからのテストツイートです。' . '(' . date('H:i:s') . ')',
  'media_ids' => $media->media_id
]);

if ($connection->getLastHttpCode() === 200) {
    // Tweet posted succesfully
    echo 'Success!' . PHP_EOL;
} else {
    // Handle error case
    echo 'Error!' . $res->errors[0]->message . PHP_EOL;
}