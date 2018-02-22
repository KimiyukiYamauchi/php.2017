<?php

namespace MyApp;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterLogin {

  public function login() {
    $this->_redirectFlow();
  }

  private function _redirectFlow() {
    $conn = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

    // request token
    $tokens = $conn->oauth('oauth/request_token', [
      'oauth_callback' => CALLBACK_URL
    ]);

    // save token
    $_SESSION['oauth_token'] = $tokens['oauth_token'];
    $_SESSION['oauth_token_secret']  = $tokens['oauth_token_secret'];

    // redirect
    $authorizedUrl = $conn->url('oauth/authorize', [
      'oauth_token' => $tokens['oauth_token']
    ]);
    header('Location: ' . $authorizedUrl);
    exit;
  }
}