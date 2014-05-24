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
 * Class ExerciseFileLoader
 *
 * @package Nutmeg\Helpers
 */
class ExerciseFileLoader extends FileLoader {

  /**
   * Load an exercise file.
   *
   * @param string $exercise_name
   *   Name of the exercise.
   * @param string $exercise_file
   *   ExerciseFileLoader name.
   */
  public function loadExerciseFile($exercise_name, $exercise_file) {

    $exercise_link = $this->pathToExercise($exercise_name, $exercise_file);

    $this->loadFile($exercise_link);
  }

  /**
   * Get the path to an exercise.
   *
   * @param string $exercise_id
   *   Identifier of the exercise.
   * @param array $exercise_file
   *   ExerciseFileLoader name.
   *
   * @return string
   *   Path to the file.
   */
  static public function pathToExercise($exercise_id, $exercise_file) {

    $exercise_link = 'exercises/' . $exercise_id . '/' . $exercise_file;

    return $exercise_link;
  }
}
