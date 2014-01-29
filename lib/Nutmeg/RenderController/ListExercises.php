<?php
/**
 * @file
 * Contains a ListExercises template.
 *
 * @copyright Copyright(c) 2013 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */
namespace Nutmeg\RenderController;

use Nutmeg\Controllers\Nutmeg;
use Nutmeg\Helpers\Link;
use Nutmeg\RenderController\RenderControllerInterface;

/**
 * Class ListExercises
 *
 * @package Nutmeg\Templates
 */
class ListExercises extends RenderController {

  /**
   * {@inheritdoc}
   */
  public function prepare(Nutmeg $nutmeg) {

    $output = '<h2>Exercises</h2>';
    $output .= '<div id="exercise-list" class="pane"><ul>';

    $exercises = $nutmeg->getSetting('exercises', array());

    // Index.
    if (!empty($exercises)) {

      foreach ($exercises as $exercise_id => $exercise_settings) {

        $exercise_settings += array(
          'id' => $exercise_id,
          'name' => $exercise_id,
          'file' => 'index.php',
        );

        $output .= '<li>' . Link::Create($exercise_settings['name'], '?e=' . $exercise_settings['id']) . '</li>';
      }
    }
    else {

      $output .= 'No exercise specified.';
    }

    $output .= '</ul></div>';

    $vars['content'] = $output;

    return $vars;
  }

}
