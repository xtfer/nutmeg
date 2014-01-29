<?php
/**
 * @file
 * Main file for the Nutmeg app.
 *
 * @copyright Copyright(c) 2013 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

namespace Nutmeg\Controllers;

use Nutmeg\Error\ErrorHandler;
use Nutmeg\Helpers\Security;
use Nutmeg\Helpers\Template;
use Nutmeg\Helpers\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * Class Nutmeg
 *
 * @package Nutmeg\Controllers
 */
class Nutmeg {

  /**
   * Nutmeg settings.
   *
   * @var array
   */
  protected $settings;

  /**
   * The active context.
   *
   * @var \Nutmeg\Context\ContextInterface
   */
  protected $context;

  /**
   * The active path.
   *
   * @var string
   */
  protected $path;

  /**
   * Public constructor.
   *
   * @param array $settings
   *   An array of settings, usually passed from the static create function.
   * @param string $path
   *   The current path.
   */
  public function __construct(array $settings, $path) {
    $this->settings = $settings;

    $this->path = $path;

    ErrorHandler::setErrorOptions();
  }

  /**
   * Static factory function.
   *
   * @return \Nutmeg\Controllers\Nutmeg
   *   This Nutmeg controller.
   */
  static public function create() {

    // @todo Make the config settings location more configurable.
    $settings = Yaml::readFile(NUTMEG_ROOT . '/config/app.yaml');

    $path = '';
    if (isset($_GET['e']) && !empty($_GET['e'])) {
      $path = Security::cleanInput($_GET['e']);
    }

    if (!empty($settings)) {
      return new static($settings, $path);
    }

    return FALSE;
  }

  /**
   * Main processing method.
   */
  public function run() {

    $this->setContextFromPath();

    return $this->render('page');
  }

  /**
   * Render a template.
   *
   * It is usually preferable to call this instead of the Template helper
   * directly, as this will handle dependency injection for the renderTemplate()
   * callback.
   *
   * @param string $template_name
   *   Name of the template to render.
   *
   * @return string
   *   Content of the render.
   */
  public function render($template_name) {

    return Template::renderTemplate($template_name, $this);
  }

  /**
   * Get an individual setting.
   *
   * @param string $name
   *   Name of the setting to retrieve.
   * @param mixed $default
   *   (Optional) A default value. Defaults to NULL.
   *
   * @return mixed
   *   The result of the setting or default.
   */
  public function getSetting($name, $default = NULL) {
    if (array_key_exists($name, $this->settings)) {
      return $this->settings[$name];
    }

    return $default;
  }

  /**
   * Set the value for Context.
   *
   * @param string $name
   *   The value to set.
   */
  public function setPath($name) {

    $this->path = $name;
  }

  /**
   * Get the value for Context.
   *
   * @return string
   *   The value from the context.
   */
  public function getPath() {
    if (isset($this->path) && !empty($this->path)) {
      return $this->path;
    }

    return '';
  }

  /**
   * Get the value for Context.
   *
   * @return \Nutmeg\Context\ContextInterface
   *   The value of Context.
   */
  public function getContext() {

    if (isset($this->context) && !empty($this->context)) {
      return $this->context;
    }

    return FALSE;
  }

  /**
   * Given a current path, determine the context.
   */
  public function setContextFromPath() {

    $path = $this->getPath();

    if (empty($path)) {
      $context_name = 'home';
    }
    else {
      $context_name = 'exercise';
    }

    $contexts = $this->getSetting('contexts');
    if (array_key_exists($context_name, $contexts)) {
      $this->context = $contexts[$context_name];
      $this->context['machine_name'] = $context_name;
    }
  }
}
