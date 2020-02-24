<?php

namespace App\Controllers;

use \Core\View;
use \App\Models;

/**
 * Class Posts
 */
class Posts extends \Core\Controller {

  /**
   * Show the index page
   */
  public function indexAction(){

    $postModel = new Models\Post();
    $posts = $postModel->getAll();

    View::renderTemplate('Posts/index.html', [
        'posts' => $posts
    ]);
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