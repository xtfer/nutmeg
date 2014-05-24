<?php
/**
 * @file
 * The Nutmeg framework for learning PHP.
 *
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com dot au
 * @copyright Chris Skene
 */

use Nutmeg\Controllers\Nutmeg;

define('NUTMEG_ROOT', getcwd());
require 'vendor/autoload.php';
require 'lib/shortcuts.php';

// Initialise Nutmeg.
$nutmeg = Nutmeg::create();
print $nutmeg->run();
