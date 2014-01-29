<?php
/**
 * @file
 * Contains a custom Exception handler for Nutmeg.
 */

namespace Nutmeg\Error;


/**
 * Class NutmegException
 *
 * @package Nutmeg\Error
 */
class NutmegException extends \Exception {

  /**
   * @param null $message
   * @param null $code
   * @param null $file
   * @param null $line
   */
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
