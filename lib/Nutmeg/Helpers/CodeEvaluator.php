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
class CodeEvaluator {

  /**
   * @param $exercise_id
   * @param $exercise_settings
   *
   * @return string
   */
  public static function evaluate($exercise_id, $exercise_settings) {

    try {
      ob_start();
      File::loadExerciseFile($exercise_id, $exercise_settings['file']);
      $content = ob_get_contents();
      ob_end_clean();

    }
    catch (\Exception $e) {
      $content = 'Error: ' . $e->getMessage() . ' on line: ' . $e->getLine() . ', file: ' . $e->getFile();
    }

    return $content;
  }
}
