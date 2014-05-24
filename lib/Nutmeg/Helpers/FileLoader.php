<?php

/**
 * @file
 * Contains a FileLoader.
 */

namespace Nutmeg\Helpers;

/**
 * Class FileLoader
 *
 * @package Nutmeg\Helpers
 */
class FileLoader extends Helper {

  /**
   * Load an file.
   *
   * @param string $file_path
   *   Path to the file relative to the project root.
   */
  public function loadFile($file_path) {

    include_once $this->nutmeg->getSetting('base_dir') . '/' . $file_path;
  }
}
