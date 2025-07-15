<?php

declare(strict_types=1);

namespace Drupal\priyanshu\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a priyanshu block.
 *
 * @Block(
 *   id = "priyanshu_priyanshu",
 *   admin_label = @Translation("Priyanshu"),
 *   category = @Translation("Custom"),
 * )
 */
final class PriyanshuBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $build['content'] = [
      '#markup' => $this->t('It works!'),
    ];
    return $build;
  }

}
