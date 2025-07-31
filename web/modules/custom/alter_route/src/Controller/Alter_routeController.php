<?php

namespace Drupal\alter_route\Controller;

use Drupal\Core\Controller\ControllerBase;

class Alter_routeController extends ControllerBase {

  public function node($nodeId) {
    return [
      '#title' => $this->t('Node ID Page'),
      '#markup' => $this->t('The ID of the node is @id', ['@id' => $nodeId]),
    ];
  }

}
