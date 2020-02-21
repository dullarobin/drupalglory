<?php

namespace Drupal\nsCrud\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class DataForm.
 *
 * @package Drupal\data\Form
 */
class DataForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'nscrud_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $conn = Database::getConnection();
     $record = array();
    if (isset($_GET['num'])) {
        $query = $conn->select('ns_data', 'nd')
            ->condition('id', $_GET['num'])
            ->fields('nd');
        $record = $query->execute()->fetchAssoc();

    }

    $form['user_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Candidate Name:'),
      '#required' => TRUE,
      '#default_value' => (isset($record['name']) && $_GET['num']) ? $record['name']:'',
      );

    $form['user_age'] = array (
      '#type' => 'textfield',
      '#title' => t('AGE'),
      '#required' => TRUE,
      '#default_value' => (isset($record['age']) && $_GET['num']) ? $record['age']:'',
       );

    $form['user_gender'] = array (
      '#type' => 'select',
      '#title' => ('Gender'),
      '#options' => array(
        'male' => t('Male'),
        'female' => t('Female'),
        '#default_value' => (isset($record['gender']) && $_GET['num']) ? $record['gender']:'',
        ),
      );

    $form['user_dob'] = array (
      '#type' => 'date',
      '#title' => t('DOB'),
      '#default_value' => (isset($record['dob']) && $_GET['num']) ? $record['dob']:'',
       );

    $form['submit'] = [
        '#type' => 'submit',
        '#value' => 'save',
    ];

    return $form;
  }

  /**
    * {@inheritdoc}
    */
  public function validateForm(array &$form, FormStateInterface $form_state) {

         $name = $form_state->getValue('user_name');
          if(preg_match('/[^A-Za-z]/', $name)) {
             $form_state->setErrorByName('user_name', $this->t('your name must in characters without space'));
          }

          // Confirm that age is numeric.
        if (!intval($form_state->getValue('user_age'))) {
             $form_state->setErrorByName('user_age', $this->t('Age needs to be a number'));
            }

    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
	$current_user = \Drupal::currentUser();
	$uid = $current_user->id();
    $field=$form_state->getValues();
    $name=$field['user_name'];
    $age=$field['user_age'];
    $gender=$field['user_gender'];
    $dob=$field['user_dob'];

    if (isset($_GET['num'])) {
          $field  = array(
              'name' => $name,
			  'uid' => $uid,
			  'dob' => $dob,
              'age' => $age,
              'gender' => $gender,
          );
          $query = \Drupal::database();
          $query->update('ns_data')
              ->fields($field)
              ->condition('id', $_GET['num'])
              ->execute();
          drupal_set_message("succesfully updated");
          $form_state->setRedirect('nsCrud.display_table_controller_display');

      }

       else
       {
           $field  = array(
              'name'   =>  $name,
			  'uid' => $uid,
			  'dob' => $dob,
              'age' => $age,
              'gender' => $gender,
          );
           $query = \Drupal::database();
           $query ->insert('ns_data')
               ->fields($field)
               ->execute();
           drupal_set_message("succesfully saved");

           $response = new RedirectResponse("/data/table");
           $response->send();
       }
     }

}
