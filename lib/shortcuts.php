<?php
/**
 * @file
 * Contains PHP function 'shortcuts' around Nutmeg functionality, for students.
 */

/**
 * Dump values for debugging.
 *
 * @param mixed $values
 *   The values to dump.
 */
function nutmeg_dump($values) {

  \Nutmeg\Helpers\Debug::dump($values);
}
