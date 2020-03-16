<?php

namespace Drupal\mymodule\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\SiteInformationForm;


class ExtendedSiteInformationForm extends SiteInformationForm {
 
   /**
   * {@inheritdoc}
   */
	  public function buildForm(array $form, FormStateInterface $form_state) {
		$site_config = $this->config('system.site');
		$form =  parent::buildForm($form, $form_state);
		$form['site_information']['siteapikey'] = [
			'#type' => 'textfield',
			'#title' => t('Site API Key'),
			'#default_value' => $site_config->get('siteapikey') ?: 'No API Key yet',
			'#description' => t("Custom field to set the API Key"),
		];
		$form['actions']['submit']['#value'] = t('Update configuration');
		return $form;
	}
	
	  public function submitForm(array &$form, FormStateInterface $form_state) {
		$val_key = $form_state->getValue('siteapikey');
		$this->config('system.site')
		  ->set('siteapikey', $val_key)
		  ->save();
		parent::submitForm($form, $form_state);
		 drupal_set_message("Site API Key has been saved with ".$val_key." value.");
	  }
}