<?php


namespace Core;


class View {

  /**
   * Render a view
   *
   * @param $view
   */
  public static function render($view): void {

      $file = "../App/Views/$view";

      if (is_readable($file)) {
        require $file;
      } else {
        echo "$file not found";
      }
  }

}