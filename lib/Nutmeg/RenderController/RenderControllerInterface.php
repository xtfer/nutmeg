<?php
/**
 * @file
 * Contains a TemplateInterface.
 *
 * @copyright Copyright(c) 2013 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

namespace Nutmeg\RenderController;

use Nutmeg\Controllers\Nutmeg;

/**
 * Interface TemplateInterface
 * @package Nutmeg\Templates
 */
interface RenderControllerInterface {

  /**
   * Prepare variable for rendering.
   *
   * @param Nutmeg $nutmeg
   *   The nutmeg object.
   *
   * @return string
   *   The prepared vars.
   */
  public function prepare(Nutmeg $nutmeg);

  /**
   * Defines the template name to use.
   *
   * @return string
   *   The template name.
   */
  public function templateName();

}
