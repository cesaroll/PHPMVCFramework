<?php


namespace Core;

use PDO;
use App\Config;

abstract class Model {

  private $db;

  protected function getDB() {

    if($this->db === null) {
      $host = "localhost";
      $dbName = "mvc";
      $username = "mvcuser";
      $password = "mvcpassword";

      try {
        $this->db = new PDO('mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8',
                            Config::DB_USER, Config::DB_PASSWORD);
      }
      catch(\PDOException $e) {
        echo $e->getMessage();
      }
    }

    return $this->db;

  }

}