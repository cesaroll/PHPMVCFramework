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
   * PArameters from the matched route
   * @var array
   */
  protected $params = [];

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

  /**
   * Match the route to the routes in the routing table, setting the $params
   * property if a route is found.
   *
   * @param string $url The route url
   *
   * @return bool true if a match is found, false otherwise
   */
  public function match($url): bool {

    /*foreach($this->routes as $route => $params){
      if($url == $route){
        $this->params = $params;
        return true;
      }
    }*/

    // Match to the fixed URl format /controller/action
    $regExp = "/^(?P<Controller>[a-zA-Z0-9-]+)\/(?P<Action>[a-zA-Z0-9-]+)$/";

    if(preg_match($regExp, $url, $matches)){
      // get named capture group values
      $params = [];

      foreach($matches as $key => $match){
        if(is_string($key)){
          $params[$key] = $match;
        }
      }

      $this->params = $params;
      return true;

    }

    return false;

  }

  /**
   * Get the currently matched parameters
   *
   * @return array
   */
  public function getParams(){
    return $this->params;
  }

}