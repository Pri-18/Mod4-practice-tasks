<?php

namespace Drupal\rgb_color_picker\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'hex_widget' widget.
 *
 * @FieldWidget(
 *   id = "hex_widget",
 *   label = @Translation("Hexadecimal Color"),
 *   field_types = {
 *     "rgb_color"
 *   }
 * )
 */
class RGBHexWidget extends WidgetBase {

  /**
   * {@inheritDoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $r = $items[$delta]->r ?? 0;
    $g = $items[$delta]->g ?? 0;
    $b = $items[$delta]->b ?? 0;

    // Convert RGB to Hexadecimal
    $hex = sprintf("#%02x%02x%02x", $r, $g, $b);

    $element['hex'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Hexadecimal Color'),
      '#default_value' => $hex,
      '#maxlength' => 7,
      '#size' => 7,
      '#description' => $this->t('Enter a color in hexadecimal format (e.g., #FF5733).'),
    ];
    
    return $element;
  }

  /**
   * {@inheritDoc}
   */
  public function validateFieldItems(FieldItemListInterface $items) {
    foreach ($items as $delta => $item) {
      if (!preg_match('/^#([0-9a-fA-F]{6}|[0-9a-fA-F]{3})$/', $item->hex)) {
        $this->context->addError($this->t('The hexadecimal color value is invalid.'), $delta);
      }
    }
  }

  /**
   * {@inheritDoc}
   */
  public function extractFormValues(FieldItemListInterface $items, $form, FormStateInterface $form_state) {
    $field_name = $this->fieldDefinition->getName();
    $values = $form_state->getValue($field_name);

    foreach ($items as $delta => $item) {
      if (!empty($values[$delta]['hex'])) {
        $hex = ltrim($values[$delta]['hex'], '#');
        if (strlen($hex) === 6) {
          $item->r = hexdec(substr($hex, 0, 2));
          $item->g = hexdec(substr($hex, 2, 2));
          $item->b = hexdec(substr($hex, 4, 2));
        }
      }
    }
  }

}
