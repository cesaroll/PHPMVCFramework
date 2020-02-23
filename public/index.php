<?php

/**
 * Twig
 */
require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Autoloader
 */
spl_autoload_register(function ($class){

  $root = dirname(__DIR__); //Get the parent folder
  $file = $root . '/' . str_replace('\\','/',$class) . '.php';

  if(is_readable($file)) {
    require $root . '/' . str_replace('\\','/',$class) . '.php';
  }

});



$router = new Core\Router();

//echo get_class($router);

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

/*
// Display the routing table
echo '<pre>';
echo htmlspecialchars(print_r($router->getRoutes(), true));
echo '</pre>';

// Match the requested route
$url = $_SERVER['QUERY_STRING'];

if($router->match($url)){
    echo '<pre>';
  var_dump($router->getParams());
  echo '</pre>';
} else {
    echo "No route found for URL '$url'";
}
*/
$router->dispatch($_SERVER['QUERY_STRING']);
