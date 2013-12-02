<?php
/**
 * @file
 * Contains a helper for working with Files.
 *
 * @copyright Copyright(c) 2013 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

namespace Nutmeg\Helpers;


/**
 * Class File
 *
 * @package Nutmeg\Helpers
 */
class File {

  /**
   * @param $exercise_name
   * @param $exercise_file
   *
   */
  static public function loadExerciseFile($exercise_name, $exercise_file) {

    $exercise_link = self::pathToExercise($exercise_name, $exercise_file);
    include_once NUTMEG_ROOT . $exercise_link;
  }

  /**
   * @param $exercise_id
   * @param $exercise_file
   *
   * @return string
   */
  static public function pathToExercise($exercise_id, $exercise_file) {

    $exercise_link = '/exercises/' . $exercise_id . '/' . $exercise_file;

    return $exercise_link;
  }
}
