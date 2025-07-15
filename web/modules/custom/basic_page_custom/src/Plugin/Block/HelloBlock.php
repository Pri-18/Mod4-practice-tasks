<?php

namespace Drupal\basic_page_custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;


/**
 * Provides a 'Hello Priyansu' Block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello Block custom"),
 *   category = @Translation("Custom-basic page")
 * )
 */
class HelloBlock extends BlockBase {

    /**
     * {@inheritDoc}
     */
    public function build(){
        return [
            '#markup' => $this->t('Hello world')
        ];
    }
}
