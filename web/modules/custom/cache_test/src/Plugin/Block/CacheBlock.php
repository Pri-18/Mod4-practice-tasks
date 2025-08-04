<?php

declare(strict_types=1);

namespace Drupal\cache_test\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a cache_block block.
 *
 * @Block(
 *   id = "cache_test_cache_block",
 *   admin_label = @Translation("cache_block"),
 *   category = @Translation("Custom"),
 * )
 */
final class CacheBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $number = rand(100, 999);
    $build['content'] = [
      '#markup' => $this->t("The Number => @number", ['@number' => $number]),
      '#cache' => [
        'tags' => ['node:1', 'user_list'],
      ],
    ];
    return $build;
  }

}
