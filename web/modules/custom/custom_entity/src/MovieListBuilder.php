<?php

namespace Drupal\custom_entity;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a list builder for Movie entities.
 */
class MovieListBuilder extends EntityListBuilder {

  /**
   * To build the header.
   */
  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['title'] = $this->t('Title');
    $header['price'] = $this->t('Price');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritDoc}
   */
  public function buildRow(EntityInterface $entity) {

    /**
     * @var \Drupal\custom_entity\Entity\Movie $entity
     */
    $row['id'] = $entity->id();
    $row['title'] = Link::createFromRoute($entity->label(), 'entity.movie.canonical', ['movie' => $entity->id()]);
    $row['price'] = $entity->get('price')->value;
    return $row + parent::buildRow($entity);
  }

}
