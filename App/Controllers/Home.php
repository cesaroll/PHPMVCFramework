<?php

namespace App\Controllers;

use Core\View;

/**
 * Class Home
 *
 * @package App\Controllers
 */
class Home extends \Core\Controller {

  /**
   * Before filter
   */
  protected function before() {

    //echo '(before) ';
    //return false;
  }

  /**
   * After filter
   */
  protected function after() {

    //echo ' (after)';

  }

  /**
   * Show the index page
   */
  public function indexAction() {

    View::renderTemplate('Home/index.html', [
        'name' => 'Cesar',
        'colours' => ['red','green','blue']
    ]);

  }

}