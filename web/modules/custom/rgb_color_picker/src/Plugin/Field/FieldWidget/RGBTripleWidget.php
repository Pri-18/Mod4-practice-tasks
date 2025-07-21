<?php

namespace Drupal\rgb_color_picker\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'rgb_widget' widget.
 *
 * @FieldWidget(
 *   id = "rgb_widget",
 *   label = @Translation("RGB Color"),
 *   field_types = {
 *   "rgb_color" 
 *   }
 * )
 */
 class RGBTripleWidget extends WidgetBase {

  /**
   * {@inheritDoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state){
    $element = [];

    $element['r'] = [
      '#type' => 'number',
      '#title' => $this->t('Red'),
      '#default_value' => isset($items[$delta]->r) ? $items[$delta]->r : 0,
      '#min' => 0,
      '#max' => 255,
      '#required' => TRUE,
    ];
    $element['g'] = [
      '#type' => 'number',
      '#title' => $this->t('Green'),
      '#default_value' => isset($items[$delta]->g) ? $items[$delta]->g : 0,
      '#min' => 0,
      '#max' => 255,
      '#required' => TRUE,
    ];
    $element['b'] = [
      '#type' => 'number',
      '#title' => $this->t('Blue'),
      '#default_value' => isset($items[$delta]->b) ? $items[$delta]->b : 0,
      '#min' => 0,
      '#max' => 255,
      '#required' => TRUE,
    ];
    return $element;
  }
}
