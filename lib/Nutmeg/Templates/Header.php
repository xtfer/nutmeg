<?php
/**
 * @file
 * Header template.
 *
 * @copyright Copyright(c) 2013 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

namespace Nutmeg\Templates;

use Nutmeg\Controllers\Nutmeg;

/**
 * Class Header
 *
 * @package nutmeg\Templates
 */
class Header implements TemplateInterface {

  /**
   * {@inheritdoc}
   */
  public function render(Nutmeg $nutmeg) {
    $output = '';

    $output .= '<div id="navbar"><div id="navbar-inner"><div  class="container">';

    $output .= '<div id="title">';
    $output .= '<h1><a href="/">';
    $output .= $nutmeg->getSetting('app_name');
    $output .= '</a></h1>';
    $output .= '</div>';

    $output .= '<div id="nav"><ul>';

    $exercise_id = $nutmeg->getExercise();
    if (!empty($exercise_id)) {
      $output .= '<li><a href="/">Home</a></li>';
    }

    $output .= '</ul></div>';

    $output .= '</div></div></div>';

    return $output;
  }
}