<?php
namespace Drupal\rgb_color_picker\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'rgb_color' field type.
 *
 * @FieldType(
 *   id = "rgb_color",
 *   label = @Translation("RGB Color"),
 *   description = @Translation("Stores a color in RGB format."),
 *   default_widget = "rgb_widget",
 *   default_formatter = "Bg_color_formatter"
 * )
 */
class RGBColorItem extends FieldItemBase {

    /**
     * {@inheritDoc}
     */
    public static function schema(FieldStorageDefinitionInterface $field_definition){
        return [
            'columns' => [
                'r' => [
                    'type'     => 'int',
                    'not null' => true,
                    'size'     => 'tiny',
                    'unsigned' => true,
                ],
                'g' => [
                    'type'     => 'int',
                    'not null' => true,
                    'size'     => 'tiny',
                    'unsigned' => true,
                ],
                'b' => [
                    'type'     => 'int',
                    'not null' => true,
                    'size'     => 'tiny',
                    'unsigned' => true,
                ],
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition){
        $properties      = [];
        $properties['r'] = DataDefinition::create('integer')->setLabel(t('Red'))->setRequired(true);
        $properties['g'] = DataDefinition::create('integer')->setLabel(t('Green'))->setRequired(true);
        $properties['b'] = DataDefinition::create('integer')->setLabel(t('Blue'))->setRequired(true);

        return $properties;
    }

    /**
     * {@inheritDoc}
     */
    public function isEmpty(){
        return $this->get('r')->getValue() === null &&
        $this->get('g')->getValue() === null &&
        $this->get('b')->getValue() === null;
    }
}
