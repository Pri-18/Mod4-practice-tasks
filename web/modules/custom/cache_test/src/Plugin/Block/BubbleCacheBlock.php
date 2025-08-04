<?php

declare(strict_types=1);

namespace Drupal\cache_test\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Render\BubbleableMetadata;

/**
 * Provides a bubble_cache_block block.
 *
 * @Block(
 *   id = "cache_test_bubble_cache_block",
 *   admin_label = @Translation("bubble_cache_block"),
 *   category = @Translation("Custom"),
 * )
 */
final class BubbleCacheBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $num = rand(100, 999);
    $build = [
      '#markup' => $this->t("The bubble cache number => @num", ['@num' => $num]),
    ];

    $meta = new BubbleableMetadata();
    $meta->setCacheTags(['node:1', 'user_list']);
    $meta->applyTo($build);

    return $build;
  }

}
