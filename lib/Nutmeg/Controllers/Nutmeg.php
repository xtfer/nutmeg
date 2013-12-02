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

use Nutmeg\Helpers\Security;
use Nutmeg\Helpers\Template;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

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
   * The active exercise.
   *
   * @var string
   */
  protected $exercise;

  /**
   * Public constructor.
   *
   * @param array $settings
   *   An array of settings, usually passed from the static create function.
   */
  public function __construct(array $settings) {
    $this->settings = $settings;

    if (isset($_GET['e']) && !empty($_GET['e'])) {
      $this->exercise = Security::cleanInput($_GET['e']);
    }
  }

  /**
   * Static factory function.
   *
   * @return \Nutmeg\Controllers\Nutmeg
   *   This Nutmeg controller.
   */
  static public function create() {

    // @todo Make the config settings location more configurable.
    $settings = \Nutmeg\Helpers\Yaml::readFile(NUTMEG_ROOT . '/exercises/config.yaml');

    if (!empty($settings)) {
      return new static($settings);
    }

    return FALSE;
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
   */
  public function renderTemplate($template_name) {

    Template::renderTemplate($template_name, $this);
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
   * Set the value for Exercise.
   *
   * @param string $exercise
   *   The value to set.
   */
  public function setExercise($exercise) {

    $this->exercise = $exercise;
  }

  /**
   * Get the value for Exercise.
   *
   * @return string
   *   The value of Exercise.
   */
  public function getExercise() {
    if (isset($this->exercise) && !empty($this->exercise)) {
      return $this->exercise;
    }

    return FALSE;
  }

}
