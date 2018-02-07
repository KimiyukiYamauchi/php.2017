<?php

namespace MyAPP;

class Todo {
  private $_db;

  public function __construct() {
    try {
      $this->_db = new \PDO(DSN, DB_USERNAME, DB_PASSWORD);
      $this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);


    } catch (\PDOException $e) {
      echo $e->getMessage();
      exit;
    }

  }

  public function getAll() {
    $stmt = $this->_db->query("select * from todos order by id desc");
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  public function post() {
    if(!isset($_POST['mode'])) {
      throw new \Exception('mode not set!');
    }

    switch($_POST['mode']) {
      case 'update':
        return $this->_update();
      case 'create':
        return $this->_create();
      case 'delete':
        return $this->_delete();
    }
  }


  private function _update() {
    
  }
  private function _create() {
    
  }
  private function _delete() {

  }
}