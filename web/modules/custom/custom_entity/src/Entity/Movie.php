<?php

namespace Drupal\custom_entity\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityInterface;

/**
 * Defines the Movie entity.
 *
 * @ContentEntityType(
 *   id = "movie",
 *   label = @Translation("Movie"),
 *   base_table = "movie",
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\custom_entity\MovieListBuilder",
 *     "form" = {
 *       "add" = "Drupal\custom_entity\Form\MovieForm",
 *       "edit" = "Drupal\custom_entity\Form\MovieEditForm",
 *       "delete" = "Drupal\custom_entity\Form\MovieDeleteForm"
 *     },
 *     "route_provider" = {
 *       "default" = "Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer movie entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "title",
 *     "uuid" = "uuid",
 *     "owner" = "uid",
 *     "published" = "status",
 *   },
 *   links = {
 *     "add-form" = "/movie/add",
 *     "edit-form" = "/movie/{movie}/edit",
 *     "delete-form" = "/movie/{movie}/delete",
 *     "canonical" = "/movie/{movie}",
 *     "collection" = "/admin/content/movie"
 *   }
 * )
 */
class Movie extends ContentEntityBase implements EntityInterface {

  /**
   * Provides base field definitions for the Movie entity type.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   *   The entity type definition.
   *
   * @return \Drupal\Core\Field\BaseFieldDefinition[]
   *   An array of base field definitions.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setRequired(TRUE)
      ->addConstraint('UniqueField')
      ->setSettings([
        'max_length' => 255,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 0,
      ])->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['image'] = BaseFieldDefinition::create('image')
      ->setLabel(t('Image'))
      ->setRequired(TRUE)
      ->setSettings([
        'file_extensions' => 'png jpg jpeg',
        'file_directory' => 'movies/images',
        'alt_field' => TRUE,
        'alt_field_required' => TRUE,
      ])
      ->setDisplayOptions('form', [
        'type' => 'image_image',
        'weight' => 4,
      ])
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'image',
        'weight' => 4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['price'] = BaseFieldDefinition::create('decimal')
      ->setLabel(t('Price'))
      ->setRequired(TRUE)
      ->addConstraint('PriceConstraint')
      ->setSettings([
        'precision' => 10,
        'scale' => 2,
      ])
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => 1,
      ])
      ->setDisplayOptions('view', [
        'label' => 'Price',
        'type' => 'decimal',
        'weight' => 4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
    return $fields;
  }

}
