<?php

namespace Drupal\alter_route\Controller;
use Drupal\Core\Controller\ControllerBase;

/**
 * To alter the routes.
 */
class Alter_routeController extends ControllerBase {

  /**
   * Receives a dynamic node ID from the route parameter
   * @param mixed $nodeId
   * 
   * @return array
   */
  public function node($nodeId) {
    return [
      '#title' => $this->t('Node ID Page'),
      '#markup' => $this->t('The ID of the node is @id', ['@id' => $nodeId]),
    ];
  }

}
