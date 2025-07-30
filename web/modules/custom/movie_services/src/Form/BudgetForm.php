<?php

namespace Drupal\movie_services\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * The config form for the movies.
 */
class BudgetForm extends ConfigFormBase {

  /**
   * {@inheritDoc}
   */
  public function getFormId() {
    return 'budget_form_settings';
  }

  /**
   * {@inheritDoc}
   */
  protected function getEditableConfignames() {
    return ['budget_form.settings'];
  }

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('budget_form.settings');

    $form['budget'] = [
      '#type' => 'number',
      '#title' => $this->t('Enter your budget'),
      '#default_value' => is_string($config->get('budget')) ? $config->get('budget') : '',
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);

  }

  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('budget_form.settings');
    $config->set('budget', $form_state->getValue('budget'));
    $config->save();

    parent::submitForm($form, $form_state);

  }

}
