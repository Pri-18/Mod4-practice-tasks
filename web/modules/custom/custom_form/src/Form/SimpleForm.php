<?php
namespace Drupal\custom_form\Form;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;

/**
 * Simple form class
 */
class SimpleForm extends FormBase {

    protected $messenger;

    /**
     * To construct the dependency injection
     * @param \Drupal\Core\Messenger\MessengerInterface $messenger
     */
    public function __construct(MessengerInterface $messenger) {
        $this->messenger = $messenger;
    }

    /**
     * Factory method for dependency injection.
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     * 
     * @return static
     */
    public static function create(ContainerInterface $container) {
        return new static (
            $container->get('messenger')
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getFormId(){
        return 'custom_simple_form';
    }

    /**
     * {@inheritDoc}
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

    /**
     * TO submit the form.
     * @param array $form
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     * 
     * @return void
     */
    public function submitForm(array &$form, FormStateInterface $form_state){
        $this->messenger->addMessage('Hello' . $form_state->getValue('name'));
        $this->messenger->addMessage('Your email -> ' . $form_state->getValue('email'));
        $this->messenger->addMessage('YYour response is submitted');
    }

}
