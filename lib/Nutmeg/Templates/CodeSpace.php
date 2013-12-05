<?php
/**
 * @file
 * Contains the CodeSpace template.
 *
 * @copyright Copyright(c) 2013 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

namespace Nutmeg\Templates;

use Nutmeg\Controllers\Nutmeg;

/**
 * Class CodeSpace
 *
 * @package Nutmeg\Templates
 */
class CodeSpace implements TemplateInterface {

  /**
   * {@inheritdoc}
   */
  public function render(Nutmeg $nutmeg) {

    $exercise_id = $nutmeg->getExerciseID();

    if (!empty($exercise_id)) {

      $nutmeg->renderTemplate('ShowExercise');
    }
    else {

      $nutmeg->renderTemplate('ListExercises');
    }
  }
}
