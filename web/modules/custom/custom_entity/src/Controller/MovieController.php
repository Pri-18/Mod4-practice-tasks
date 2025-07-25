<?php

namespace Drupal\custom_entity\Controller;

use Drupal\custom_entity\Entity\Movie;

/**
 * Summary of MovieController.
 */
class MovieController {

  /**
   * Returns the label of the given Movie entity.
   *
   * @param \Drupal\custom_entity\Entity\Movie $movie
   *   The Movie entity.
   *
   * @return string
   *   The label of the Movie entity.
   */
  public function title(Movie $movie) {
    return $movie->label();
  }

}
