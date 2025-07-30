<?php

namespace Drupal\movie_services\Event;

use Symfony\Contracts\EventDispatcher\Event;
use Drupal\node\NodeInterface;

/**
 * Defines the custom event for a movie node creation.
 */
class CreateMovieEvent extends Event {

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
