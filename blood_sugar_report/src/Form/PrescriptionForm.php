<?php
/**
 * @file
 * Contains \Drupal\blood_sugar_report\Form\PrescriptionForm.
 */
namespace Drupal\blood_sugar_report\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Database\Database;
use Drupal\file\Entity\File;

 
class PrescriptionForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'prescription_form';
  }
 
  public function buildForm(array $form, FormStateInterface $form_state) {
	$database = \Drupal::database();
	$current_user = \Drupal::currentUser();
	$uid = $current_user->id();
	$query = $database->select('blood_sugar_report', 'bsr');
	$query->condition('bsr.uid', $uid, '=');
	$query->fields('bsr', ['pid', 'bs_level']);
	$result = $query->execute();
	$options =  $result->fetchAllKeyed(); 
	$option = array();

	foreach ($options as $key => $record) {
		$option[$key] = $record; 
	}
	//print_r($options);
	//die();
	//print_r($query->__toString());
	//print_r($query->arguments());
	//die();
	
    $form = array(
      '#attributes' => array('enctype' => 'multipart/form-data'),
    );
	
	$validators = array(
      'file_validate_extensions' => array('pdf'),
    );
	$form['bs_level'] = array(
      '#type' => 'select',
      '#title' => $this->t('Blood Sugar Level'),
	  '#description' => $this->t('Please select blood sugar level againt which you want to upload the prescription. '),
	  '#options' => $option,
	  '#default_value' => 'Select',
	  '#required' => TRUE,
    );
    $form['file_upload'] = array(
      '#type' => 'managed_file',
      '#title' => $this->t('Upload file'),
	  '#description' => $this->t('PDF format only'),
      '#placeholder' => $this->t('PDF format only'),
      '#upload_validators' => $validators,
      '#upload_location' => 'public://blood_report/',
    );
	$form['file_desc'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Decription'),
      '#placeholder' => $this->t('Enter file description'),
      '#required' => TRUE,
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {    
    if ($form_state->getValue('file_upload') == NULL) {
      $form_state->setErrorByName('file_upload', $this->t('Upload file field can not be empty.'));
    }
  }
   
  public function submitForm(array &$form, FormStateInterface $form_state) {
	 global $base_url;
	 
	 $conn = Database::getConnection();
	 $current_user = \Drupal::currentUser();
	 $uid = $current_user->id();
	 
	 $fid = $form_state->getValue(['file_upload', 0]);
	 $current_user_email = $current_user->getEmail();
	 
	 $cuurent_date_time = date('Y-m-d h:i:s a', time());
	
	//\Drupal::logger('b_s_r')->notice($bsv);
	if(!empty($fid)) {
		 $file = File::load($fid);
		 $file_size = $file->getSize();
		 $file_name = $file->getFilename();
		 $file_desc = $form_state->getValue('file_desc');
		 $bs_level = $form_state->getValue('bs_level');

		// db_insert 
		$conn->insert('prescription_report')->fields(
		array(
		'file_name' => $file_name,
		'file_des' => $file_desc,
		'file_size' => $file_size.' bytes',
		'email' => $current_user_email,
		'date_time' => $cuurent_date_time,
		'PID' => $bs_level,
		'UID' => $uid,
		)
		)->execute();	
	}
	// Display success message.
			
	$url = Url::fromRoute('bsr.myspaceform');
	$form_state->setRedirectUrl($url);
    drupal_set_message('file uploaded successfully.');
   }
}