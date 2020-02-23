<?php

namespace App\Controllers;

use \Core\View;

/**
 * Class Posts
 */
class Posts extends \Core\Controller {

  /**
   * Show the index page
   */
  public function indexAction(){
    View::renderTemplate('Posts/index.html');
  }

  /**
   * Show the add new page
   */
  public function addNewAction(){
    echo 'Hello from the addNew action in the Posts controller';
  }

  public function editAction() {
    echo 'Hello from the edit action in the Posts controller';
    echo '<p>Route parameters: <pre>' .
         htmlspecialchars(print_r($this->routeParams, true)) . '</pre></p>';
  }

}