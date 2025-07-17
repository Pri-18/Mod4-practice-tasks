<?php

namespace Drupal\custom_form\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   * The config object this form edits.
   */
  protected function getEditableConfigNames(): array {
    return ['custom_form.settings'];
  }

  /**
   * {@inheritdoc}
   * The unique form ID.
   */
  public function getFormId(): string {
    return 'custom_form_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $config = $this->config('custom_form.settings');

    $form['contact_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Full name'),
      '#default_value' => is_string($config->get('contact_name')) ? $config->get('contact_name') : '',
      '#required' => TRUE,
    ];    
    
    
    $form['contact_phone'] = [
      '#type' => 'tel',
      '#title' => $this->t('Phone number'),
      '#default_value' => is_string($config->get('contact_phone')) ? $config->get('contact_phone') : '',
      '#required' => TRUE,
    ];    
    
    
    $form['contact_email'] = [
      '#type' => 'email',
      '#title' => $this->t('Contact Email'),
      '#default_value' => is_string($config->get('contact_email')) ? $config->get('contact_email') : '',
      '#required' => TRUE,
    ];    
    
    
    $form['contact_gender'] = [
      '#type' => 'radios',
      '#title' => $this->t('Select your gender'),
      '#default_value' => $config->get('contact_gender') ? $config->get('contact_gender') : NULL,
      '#options' => [
            'male' => $this->t('Male'),
            'female' => $this->t('Female'),
            'other' => $this->t('Other'),
       ],

      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }


  /**
   * Summary of validateForm
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   * 
   * {@inheritDoc}
   * 
   * @return void
   */
  public function validateForm(array &$form, FormStateInterface $form_state){

    //mobile number validation
    $phone = $form_state->getValue('contact_phone');
    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        $form_state->setErrorByName('phone', $this->t('Phone number must be exactly 10 digits.'));
    }

    // email validations 
    //email validation 1 --> Check if it's a valid email
    $email = $form_state->getValue('contact_email');
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $form_state->setErrorByName('email', $this->t('Invalid email format.'));
    }

    //email validation 2 --> Check for pulblic domains
    $public_domains = ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com'];
    $email_domain = strtolower(substr(strrchr($email, "@"), 1));

    if(!in_array($email_domain, $public_domains)) {
        $form_state->setErrorByName('email', $this->t('Please use a public email domain like Gmail, Yahoo, or Outlook.'));
    }

    //email validation 3 --> cCheck if the email ends in .com
    if (!str_ends_with($email, '.com')) {
        $form_state->setErrorByName('email', $this->t('Only .com email addresses are allowed.'));
    }

    //email validation 4 --> Check if the email valid or not.
    try {
       $apiKey = $_ENV['API_KEY'] ?? '';
       $url = "http://apilayer.net/api/check?access_key=$apiKey&email=" . urlencode($email);
       $response = file_get_contents($url);

       if ($response === FALSE) {
          $form_state->setErrorByName('contact_email', $this->t('Unable to validate email using API.'));
       } else {
         $result = json_decode($response, true);

         if (isset($result['format_valid']) && !$result['format_valid']) {
           $form_state->setErrorByName('contact_email', $this->t('The email format is not valid according to the API.'));
         }
         if (isset($result['smtp_check']) && !$result['smtp_check']) {
           $form_state->setErrorByName('contact_email', $this->t('The email address does not appear to be deliverable.'));
         }
       }
      } catch (\Exception $e) {
        $form_state->setErrorByName('contact_email', $this->t('API error: @message', ['@message' => $e->getMessage()]));
      }

  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $config = $this->config('custom_form.settings');
    $config ->set('contact_name', $form_state->getValue('contact_name'));
    $config ->set('contact_phone', $form_state->getValue('contact_phone'));
    $config ->set('contact_email', $form_state->getValue('contact_email'));
    $config ->set('contact_gender', $form_state->getValue('contact_gender'));
    $config->save();

    $this->messenger()->addMessage($this->t('Settings saved successfully.'));

    parent::submitForm($form, $form_state);
  }
}
