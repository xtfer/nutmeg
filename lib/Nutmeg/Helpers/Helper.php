<?php

/**
 * @file
 * Contains the Helper base class.
 */

namespace Nutmeg\Helpers;

use Nutmeg\Controllers\Nutmeg;

/**
 * Class Helper
 *
 * @package Nutmeg\Helpers
 */
class Helper implements HelperInterface {

  /**
   * The nutmeg variable.
   *
   * @var \Nutmeg\Controllers\Nutmeg
   */
  protected $nutmeg;

  /**
   * Constructor.
   *
   * @param Nutmeg $nutmeg
   *   The Nutmeg object.
   */
  public function __construct(Nutmeg $nutmeg) {

    $this->nutmeg = $nutmeg;
  }

  /**
   * Standard constructor.
   *
   * @param Nutmeg $nutmeg
   *   Nutmeg.
   *
   * @return HelperInterface
   *   A helper.
   */
  static public function invoke(Nutmeg $nutmeg) {

    return new static($nutmeg);
  }

}
