<?php

namespace MyApp;

class Poll {
  private $_db;

  public function __construct() {
    $this->_connectDB();
    Token::create();
  }

  public function post() {
    try {
      Token::validate('token');
      $this->_validateAnswer();
      $this->_save();
      // redirect to result.php
      header('location: http://' . $_SERVER['HTTP_HOST'] . '/poll.yo/result.php');

    } catch(\Exception $e) {
      // set error
      $_SESSION['err'] = $e->getMessage();
      // redirect to index.php
      header('location: http://' . $_SERVER['HTTP_HOST'] . '/poll.yo/index.php');
    }
    exit;
  }

  public function getResult() {
    $data = array_fill(0, 3, 0);

    $sql = "select answer, count(id) as c from answers group by answer";
    foreach($this->_db->query($sql) as $row) {
      $data[$row['answer']] = (int)$row['c'];
    }

    return $data;
  }

  public function getError() {
    $err = null;
    if (isset($_SESSION['err'])) {
      $err = $_SESSION['err'];
      unset($_SESSION['err']);
    }
    return $err;
  }

  private function _validateAnswer() {
    // var_dump($_POST);
    // exit;
    if (
      !isset($_POST['answer']) ||
      !in_array($_POST['answer'], [0, 1, 2])
    ) {
      throw new \Exception('invalid answer!');
    }
  }

  private function _save() {
    $sql = "insert into answers (answer, created, remote_addr, user_agent, answer_date) values(:answer, now(), :remote_addr, :user_agent, now())";
    $stmt = $this->_db->prepare($sql);
    $stmt->bindValue(':answer', (int)$_POST['answer'], \PDO::PARAM_INT);
    $stmt->bindValue(':remote_addr', $_SERVER['REMOTE_ADDR'], \PDO::PARAM_STR);
    $stmt->bindValue(':user_agent', $_SERVER['HTTP_USER_AGENT'], \PDO::PARAM_STR);

    try {
      $stmt->execute();
    } catch (\PDOException $e) {
      throw new \Exception('No more vote for today!');
    }
    // exit;

  }

  private function _connectDB() {
    try {
      $this->_db = new \PDO(DSN, DB_USERNAME, DB_PASSWORD);
      $this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    } catch (\PDOException $e) {
      throw new \Exception('Failed to connect DB');
    }

  }

}