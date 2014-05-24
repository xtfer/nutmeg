<?php
/**
 * @file
 * Contains a helper for secure text handling.
 *
 * @copyright Copyright(c) 2013 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

namespace Nutmeg\Helpers;

/**
 * Class Security
 *
 * @package Nutmeg\Helpers
 */
class Security extends Helper {

  /**
   * Clean input.
   *
   * @param string $input
   *   The string to parse.
   *
   * @return string
   *   A string passed through htmlspecialchars().
   */
  static public function cleanInput($input) {
    if (empty($input)) {
      return '';
    }

    if (!is_string($input)) {
      return (string) $input;
    }

    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
  }
}
