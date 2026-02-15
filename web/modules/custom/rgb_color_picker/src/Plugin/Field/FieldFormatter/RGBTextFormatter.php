<?php

namespace Drupal\rgb_color_picker\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Render\Markup;

/**
 * Plugin implementation of the 'color_code_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "color_code_formatter",
 *   label = @Translation("Color Code"),
 *   field_types = {
 *     "rgb_color"
 *   }
 * )
 */
class RGBTextFormatter extends FormatterBase {
  
  /**
   * {@inheritdoc}
   */
  public function viewelements(FieldItemListInterface $items, $langcode){
    $elements = [];
    foreach ($items as $delta => $item){
      $hex = sprintf("#%02x%02x%02x", $item->r, $item->g, $item->b);
    $elements[$delta] = [
        '#markup' => Markup::create('<span style="color: ' . $hex . ';">' . $hex . '</span>'),
    ];
    }
    return $elements;
  }
}
