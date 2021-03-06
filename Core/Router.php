<?php

namespace Core;
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

    // Convert variables with custom regular expressions e.g. {id:\d+}
    $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

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

  /**
   * @param $url
   *
   * @throws \Exception
   */
  public function dispatch($url){

    $url = $this->removeQueryStringVariables($url);

    if($this->match($url)){
      $controller = $this->params['controller'];
      $controller = $this->convertToStudlyCaps($controller);
      $controller = $this->getNamespace() . $controller;

      if(class_exists($controller)){
        $controllerObject = new $controller($this->params);

        $action = $this->params['action'];
        $action = $this->convertToCamelCase($action);

        if(preg_match('/action$/i', $action) == 0) {
          $controllerObject->$action();
        } else {
          throw new \Exception("Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method.");
        }

      } else {
        throw new \Exception("Controller class $controller not found");
      }

    } else {
      throw new \Exception('No route matched');
    }

  }

  /**
   * Convert the string with hyphens to StudlyCaps
   * @param $string
   *
   * @return string|string[]
   */
  private function convertToStudlyCaps($string) {
    return str_replace(' ','',ucwords(str_replace('-',' ',$string)));
  }

  /**
   * Convert string with hyphens to CamlCase
   * @param $string
   *
   * @return string
   */
  private function convertToCamelCase($string) {
    return lcfirst($this->convertToStudlyCaps($string));
  }

  /**
   * Remove the query string variables from the URL if any.
   *
   * @param $url
   */
  private function removeQueryStringVariables($url) {

    if($url != '') {
      $parts = explode('&',$url,2);

      if(strpos($parts[0],'=') === false){
        $url = $parts[0];
      } else {
        $url = '';
      }
    }

    return $url;

  }

  /**
   * get the namespace for the controller class.
   * The namespace defined in the route parameters is added if present
   */
  private function getNamespace() {

    $namespace = '\App\Controllers\\';

    if(array_key_exists('namespace', $this->params)) {
      $namespace .= $this->params['namespace'] . '\\';
    }

    return $namespace;

  }

}