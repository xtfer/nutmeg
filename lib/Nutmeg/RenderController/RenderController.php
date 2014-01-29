<?php
/**
 * @file
 * Contains the base Render Controller.
 */

namespace Nutmeg\RenderController;

use Nutmeg\Controllers\Nutmeg;

/**
 * Class RenderController
 *
 * @package Nutmeg\RenderController
 */
class RenderController implements RenderControllerInterface {

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

    return array();
  }

  /**
   * Define the template to use for this controller.
   *
   * @return string
   *   Name of the template.
   */
  public function templateName() {
    return 'raw';
  }
}
