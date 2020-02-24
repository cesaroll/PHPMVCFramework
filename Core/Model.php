<?php


namespace Core;

use PDO;

abstract class Model {

  private $db;

  protected function getDB() {

    if($this->db === null) {
      $host = "localhost";
      $dbName = "mvc";
      $username = "mvcuser";
      $password = "mvcpassword";

      try {
        $this->db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
      }
      catch(\PDOException $e) {
        echo $e->getMessage();
      }
    }

    return $this->db;

  }

}