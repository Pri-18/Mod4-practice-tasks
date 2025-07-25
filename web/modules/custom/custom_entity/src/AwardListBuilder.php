<?php

namespace Drupal\custom_entity;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Award Winning Movie entities.
 */
class AwardListBuilder extends EntityListBuilder {

  /**
   * {@inheritDoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['award_name'] = $this->t('Award Name');
    $header['year'] = $this->t('Year');
    $header['movie_title'] = $this->t('Movie Title');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritDoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['id'] = $entity->id();
    $row['award_name'] = Link::createFromRoute($entity->label(), 'entity.award_movie.canonical', ['award_movie' => $entity->id()]);
    $row['year'] = $entity->get('year');
    $row['movie_title'] = $entity->get('movie_title');
    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritDoc}
   */
  public function render() {
    $build = parent::render();
    $build['add_movie_button'] = [
      '#type' => 'link',
      '#title' => $this->t('+ Add Award winning Movie'),
      '#url' => Url::fromRoute('entity.award_movie.add_form'),
      '#attributes' => [
        'class' => ['button', 'button--primary'],
      ],
      '#weight' => -10,
    ];
    return $build;
  }

}
