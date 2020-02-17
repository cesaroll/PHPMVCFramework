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

}