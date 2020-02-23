<?php


namespace Core;


class View {

  /**
   * Render a view
   *
   * @param $view
   */
  public static function render($view, $args = []): void {

      extract($args, EXTR_SKIP);

      $file = "../App/Views/$view";

      if (is_readable($file)) {
        require $file;
      } else {
        echo "$file not found";
      }
  }

  /**
   * Render a view template using Twig
   *
   * @param       $template
   * @param array $args
   */
  public static function renderTemplate($template, $args = []) {

    static $twig = null;

    if($twig === null) {
      $loader = new \Twig\Loader\FilesystemLoader('../App/Views');
      $twig = new \Twig\Environment($loader);
      /*$twig = new \Twig\Environment($loader, [
          'cache' => '../.cache'
      ]);*/
    }

    echo $twig->render($template, $args);

  }

}