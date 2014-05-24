<?php
/**
 * @file
 * Contains the Error Handler class.
 */

namespace Nutmeg\Error;


/**
 * Class NutmegErrorHandler
 *
 * @package Nutmeg\Controllers
 */
class NutmegErrorHandler {

  /**
   * Setup custom error options.
   */
  static public function setErrorOptions() {

    error_reporting(-1);
    assert_options(ASSERT_ACTIVE, 1);
    assert_options(ASSERT_WARNING, 0);
    assert_options(ASSERT_BAIL, 0);
    assert_options(ASSERT_QUIET_EVAL, 0);
    assert_options(ASSERT_CALLBACK, '\Nutmeg\Error\NutmegErrorHandler::assertCallback');
    set_error_handler('\Nutmeg\Error\NutmegErrorHandler::errorHandler');
    set_exception_handler('\Nutmeg\Error\NutmegErrorHandler::exceptionHandler');
    register_shutdown_function('\Nutmeg\Error\NutmegErrorHandler::shutdownHandler');
  }

  /**
   * Custom assert callback.
   */
  static public function assertCallback($file, $line, $message) {

    throw new NutmegException($message, NULL, $file, $line);
  }

  /**
   * Custom error handler.
   */
  static public function errorHandler($errno, $error, $file, $line, $vars) {

    if ($errno === 0 || ($errno & error_reporting()) === 0) {
      return;
    }

    throw new NutmegException($error, $errno, $file, $line);
  }

  /**
   * Custom Exception Handler.
   */
  static public function exceptionHandler(\Exception $e) {

    print '<h1>Error</h1>';

    print '<h2>Message</h2>';
    ladybug_dump($e->getMessage());

    print '<h2>Backtrace</h2>';
    ladybug_dump($e->getTrace());

    exit;
  }

  /**
   * Custom shutdown handler.
   */
  static public function shutdownHandler() {

    try {
      if (NULL !== $error = error_get_last()) {
        throw new NutmegException($error['message'], $error['type'], $error['file'], $error['line']);
      }
    }
    catch (\Exception $e) {
      static::exceptionHandler($e);
    }
  }
}
