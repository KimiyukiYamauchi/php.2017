<?php

namespace MyApp;

class Poll {
  private $_db;

  public function __construct() {
    $this->_connectDB();
  }

  public function post() {
    try {
      $this->_validateAnswer();
      $this->_save();
      header('location: http://' . $_SERVER['HTTP_HOST'] . '/poll/result.php');
    } catch(\Exception $e) {
      // set error
      header('location: http://' . $_SERVER['HTTP_HOST'] . '/poll/index.php');
    }
    exit;
  }

  private function _validateAnswer() {
    var_dump($_POST);
    exit;

  }

  private function _save() {

  }

  private function _connectDB() {
    try {
      $this->_db = new \PDO(DSN, DB_USERNAME, DB_PASSWORD);
      $this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    } catch(\PDOException $e) {
      throw new \Exception('Failed to connect DB');
    }
  }

}