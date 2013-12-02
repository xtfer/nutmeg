<?php
/**
 * @file
 * Contains a helper for reading YAML files.
 *
 * @copyright Copyright(c) 2013 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

namespace Nutmeg\Helpers;

use Symfony\Component\Yaml\Exception\ParseException;

/**
 * Class Yaml
 *
 * @package Nutmeg\Helpers
 */
class Yaml {

  /**
   * Parse a file formatted in YAML.
   *
   * @param string $file
   *   Path to the file to parse.
   *
   * @return mixed
   *   Result of the file parse operation.
   */
  static public function readFile($file) {

    try {

      $content = \Symfony\Component\Yaml\Yaml::parse($file);
    }
    catch (ParseException $e) {

      printf("Unable to load the YAML file successfully: %s", $e->getMessage());

      return FALSE;
    }

    return $content;
  }

}
