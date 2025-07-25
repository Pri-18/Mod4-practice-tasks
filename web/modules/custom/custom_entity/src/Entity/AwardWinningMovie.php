<?php

namespace Drupal\custom_entity\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Movie entity.
 *
 * @ConfigEntityType(
 *   id = "award_movie",
 *   label = @Translation("Award Winning Movie"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\custom_entity\AwardListBuilder",
 *     "form" = {
 *       "add" = "Drupal\custom_entity\Form\AwardWinningForm",
 *       "edit" = "Drupal\custom_entity\Form\AwardWinningForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *   },
 *   base_table = "award_movie",
 *   admin_permission = "administer movie entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "award_name",
 *   },
 *   config_export = {
 *     "id",
 *     "award_name",
 *     "movie_title",
 *     "year"
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/award-movie/add",
 *     "edit-form" = "/admin/structure/award-movie/{award_movie}/edit",
 *     "delete-form" = "/admin/structure/award-movie/{award_movie}/delete"
 *   }
 * )
 */
class AwardWinningMovie extends ConfigEntityBase {

  /**
   * Summary of id.
   *
   * @var string
   */
  protected $id;

  /**
   * Award name for the movie.
   *
   * @var string
   */
  protected $award_name;

  /**
   * Title of the movie.
   *
   * @var string
   */
  protected $movie_title;

  /**
   * Award winning year.
   *
   * @var string
   */
  protected $year;

}
