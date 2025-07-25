<?php

namespace Drupal\custom_entity\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the Movie entity edit forms.
 */
class MovieForm extends ContentEntityForm {

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    return $form;
  }

  /**
   * {@inheritDoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $status = $entity->save();

    if ($status == SAVED_NEW) {
      $this->messenger()->addMessage($this->t('Created new movie: @label', ['@label' => $entity->label()]));
    }
    else {
      $this->messenger()->addMessage($this->t('Updated movie: @label', ['@label' => $entity->label()]));
    }

    $form_state->setRedirect('entity.movie.canonical', ['movie' => $entity->id()]);
  }

}
