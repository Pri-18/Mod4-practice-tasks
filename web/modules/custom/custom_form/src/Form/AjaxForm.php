<?php
namespace Drupal\custom_form\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class AjaxForm extends FormBase {

    public function getFormId(){
        return 'ajax_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state){

        $form['msg'] = [
            '#type' => 'markup',
            '#markup'=> '<div class="result"> </div>'
        ];

        $form['Number1'] = [
            '#type' => 'textfield',
            '#title' => $this->t("First number")
        ];        
        
        $form['Number2'] = [
            '#type' => 'textfield',
            '#title' => $this->t("Second number")
        ];

        $form['actions'] = [
            '#type' => 'button',
            '#value' => $this->t('Calculate'),
            '#ajax' => [
                'callback' => '::setMessage'
            ]
            ];

        return $form;
    }

    public function setMessage(array &$form, FormStateInterface $form_state) {
        $res = new AjaxResponse();
        $res-> addCommand(
            new HtmlCommand(
                '.result',
                '<div class="top-msg">' . $this->t('The result is @res', ['@res' => ($form_state->getValue('Number1')) + ($form_state->getValue('Number2'))])
            )
        );
        return $res;

    }

      /**
      * {@inheritdoc}
      */
    public function submitForm(array &$form, FormStateInterface $form_state) {
    }

}