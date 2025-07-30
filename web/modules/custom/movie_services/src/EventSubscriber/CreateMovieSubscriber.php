<?php

namespace Drupal\movie_services\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\movie_services\Event\CreateMovieEvent;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Messenger\MessengerInterface;

/**
 * Subscribes to the movie created event.
 */
class CreateMovieSubscriber implements EventSubscriberInterface {

  /**
   * The config factory service.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * The messenger service.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $msg;

  public function __construct(ConfigFactoryInterface $config, MessengerInterface $messenger) {
    $this->configFactory = $config;
    $this->msg = $messenger;
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents(): array {
    return [
      'movie_services.movie_created' => 'onMovieCreated',
      'movie_services.movie_updated' => 'onMovieCreated',
    ];
  }

  /**
   * Reacts to the movie creation event.
   *
   * @param \Drupal\movie_services\Event\CreateMovieEvent $event
   *   The movie created event.
   */
  public function onMovieCreated(CreateMovieEvent $event): void {
    $node = $event->getNode();
    $budget = $this->configFactory->get('budget_form.settings')->get('budget');
    // dd($budget);
    $price = $node->get('field_budget')->value;

    if ($price < $budget) {
      $status = 'Movie "' . $node->label() . '" is under budget.';
    }
    elseif ($price > $budget) {
      $status = 'Movie "' . $node->label() . '" is over budget.';
    }
    else {
      $status = 'Movie "' . $node->label() . '" is exactly on budget.';
    }

    // Show message.
    $this->msg->addStatus($status);
  }

}
