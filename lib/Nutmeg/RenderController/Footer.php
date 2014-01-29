<?php
/**
 * @file
 * Footer template.
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
 * Class Footer
 *
 * @package Nutmeg\Templates
 */
class Footer extends RenderController {

  /**
   * Define the template to use for this controller.
   *
   * @return string
   *   Name of the template.
   */
  public function templateName() {

    return 'footer';
  }

}
