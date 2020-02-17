<?php

namespace App\Controllers;

/**
 * Class Posts
 */
class Posts extends \Core\Controller {

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

  public function edit() {
    echo 'Hello from the edit action in the Posts controller';
    echo '<p>Route parameters: <pre>' .
         htmlspecialchars(print_r($this->routeParams, true)) . '</pre></p>';
  }

}