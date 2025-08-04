<?php

namespace Drupal\cache_test\Controller;

use Drupal\Core\Cache\Cache;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\user\Entity\User;

/**
 * Returns responses for Cache test routes.
 */
class CacheTestController extends ControllerBase {

  /**
   * The current user variable.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * Inject current user service.
   */
  public function __construct(AccountProxyInterface $current_user) {
    $this->currentUser = $current_user;
  }

  /**
   * Required for service injection in controllers.
   */
  public static function create($container) {
    return new static(
      $container->get('current_user')
    );
  }

  /**
   * Implementation of cacheMaxAge.
   *
   * @return array
   *   A render array containing the markup and cache contexts.
   */
  public function cacheMaxAge() {

    return [
      '#markup' => $this->t('This cache is only for 10 seconds @time.', ['@time' => time()]),
      '#cache' => [
        // 'max-age' => 10,
        'max-age' => Cache::PERMANENT,
      ],

    ];

  }

  /**
   * Implementation of cacheContexts.
   *
   * @return array
   *   A render array containing the markup and cache contexts.
   */
  public function cacheContexts() {

    $user = $this->currentUser->getAccountName();

    return [
      '#markup' => $this->t('Hello @user', ['@user' => $user]),
      '#cache' => [
        'contexts' => ['url.query_args'],
      ],
    ];

  }

  /**
   * Implementation of cacheTags.
   *
   * @return array
   *   A render array containing the markup and cache tags.
   */
  public function cacheTags() {

    $user = $this->currentUser->getAccountName();
    $cachetags = User::load($this->currentUser->id())->getCacheTags();

    return [
      '#markup' => $this->t('Hello @user from cache tags', ['@user' => $user]),
      '#cache' => [
        'tags' => $cachetags,
      ],
    ];

  }

  /**
   * Implementation of cacheKeys.
   *
   * @return array
   *   A render array containing the markup and cache contexts.
   */
  public function cacheKeys() {

    return [
      'permanent_cache' => [
        '#markup' => 'Permanent cache =>' . time() . '<br>',
        '#cache' => [
          'max-age' => Cache::PERMANENT,
          'keys' => ['permanent_cache'],
        ],
      ],
      'Simple_message' => [
        '#markup' => 'No cache. <br>',
        '#cache' => [
          'keys' => ['Simple_message'],
        ],
      ],
      'parent' => [
        'child_First' => [
          '#markup' => 'Cache clearing by 20 seconds =>' . time() . '<br>',
          '#cache' => [
            'max-age' => 20,
            'keys' => ['child_First'],
          ],
        ],
        'child_Second' => [
          '#markup' => 'Cache clearing by 10 seconds =>' . time() . '<br>',
          '#cache' => [
            'max-age' => 10,
            'keys' => ['child_Second'],
          ],
        ],
      ],
      'Contexts_url' => [
        '#markup' => 'Context URl =>' . time() . '<br>',
        '#cache' => [
          'contexts' => ['url.query_args'],
          'keys' => ['Contexts_url'],
        ],
      ],

    ];

  }

}
