<?php

namespace Drupal\user_registration_otp\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session;
use Drupal\user\PrivateTempStoreFactory;

/**
 * Class OtpForm.
 */
class OtpForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'user_regis_otp';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['otp'] = [
      '#type' => 'textfield',
      '#title' => $this->t('OTP'),
      '#description' => $this->t('Enter OTP sent in mail'),
      '#maxlength' => 10,
      '#size' => 64,
      '#weight' => '0',
	  '#required' => True,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if ($form_state->getValue('otp') == NULL) {
      $form_state->setErrorByName('otp', $this->t('OTP field can not be empty.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
	$database = \Drupal::database();
	
	$tempstore = \Drupal::service('user.private_tempstore')->get('user_registration_otp'); 
	$mail = $tempstore->get('user_otp_mail');
	
	$otp_user = $form_state->getValue('otp');
	
	$query = $database->select('user_regis_otp', 'uro');
	$query->condition('uro.mail', $mail, '=');
	$query->fields('uro', ['otp']);
	$result = $query->execute();
	$otp_db =  $result->fetchField();

	if($otp_db == $otp_user) {
		$response = new RedirectResponse("/user/register");
		$response->send();
		return;
	}
	else {
		drupal_set_message(t("Please enter a valid OTP"), 'error');
		return;
	}
  }  
}
