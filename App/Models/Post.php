<?php


namespace App\Models;

use Core\Model;
use PDO;

/**
 * Post Model
 *
 * @package App\Models
 */
class Post extends Model {

  /**
   * Get all the posts as an associative array
   */
  public function getAll() {

    try {
      $db = $this->getDB();

      $stmt = $db->query('SELECT id, title, content FROM posts ORDER BY created_at');

      if($stmt) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
    }
    catch(\PDOException $e) {
      echo $e->getMessage();
    }

  }

}