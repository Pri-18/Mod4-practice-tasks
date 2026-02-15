<?php

namespace Drupal\rgb_color_picker\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'rgb_widget' widget.
 *
 * @FieldWidget(
 *   id = "rgb_color_widget",
 *   label = @Translation("Color Picker"),
 *   field_types = {
 *     "rgb_color"
 *   }
 * )
 */
 class RGBColorPickerWidget extends WidgetBase {

  /**
   * {@inheritDoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state){
    $hex = sprintf("#%02x%02x%02x", $items[$delta]->r ?? 0, $items[$delta]->g ?? 0, $items[$delta]->b ?? 0);
    $element = [
      '#type' => 'color', 
      '#title' => $this->t('Color Picker'),
      '#default_value' => $hex,
      '#description' => $this->t('Select a color using the color picker.'),
    ];

    return $element;
  }

  /**
   * {@inheritDoc}
   */
  public function extractFormValues(FieldItemListInterface $items, $form, FormStateInterface $form_state) {
    $value = $form_state->getValue($this->fieldDefinition->getName());
    if (isset($value[0])) {
      $hex = ltrim($value[0], '#');
      foreach ($items as $item) {
        $item->r = hexdec(substr($hex, 0, 2));
        $item->g = hexdec(substr($hex, 2, 2));
        $item->b = hexdec(substr($hex, 4, 2));
      }
    }
  }

  /**
   * {@inheritDoc}
   */
  public function validateFieldItems(FieldItemListInterface $items) {
    foreach ($items as $delta => $item) {
      if (!preg_match('/^#([0-9a-fA-F]{6}|[0-9a-fA-F]{3})$/', $item->color)) {
        $this->context->addError($this->t('The color value is invalid.'), $delta);
      }
    }
  }

  /**
   * {@inheritDoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $settings = parent::settingsForm($form, $form_state);
    return $settings;
  }
}
