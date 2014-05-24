<?php
/**
 * @file
 * Contains a helper for evaluating code.
 *
 * @copyright Copyright(c) 2013 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

namespace Nutmeg\Helpers;


/**
 * Class CodeEvaluator
 *
 * @package Nutmeg\Helpers
 */
class CodeEvaluator extends Helper {

  /**
   * Evaluate an exercise file.
   *
   * @param string $exercise_id
   *   Identifier of the exercise.
   * @param array $exercise_settings
   *   The settings for the exercise.
   *
   * @return string
   *   The file to evaluate.
   */
  public function evaluate($exercise_id, $exercise_settings) {

    try {
      ob_start();
      ExerciseFileLoader::invoke($this->nutmeg)->loadExerciseFile($exercise_id, $exercise_settings['file']);
      $content = ob_get_contents();
      ob_end_clean();

    }
    catch (\Exception $e) {
      $content = 'Error: ' . $e->getMessage() . ' on line: ' . $e->getLine() . ', file: ' . $e->getFile();
    }

    return $content;
  }
}
