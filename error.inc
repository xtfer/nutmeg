<?php
/**
 * @file
 * Main file for the Nutmeg app.
 *
 * @copyright Copyright(c) 2013 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

/**
 * Catch all errors.
 *
 * This code was found on StackOverflow, at
 * http://stackoverflow.com/questions/888/how-do-you-debug-php-scripts/1058375#1058375
 * and was written by Martin Zottman:
 * http://stackoverflow.com/users/113154/eisberg
 *
 * @todo refactor into more appropriate structure
 */

error_reporting(-1);
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_BAIL, 0);
assert_options(ASSERT_QUIET_EVAL, 0);
assert_options(ASSERT_CALLBACK, 'assert_callback');
set_error_handler('error_handler');
set_exception_handler('exception_handler');
register_shutdown_function('shutdown_handler');

function assert_callback($file, $line, $message) {

  throw new Customizable_Exception($message, NULL, $file, $line);
}

function error_handler($errno, $error, $file, $line, $vars) {

  if ($errno === 0 || ($errno & error_reporting()) === 0) {
    return;
  }

  throw new Customizable_Exception($error, $errno, $file, $line);
}

function exception_handler(Exception $e) {

  // Do what ever!
  echo '<pre>', print_r($e, TRUE), '</pre>';
  exit;
}

function shutdown_handler() {

  try {
    if (NULL !== $error = error_get_last()) {
      throw new Customizable_Exception($error['message'], $error['type'], $error['file'], $error['line']);
    }
  }
  catch (Exception $e) {
    exception_handler($e);
  }
}

class Customizable_Exception extends Exception {

  public function __construct($message = NULL, $code = NULL, $file = NULL, $line = NULL) {

    if ($code === NULL) {
      parent::__construct($message);
    }
    else {
      parent::__construct($message, $code);
    }
    if ($file !== NULL) {
      $this->file = $file;
    }
    if ($line !== NULL) {
      $this->line = $line;
    }
  }
}