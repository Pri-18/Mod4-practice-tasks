<?php

namespace Drupal\custom_entity\Controller;

use Drupal\custom_entity\Entity\AwardWinningMovie;
use Drupal\Core\Render\Markup;

/**
 * Controller for displaying Award-Winning Movie details.
 */
class AwardMovieController {

  /**
   * Displays formatted movie details.
   *
   * @param \Drupal\custom_entity\Entity\AwardWinningMovie $award_movie
   *   The Award-winning Movie entity.
   *
   * @return array
   *   To render the page.
   */
  public function show(AwardWinningMovie $award_movie) {
    $award = $award_movie->get('award_name');
    $name = $award_movie->get('movie_title');
    $year = $award_movie->get('year');

    return [
      '#title' => $name,
      '#markup' => Markup::create("<div>Award won: $award</div>" .
                    "<div>Year : $year</div>"),
    ];
  }

}
