<?php


namespace Core;


class Error {

  /**
   * Erro handler. Convert all errors to exceptions  by throwing an error exception
   *
   * @param $level
   * @param $message
   * @param $file
   * @param $line
   *
   * @throws \ErrorException
   */
  public static function errorHandler($level, $message, $file, $line): void {
    if (error_reporting() !== 0) {
      throw new \ErrorException($message, 0, $level, $file, $line);
    }
  }


  public static function exceptionHandler($exception): void {
    echo "<h1>Fatal error</h1>";
    echo "<p>Uncaugth exception: '" . get_class($exception) . "'</p>";
    echo "<p>Message: '" . $exception->getMessage() . "'</p>";
    echo "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p>";
    echo "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";

  }

}