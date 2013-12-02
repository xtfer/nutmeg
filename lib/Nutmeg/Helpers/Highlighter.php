<?php
/**
 * @file
 * Contains a helper for highlighting code.
 *
 * @copyright Copyright(c) 2013 Christopher Skene
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com
 */

namespace Nutmeg\Helpers;

/**
 * Class Highlighter
 *
 * @package Nutmeg\Helpers
 */
class Highlighter {

  /**
   * Highlight an exercise.
   *
   * @param string $exercise_id
   *   Exercise ID.
   * @param array $exercise_file
   *   Name of the file containing the exercise.
   *
   * @return mixed|string
   */
  public static function highlightExercise($exercise_id, $exercise_file) {

    $file = NUTMEG_ROOT . File::pathToExercise($exercise_id, $exercise_file);

    return self::highlightFile($file);
  }

  /**
   * Highlight a file.
   *
   * @param string $file
   *   Path to the file.
   *
   * @return string
   *   A highlighted code string.
   */
  public static function highlightFile($file) {

    // The following code highlighting approach has been adapted from
    // http://wptest.means.us.com/2012/06/php-highlight_file-with-line-numbers-and-css-classes/
    // by Andy W
    // https://profiles.google.com/105432850040464581844?rel=author
    ini_set('highlight.default', '"class="nutmeg_default');
    ini_set('highlight.keyword', '"class="nutmeg_keyword');
    ini_set('highlight.string', '"class="nutmeg_string');
    ini_set('highlight.html', '"class="nutmeg_htmlsrc');
    ini_set('highlight.comment', '"class="nutmeg_comment');

    $rendered_source = highlight_file($file, TRUE);

    $rendered_source = str_replace('<code>', '', $rendered_source);
    $rendered_source = str_replace(array(
      "\r\n",
      "\r",
      "\n"
    ), '', $rendered_source);
    $rendered_source = trim($rendered_source);
    $rendered_source = str_replace('style="color: "', '', $rendered_source);
    $rendered_source = str_replace('<br /></span>', '</span><br />', $rendered_source);

    return $rendered_source;
  }
}
