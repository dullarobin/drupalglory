<?php

/**
 * @file
 * Contains Drupal\blood_sugar_report\Form\AdminConfigurationForm.
 */

namespace Drupal\blood_sugar_report\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class AdminConfigurationForm.
 *
 * @package Drupal\blood_sugar_report\Form
 */
class AdminConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'blood_sugar_report.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('blood_sugar_report.settings');
    $form['blood_sugar_report_on_off'] = array(
      '#type' => 'select',
      '#title' => $this->t('BSR Form ON/OFF'),
	  '#options' => array(
		'ON' => t('ON'),
		'OFF' => t('OFF'),
		),
      '#default_value' => $config->get('blood_sugar_report_on_off'),
    );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('blood_sugar_report.settings')
      ->set('blood_sugar_report_on_off', $form_state->getValue('blood_sugar_report_on_off'))
      ->save();
  }

}