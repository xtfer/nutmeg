<?php
/**
 * @file
 * Contains a ShowExercise template.
 *
 * @copyright Copyright(c) 2013 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

namespace Nutmeg\RenderController;

use Nutmeg\Controllers\Nutmeg;
use Nutmeg\Helpers\CodeEvaluator;
use Nutmeg\Helpers\Highlighter;

/**
 * Class ShowExercise
 *
 * @package Nutmeg\Templates
 */
class ShowExercise extends RenderController {

  /**
   * {@inheritdoc}
   */
  public function prepare(Nutmeg $nutmeg) {

    $output = '';

    $exercises = $nutmeg->getSetting('exercises');
    $exercise_id = $nutmeg->getPath();

    $exercise_settings = array(
      'name' => $exercise_id,
      'id' => $exercise_id,
      'file' => 'index.php',
    );

    if (!empty($exercises)) {
      if (isset($exercises[$exercise_id])) {
        $exercise_settings = $exercises[$exercise_id];
      }
      else {
        return 'No exercise found';
      }
    }

    // Highlight the code.
    $output .= '<h2>File contents:</h2>';
    $output .= '<div id="code" class="pane"><code>';

    $rendered = Highlighter::highlightExercise($exercise_id, $exercise_settings['file']);

    // @todo Finish line numbers.
    // $lines = explode('<br />', $rendered);
    // foreach ($lines as $line_number => $line_content) {
    //  $output .= $line_number . ' | ' . $line_content . '<br />';
    // }

    $output .= $rendered;

    $output .= '</code></div>';

    // Run the exercise.
    $output .= '<h2>Output:</h2>';
    $output .= '<div id="output" class="pane">';

    $output .= CodeEvaluator::evaluate($exercise_id, $exercise_settings);

    $output .= '</div>';

    $vars['content'] = $output;

    return $vars;
  }

}
