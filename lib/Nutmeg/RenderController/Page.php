<?php
/**
 * @file
 * The Page Render Controller.
 */

namespace Nutmeg\RenderController;

use Nutmeg\Controllers\Nutmeg;

/**
 * Class Page
 *
 * @package Nutmeg\Templates
 */
class Page extends RenderController {

  /**
   * {@inheritdoc}
   */
  public function templateName() {

    return 'page';
  }

  /**
   * {@inheritdoc}
   */
  public function prepare(Nutmeg $nutmeg) {

    $context = $nutmeg->getContext();

    $vars['title'] = $nutmeg->getSetting('app_name');
    $vars['header'] = $nutmeg->render('header');

    if ($context['machine_name'] == 'exercise') {

      $vars['content'] = $nutmeg->render('ShowExercise');
    }
    else {

      $vars['content'] = $nutmeg->render('ListExercises');
    }

    $vars['footer'] = $nutmeg->render('footer');

    return $vars;
  }

}
