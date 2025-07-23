<?php
namespace Drupal\rgb_color_picker\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Render\Markup;

/**
 * Plugin implementation of the 'Bg_color_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "Bg_color_formatter",
 *   label = @Translation("Bg_color_formatter"),
 *   field_types = {
 *     "rgb_color"
 *   }
 * )
 */
class RGBBgColorFormatter extends FormatterBase {

    /**
     * {@inheritDoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode){
        $elements = [];

        foreach ($items as $delta => $item) {
            $elements = [];
            foreach ($items as $delta => $item) {
                $hex = sprintf("#%02x%02x%02x", $item->r, $item->g, $item->b);
                $elements[$delta] = [
                    '#markup' => Markup::create(
                        '<span style="color: ' . $hex . ';">' . $hex . '</span>'.
                        '<div style="box-shadow: 2px 10px 25px 2px' . $hex . '; padding: 30px; color:' . $hex . '; background-color: #000";>' . $hex . '</div>'
                    ),
                ];
            }
            return $elements;
        }
    }
}
