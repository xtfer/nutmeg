<?php
/**
 * @file
 * Contains a TemplateInterface.
 *
 * @copyright Copyright(c) 2013 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

namespace Nutmeg\Templates;

use Nutmeg\Controllers\Nutmeg;

/**
 * Interface TemplateInterface
 * @package Nutmeg\Templates
 */
interface TemplateInterface {

  /**
   * Render the template.
   *
   * @param Nutmeg $nutmeg
   *   A Nutmeg Controller object.
   *
   * @return
   *   The result of the render operation should be a string, usually containing
   *   HTML.
   */
  public function render(Nutmeg $nutmeg);

}
