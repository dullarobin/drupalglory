<?php
/**
 * @file
 * Contains \Drupal\blood_sugar_report\Form\BloodSugarForm.
 */
namespace Drupal\blood_sugar_report\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Database\Database;
use Drupal\Core\Datetime\DrupalDateTime;

 
class BloodSugarForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'blood_sugar_value_form';
  }
 
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['bs_level'] = array(
      '#type' => 'textfield',
      //'#title' => $this->t('Blood Sugar Level:'),
	  '#placeholder' => $this->t('Enter blood sugar value b/w 0-10'),
      '#pattern' => '([0-9]|0[0-9]|10)$',
	  '#weight' => -6,
      '#required' => TRUE,
    ); 
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save BS Value'),
      '#button_type' => 'primary',
    );
    return $form;
  }
 
  public function submitForm(array &$form, FormStateInterface $form_state) {
	$config = $this->config('blood_sugar_report.settings');
    $bsr_on_off = $config->get('blood_sugar_report_on_off');
	  if ($bsr_on_off == 'OFF') {
		$now = new DrupalDateTime();
		$begin = new DrupalDateTime('06:00');
		$end = new DrupalDateTime('12:00');
		if ($now >= $begin && $now <= $end) {
		  
		}else {
		  drupal_set_message(t('Form has been closed for now. Please contact administrator.'), 'error');
		  return false;
		}
	  }
    $conn = Database::getConnection();
	$current_user = \Drupal::currentUser();
	$uid = $current_user->id();
	
	$cuurent_date_time = date('Y-m-d h:i:s a', time());
	$bsv = $form_state->getValue('bs_level');
	$name = $current_user->getUsername();
	$email = $current_user->getEmail();
	if(isset($bsv)) {
		$conn->insert('blood_sugar_report')->fields(
		  array(
			'bs_level' => $form_state->getValue('bs_level'),
			'name' => $name,
			'email' => $email,
			'date_time' => $cuurent_date_time,
			'uid' => $uid,
		  )
		)->execute();
	   // $url = Url::fromRoute('bsr.thankyou');
	  //  $form_state->setRedirectUrl($url);
	}
	drupal_set_message('Blood sugar recorded successfully.');
   }
 
  public function validateForm(array &$form, FormStateInterface $form_state) {
	  
  }
}