<?php
/**
 * @file
 * Contains a helper for working with Links.
 *
 * @copyright Copyright(c) 2013 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

namespace Nutmeg\Helpers;

/**
 * Class Link
 *
 * @package Nutmeg\Helpers
 */
class Link {

  /**
   * Create a link.
   *
   * @param string $text
   *   Text to put in the link.
   * @param string $path
   *   Link path.
   * @param array $options
   *   (optional) Optional items to add to the link.
   *
   * @return string
   *   A formatted link.
   */
  static public function create($text, $path, array $options = array()) {

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
    return '<a href="' . Security::cleanInput($path) . '"' . Security::cleanInput($options['attributes']) . '>' . ($options['html'] ? $text : Security::cleanInput($text)) . '</a>';
  }

  static public function attributes(array $attributes = array()) {

    foreach ($attributes as $attribute => &$data) {
      $data = implode(' ', (array) $data);
      $data = $attribute . '="' . Security::cleanInput($data) . '"';
    }

    return $attributes ? ' ' . implode(' ', $attributes) : '';
  }
}
