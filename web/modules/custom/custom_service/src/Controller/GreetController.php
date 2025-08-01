<?php

namespace Drupal\custom_service\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller to return a greeting using the custom GreetingService.
 */
class GreetController extends ControllerBase {

  /**
   * Returns a renderable greeting array using the service.
   *
   * @return array
   *   A renderable array with greeting markup.
   */
  public function greet() {

    $message = \Drupal::service(id:'custom_service.greeting_service');
    $content = $message->greeting();
    return [
      '#markup' => $content,
    ];
  }

}
