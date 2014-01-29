<?php
/**
 * @file
 * Header template.
 *
 * @copyright Copyright(c) 2013 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

namespace Nutmeg\RenderController;

use Nutmeg\Controllers\Nutmeg;
use Nutmeg\RenderController\RenderController;
use Nutmeg\RenderController\RenderControllerInterface;

/**
 * Class Header
 *
 * @package nutmeg\Templates
 */
class Header extends RenderController {

  /**
   * Define the template to use for this controller.
   *
   * @return string
   *   Name of the template.
   */
  public function templateName() {

    return 'header';
  }

  /**
   * Prepare variable for rendering.
   *
   * @param Nutmeg $nutmeg
   *   The nutmeg object.
   *
   * @return string
   *   The prepared vars.
   */
  public function prepare(Nutmeg $nutmeg) {
    $vars['app_name'] = $nutmeg->getSetting('app_name');

    $exercise_id = $nutmeg->getPath();
    if (!empty($exercise_id)) {
      $vars['link'] = '<li><a href="/">Home</a></li>';
    }
    else {
      $vars['link'] = '';
    }

    return $vars;
  }

}
