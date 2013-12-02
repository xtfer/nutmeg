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


/**
 * Class Header
 *
 * @package nutmeg\Templates
 */
class Header {

  public function render($nutmeg) {
    $output = '';

    $output .= '<div id="navbar"><div id="navbar-inner"><div  class="container">';

    $output .= '<div id="title">';
    $output .= '<h1><a href="/">';
    $output .= $nutmeg->getSetting('app_name');
    $output .= '</a></h1>';
    $output .= '</div>';

    $output .= '<div id="nav"><ul>';
    if (isset($nutmeg->exercise) && !empty($nutmeg->exercise)) {
      $output .= '<li><a href="/">Home</a></li>';
    }
    $output .= '</ul></div>';

    $output .= '</div></div></div>';

    return $output;
  }
}