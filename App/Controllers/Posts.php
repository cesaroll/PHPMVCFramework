<?php

namespace App\Controllers;

/**
 * Class Posts
 */
class Posts{

  /**
   * Show the index page
   */
  public function index(){
    echo 'Hello from the index action in the Posts controller';
    echo '<p>Query string parameters: <pre>' .
         htmlspecialchars(print_r($_GET,true)) . '</pre></p>';
  }

  /**
   * Show the add new page
   */
  public function addNew(){
    echo 'Hello from the addNew action in the Posts controller';
  }

}