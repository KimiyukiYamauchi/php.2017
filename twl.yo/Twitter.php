<?php

namespace MyApp;

use Abraham\TwitterOAuth\TwitterOAuth;
use Abraham\TwitterOAuth\TwitterOAuth\TwitterOAuthException;

class Twitter {
  private $_conn;

  public function __construct($accessToken, $accessTokenSecret) {
    $this->_conn = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $accessToken, $accessTokenSecret);
  }

  public function getTweets() {
    try {
      // $tweets = $this->_conn->get('statuses/home_timeline', [
      $tweets = $this->_conn->get('statuses/user_timeline', [
        'count' => 5,
        'screen_name' => $_SESSION['me']->tw_screen_name
      ]);
    } catch (TwitterOAuthException $e) {
      echo 'Failed to load timeline';
      exit;
    }
    return $tweets;
  }
}