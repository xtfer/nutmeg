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

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

/**
 * Class Nutmeg
 *
 * @package Nutmeg\Controllers
 *
 * @todo Refactor
 */
class Nutmeg {

  protected $settings;

  /**
   * @param array $settings
   */
  public function __construct(array $settings) {
    $this->settings = $settings;

    if (isset($_GET['e']) && !empty($_GET['e'])) {
      $this->exercise = $this->cleanInput($_GET['e']);
    }
  }

  /**
   *
   * @return \Nutmeg\Controllers\Nutmeg
   *   This Nutmeg controller.
   */
  static public function create() {

    // Load YAML.
    try {

      $_settings = Yaml::parse(NUTMEG_ROOT . '/exercises/config.yaml');
    }
    catch (ParseException $e) {

      printf("Unable to load the config YAML file successfully: %s", $e->getMessage());

      return FALSE;
    }

    return new static($_settings);
  }

  /**
   * @param $template_name
   *
   */
  public function renderTemplate($template_name) {

    $template_class = '\\Nutmeg\\Templates\\' . $template_name;

    if (class_exists($template_class)) {
      $template = new $template_class();

      print $template->render($this);
    }
  }

  /**
   *
   */
  public function codeSpace($exercise_name = NULL) {
    if (empty($exercise_name)) {
      if (!empty($this->exercise)) {
        $exercise_name = $this->exercise;
      }
    }

    if (!empty($exercise_name)) {

      print $this->showExercise($exercise_name);
    }
    else {

      print $this->listExercises($exercise_name);
    }
  }

  /**
   * @param $name
   *
   * @return mixed
   */
  public function getSetting($name) {
    if (array_key_exists($name, $this->settings)) {
      return $this->settings[$name];
    }
  }

  /**
   * @param $input
   *
   * @return string
   */
  protected function cleanInput($input) {
    if (!is_string($input)) {
      return $input;
    }

    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
  }

  /**
   * @param $exercise_name
   * @param $exercise_file
   *
   */
  protected function loadExerciseFile($exercise_name, $exercise_file) {

    $exercise_link = $this->pathToExercise($exercise_name, $exercise_file);
    include_once NUTMEG_ROOT . $exercise_link;
  }

  public function link($text, $path, array $options = array()) {

    // Merge in defaults.
    $options += array(
      'attributes' => array(),
      'html' => FALSE,
    );

    // Remove all HTML and PHP tags from a tooltip. For best performance, we act only
    // if a quick strpos() pre-check gave a suspicion (because strip_tags() is expensive).
    if (isset($options['attributes']['title']) && strpos($options['attributes']['title'], '<') !== FALSE) {
      $options['attributes']['title'] = strip_tags($options['attributes']['title']);
    }

    // The result of url() is a plain-text URL. Because we are using it here
    // in an HTML argument context, we need to encode it properly.
    return '<a href="' . $this->cleanInput($path) . '"' . $this->cleanInput($options['attributes']) . '>' . ($options['html'] ? $text : $this->cleanInput($text)) . '</a>';
  }

  public function attributes(array $attributes = array()) {

    foreach ($attributes as $attribute => &$data) {
      $data = implode(' ', (array) $data);
      $data = $attribute . '="' . $this->cleanInput($data) . '"';
    }

    return $attributes ? ' ' . implode(' ', $attributes) : '';
  }

  /**
   * @param $exercise_name
   * @param $exercise_file
   *
   * @return string
   */
  protected function pathToExercise($exercise_name, $exercise_file) {

    $exercise_link = '/exercises/' . $exercise_name . '/' . $exercise_file;

    return $exercise_link;
  }

  /**
   * @param $exercise_name
   *
   * @return string
   */
  protected function listExercises($exercise_name) {

    $output = '<h2>Exercises</h2>';
    $output .= '<div id="exercise-list" class="pane"><ul>';

    // Index.
    if (isset($this->settings['exercises']) && !empty($this->settings['exercises'])) {

      foreach ($this->settings['exercises'] as $exercise_id => $exercise_settings) {

        $exercise_settings += array(
          'id' => $exercise_id,
          'name' => $exercise_name,
          'file' => 'index.php',
        );

        $output .= '<li>' . $this->link($exercise_settings['name'], '?e=' . $exercise_settings['id']) . '</li>';
      }
    }
    else {

      $output .= 'No exercise specified.';
    }

    $output .= '</ul></div>';

    return $output;
  }

  /**
   * @param $exercise_name
   *
   */
  protected function showExercise($exercise_name) {
    $output = '';

    $exercise_settings = array(
      'name' => $exercise_name,
      'file' => 'index.php',
    );

    if (isset($this->settings['exercises']) && !empty($this->settings['exercises'])) {
      if (isset($this->settings['exercises'][$exercise_name])) {
        $exercise_settings = $this->settings['exercises'][$exercise_name];
      }
    }

    $output .= '<h2>File contents:</h2>';
    $output .= '<div id="code" class="pane"><code>';

    // The following code highlighting approach has been adapted from
    // http://wptest.means.us.com/2012/06/php-highlight_file-with-line-numbers-and-css-classes/
    // by Andy W
    // https://profiles.google.com/105432850040464581844?rel=author
    ini_set('highlight.default', '"class="nutmeg_default');
    ini_set('highlight.keyword', '"class="nutmeg_keyword');
    ini_set('highlight.string', '"class="nutmeg_string');
    ini_set('highlight.html', '"class="nutmeg_htmlsrc');
    ini_set('highlight.comment', '"class="nutmeg_comment');

    $rendered_source = highlight_file(NUTMEG_ROOT . $this->pathToExercise($exercise_name, $exercise_settings['file']), TRUE);

    $rendered_source = str_replace('<code>', '', $rendered_source);
    $rendered_source = str_replace(array("\r\n", "\r", "\n"), '', $rendered_source);
    $rendered_source = trim($rendered_source);
    $rendered_source = str_replace('style="color: "', '', $rendered_source);
    $rendered_source = str_replace('<br /></span>', '</span><br />', $rendered_source);

    $output .= $rendered_source;
    $output .= '</code></div>';

    // Run the exercise.
    $output .= '<h2>Output:</h2>';
    $output .= '<div id="output" class="pane">';

    try {
      ob_start();
      $this->loadExerciseFile($exercise_name, $exercise_settings['file']);
      $output .= ob_get_contents();
      ob_end_clean();
    }
    catch(\Exception $e) {
      $output .= 'Error: ' . $e->getMessage() . ' on line: ' . $e->getLine() . ', file: ' .$e->getFile();
    }

    $output .= '</div>';

    return $output;
  }
}