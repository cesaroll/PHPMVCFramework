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
   * @param array  $params
   */
  public function add($route, $params = []){
    // Convert the route to a regular expression: escape forward slashes
    $route = preg_replace('/\//', '\\/', $route); // Replaces: "/" with: "\/"

    // Convert variables e.g. {controller}
    $route = preg_replace('/\{([a-z-]+)\}/', '(?P<\1>[a-z-]+)', $route);

    //Add start and end delimiters, amd case insensitive flag
    $route = '/^' . $route . '$/i';

    $this->routes[$route] = $params;

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

    foreach($this->routes as $route => $params){

      if(preg_match($route, $url, $matches)){
        // Get named capture group values

        foreach($matches as $key => $match){
          if(is_string($key)){
            $params[$key] = $match;
          }
        }

        $this->params = $params;
        return true;

      }

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