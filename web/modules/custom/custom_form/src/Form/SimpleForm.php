<?php
namespace Drupal\custom_form\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Simple form class
 */
class SimpleForm extends FormBase {

    /**
     * {@inheritDoc}
     * @return string
     */
    public function getFormId(){
        return 'custom_simple_form';
    }

    /**
     * function to  build the Form
     * @param array $form
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     * {@inheritDoc}
     * 
     * @return array
     */
    public function buildForm(array $form, FormStateInterface $form_state){
        $form['name'] = [
            '#type' => 'textfield', 
            '#title' => $this->t('Your name'),
            '#required' => TRUE
        ];

        $form['email'] = [
            '#type' => 'email',
            '#title' => $this->t('Your Email'),
            '#required' => TRUE
        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Send Message')
        ];
        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state){
        \Drupal::messenger()->addMessage('Hello' . $form_state->getValue('name'));
        \Drupal::messenger()->addMessage('Your email -> ' . $form_state->getValue('email'));
        \Drupal::messenger()->addMessage('YYour response is submitted');
    }

}
