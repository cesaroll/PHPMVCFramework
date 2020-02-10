<?php

/**
 * Router
 *
 */

class Router
{

  /**
   * Associative array of routes
   * @var array
   */
  protected $routes = [];

  /**
   * Add a route to the routing table
   *
   * @param string $route The route URL
   * @param array $parms Parameters (Controller, Action, etc)
   */
  public function add($route, $parms){
    $this->routes[$route] = $parms;
  }

  /**
   * Get all routes from the routing table
   *
   * @return array
   */
  public function getRoutes(){
    return $this->routes;
  }

}