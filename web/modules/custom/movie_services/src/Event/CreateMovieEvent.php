<?php

namespace Drupal\movie_services\Event;

use Symfony\Contracts\EventDispatcher\Event;
use Drupal\node\NodeInterface;

/**
 * Defines the custom event for a movie node creation.
 */
class CreateMovieEvent extends Event {

  /**
   * To set the event name.
   *
   * @var string
   */
  const EVENT_NAME = 'movie_services.movie_created';

  /**
   * To Update the event name.
   *
   * @var string
   */
  const EVENT_NAME2 = 'movie_services.movie_updated';
  /**
   * The movie node.
   *
   * @var \Drupal\node\NodeInterface
   */
  protected NodeInterface $node;

  /**
   * Constructs the event.
   *
   * @param \Drupal\node\NodeInterface $node
   *   The created movie node.
   */
  public function __construct(NodeInterface $node) {
    $this->node = $node;
  }

  /**
   * Returns the node object.
   *
   * @return \Drupal\node\NodeInterface
   *   The created movie node.
   */
  public function getNode(): NodeInterface {
    return $this->node;
  }

}
