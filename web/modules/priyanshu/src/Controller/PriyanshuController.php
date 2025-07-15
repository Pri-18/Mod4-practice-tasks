<?php

declare(strict_types=1);

namespace Drupal\priyanshu\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for priyanshu routes.
 */
final class PriyanshuController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function __invoke(): array {
    $entityTypeManager = \Drupal::service('entity_type.manager');
    $node = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['type' => 'article']);
    // dd($node);  
    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
