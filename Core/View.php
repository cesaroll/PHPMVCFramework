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

}