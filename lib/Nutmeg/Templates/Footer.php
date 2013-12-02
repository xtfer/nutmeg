<?php
/**
 * @file
 * Footer template.
 *
 * @copyright Copyright(c) 2013 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

namespace Nutmeg\Templates;


/**
 * Class Footer
 *
 * @package Nutmeg\Templates
 */
class Footer {

  public function render() {
    $output = '';

    $output .= '<div id="footer"><div class="container">';

    $output .= '<div id="colophon">Nutmeg for PHP: &#169; 2013 <a href="http://xtfer.com">xtfer</a>. . Licensed under GPL v2. No warranty is provided.</div>';

    $output .= '</div></div>';

    return $output;
  }

}