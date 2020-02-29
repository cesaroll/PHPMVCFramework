<?php

namespace Core;

/**
 * Base Controller
 *
 * @package Core
 */
abstract class Controller {

  /**
   * Parameters from the matched route
   *
   * @var array
   */
  protected $routeParams = [];

  /**
   * Controller constructor.
   *
   * @param $routeParams
   */
  public function __construct($routeParams) {
    $this->routeParams = $routeParams;
  }

  /**
   * @param $name
   * @param $arguments
   */
  public function __call($name, $args) {

    $method = $name . 'Action';

    if(method_exists($this, $method)) {
      if($this->before() !== false) {
        call_user_func_array([$this, $method], $args);
        $this->after();
      }
    } else {
      throw new \Exception("Method $method not found in controller" . get_class($this));
    }

  }

  /**
   * Before filter - called before an action method
   */
  protected function before() {

  }

  /**
   * After filter - called after an action method
   */
  protected function after() {

  }

}