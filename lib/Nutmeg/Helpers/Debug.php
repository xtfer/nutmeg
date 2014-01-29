<?php
/**
 * @file
 * Provides a debugging helper.
 */

namespace Nutmeg\Helpers;


/**
 * Class Debug
 *
 * @package Nutmeg\Helpers
 */
class Debug {

  /**
   * Dump values.
   *
   * @param mixed $values
   *   The values to dump.
   */
  static public function dump($values) {

    if (function_exists('ladybug_dump')) {
      ladybug_dump($values);
    }
    elseif (function_exists('var_dump')) {
      var_dump($values);
    }
    else {
      print_r($values);
    }
  }

}
