<?php

namespace Drupal\database_test\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\database_test\Service\DbService;

/**
 * Controller for the database_test module.
 */
class DatabaseTestController extends ControllerBase {

  /**
   * Initialization of service.
   *
   * @var \Drupal\database_test\Service\DbService
   */
  protected $dbService;

  public function __construct(DbService $service) {
    $this->dbService = $service;
  }

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database_test.user_service')
    );
  }

  /**
   * To render the users list.
   *
   * @return array
   *   The user array.
   */
  public function list() {
    $users = $this->dbService->getActiveUsers();
    $res = [];

    foreach ($users as $user) {
      $res[] = [
        'uid' => $user->uid,
        'name' => $user->name,
        'created' => \Drupal::service('date.formatter')->format($user->created),
      ];
    }

    return [
      '#theme' => 'home',
      '#title' => 'Top 10 Users',
      '#users' => $res,
      '#empty' => $this->t('No users found.'),
    ];

  }

}
