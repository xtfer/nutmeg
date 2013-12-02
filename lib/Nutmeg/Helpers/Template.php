<?php
/**
 * @file
 * Contains a helper for working with templates.
 *
 * @copyright Copyright(c) 2013 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

namespace Nutmeg\Helpers;

use Nutmeg\Controllers\Nutmeg;
use Nutmeg\Templates\TemplateInterface;

/**
 * Class Template
 *
 * @package Nutmeg\Helpers
 */
class Template {

  /**
   * Render a template.
   *
   * @param string $template_name
   *   Name of the template to render.
   * @param \Nutmeg\Controllers\Nutmeg $nutmeg
   *   The Nutmeg controller object.
   */
  static public function renderTemplate($template_name, Nutmeg $nutmeg) {

    $template = self::loadTemplateClass($template_name);

    print $template->render($nutmeg);
  }

  /**
   * Load template handler object.
   *
   * @param string $template_name
   *   Name of the template to render.
   *
   * @throws \Exception
   *
   * @return TemplateInterface
   *   A template class.
   */
  public static function loadTemplateClass($template_name) {

    // @todo More configurability here.
    $template_class = '\\Nutmeg\\Templates\\' . $template_name;

    if (class_exists($template_class)) {
      $template = new $template_class();

      if ($template instanceof TemplateInterface) {
        return $template;
      }
    }

    throw new \Exception('Invalid template handler ' . $template_class .  ' specified');
  }
}