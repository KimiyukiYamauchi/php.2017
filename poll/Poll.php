<?php

namespace MyApp;

class Poll {
  private $_db;

  public function __construct() {
    $this->_connectDB();
    Token::create();  // CSRF対策
  }

  public function post() {
    try {
      Token::validate('token'); // CSRF対策
      $this->_validateAnswer();
      $this->_save();
      header('location: http://' . $_SERVER['HTTP_HOST'] . '/poll/result.php');
    } catch(\Exception $e) {
      // set error
      $_SESSION['err'] = $e->getMessage();
      header('location: http://' . $_SERVER['HTTP_HOST'] . '/poll/index.php');
    }
    exit;
  }

  public function getResults() {
    $data = array_fill(0, 3, 0);

    $sql = "select answer, count(*) as c from answers group by answer";
    $rows = $this->_db->query($sql);
    foreach($rows as $row) {
      $data[$row['answer']] = (int)$row['c'];
    }

    // var_dump($data);
    // exit;
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
    $sql = "insert into answers (answer, created) values (:answer, now())";
    $stmt = $this->_db->prepare($sql);
    $stmt->bindValue(':answer', (int)$_POST['answer'], \PDO::PARAM_INT);
    $stmt->execute();
    // exit;

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