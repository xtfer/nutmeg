<?php

/**
 * @file
 * The Nutmeg framework for learning PHP.
 *
 * @license GPL v2 http://www.fsf.org/licensing/licenses/gpl.html
 * @author Chris Skene chris at xtfer dot com dot au
 * @copyright Chris Skene
 */

define('NUTMEG_ROOT', getcwd());
require 'vendor/autoload.php';
require 'error.inc';

// Initialise Nutmeg.
$tutor = \Nutmeg\Controllers\Nutmeg::create();

?>

<html>
  <head>
    <title><?php print $tutor->getSetting('app_name'); ?></title>
    <link type="text/css" rel="stylesheet" href="/themes/default/reset.css" media="all"/>
    <link type="text/css" rel="stylesheet" href="/themes/default/styles.css" media="all"/>
  </head>
  <body>

  <div id="body" >
    <?php $tutor->renderTemplate('Header'); ?>


    <div id="main">
      <div class="container">
        <?php $tutor->codeSpace(); ?>

      </div>

    </div>

    <?php $tutor->renderTemplate('Footer'); ?>

  </div>

  </body>
</html>