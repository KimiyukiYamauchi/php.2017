<?php

namespace MyApp;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterLogin {

  public function login() {

    if (!isset($_GET['oauth_token']) || !isset($_GET['oauth_verifier'])) {
      $this->_redirectFlow();
    } else {
      $this->_callbackFlow();
    }
  }

  private function _callbackFlow() {
    if ($_GET['oauth_token'] !== $_SESSION['oauth_token']) {
      throw new \Exception('Invalid oauth_token');
    }

    $conn = new TwitterOAuth(
      CONSUMER_KEY,
      CONSUMER_SECRET,
      $_SESSION['oauth_token'],
      $_SESSION['oauth_token_secret']
    );

    $tokens = $conn->oauth('oauth/access_token', [
        'oauth_verifier' => $_GET['oauth_verifier']
    ]);

    // var_dump($tokens);
    // exit;

    $user = new User();
    $user->saveTokens($tokens);
    echo 'tokens saved';
    exit;

    $_SESSION['me'] = $user->getUser($tokens['user_id']);

    unset($_SESSION['oauth_token']);
    unset($_SESSION['oauth_token_secret']);
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