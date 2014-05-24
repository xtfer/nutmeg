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
use Nutmeg\RenderController\RenderControllerInterface;

/**
 * Class Template
 *
 * @package Nutmeg\Helpers
 */
class Template extends Helper {

  /**
   * Render a template.
   *
   * @param string $template_name
   *   Name of the template to render.
   * @param \Nutmeg\Controllers\Nutmeg $nutmeg
   *   The Nutmeg controller object.
   *
   * @return string
   *   The template output.
   */
  static public function render($template_name, Nutmeg $nutmeg) {

    $template_handler = new static($nutmeg);

    return $template_handler->renderTemplate($template_name);

  }

  /**
   * Render a template file.
   *
   * @param string $template_name
   *   Name of the template.
   *
   * @throws \Exception
   * @return string
   *   The rendered output.
   */
  public function renderTemplate($template_name) {

    $render_controller = $this->loadRenderController(ucfirst($template_name));

    $theme_name = $this->nutmeg->getSetting('theme');
    $theme_path = $this->nutmeg->getSetting('base_dir') . '/' . $this->nutmeg->getSetting('theme_path') . '/' . $theme_name;
    $template_path = $theme_path . '/templates/' . $render_controller->templateName() . '.php';

    $vars = $render_controller->prepare($this->nutmeg);

    return $this->renderTemplateFile($template_path, $vars);
  }

  /**
   * Render a static template file.
   *
   * @param string $template_file
   *   Name of the template file.
   * @param array $variables
   *   Any variables.
   *
   * @return string
   *   The rendered output.
   */
  public function renderTemplateFile($template_file, $variables) {

    // Extract the variables to a local namespace.
    extract($variables, EXTR_SKIP);

    // Start output buffering.
    ob_start();

    // Include the template file.
    include $template_file;

    // End buffering and return its contents.
    return ob_get_clean();
  }

  /**
   * Load template handler object.
   *
   * @param string $template_name
   *   Name of the template to render.
   *
   * @throws \Exception
   *
   * @return \Nutmeg\RenderController\RenderControllerInterface
   *   A template class.
   */
  public function loadRenderController($template_name) {

    // @todo More configurability here.
    $controller_class = '\\Nutmeg\\RenderController\\' . $template_name;

    if (class_exists($controller_class)) {
      $controller = new $controller_class();

      if ($controller instanceof RenderControllerInterface) {
        return $controller;
      }
    }

    throw new \Exception('Invalid render controller ' . $controller_class .  ' specified');
  }
}
