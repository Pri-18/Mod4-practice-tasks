<?php
namespace Drupal\basic_page_custom\Controller;
use Drupal\Core\Controller\ControllerBase;

class BasicPageCustomController extends ControllerBase {
    public function basicPage(){
        return [
            '#title' => 'Custom basic page',
            '#markup' => 'Demo custom basic page'
        ];
    }

    public function infoPage(){
        $data = array(
            'Name' => 'Priyansu',
            'Email' => '@gmail.com'
        );

        //use services like this
        $title = \Drupal::service('basic_page_custom.hello_service');
        return [
            '#title' => $title->hello(),
            '#theme' => 'information_page',
            '#data' => $data
        ];
    }

    public function welcomePage() {
        return [
            '#markup' => 'custom_welcome_page'
            // '#theme' => 'custom_welcome_page'
        ];
    }
    
}
