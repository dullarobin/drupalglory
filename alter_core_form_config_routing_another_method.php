<?php
function modulename_form_system_site_information_settings_alter(&$form, $form_state, $form_id)
{

    // Add Site API Key field to 'Site Information' section
    $modulename = \Drupal::config('siteapikey.configuration')->get('siteapikey');
    $form['site_information']['modulename'] = array(
        '#type' => 'textfield',
        '#title' => t('Site API Key'),
        '#default_value' => $modulename,
        '#description' => t('An API Key to access site pages in JSON format.'),
    );

    // Change form submit button text to 'Update Configuration'
    $form['actions']['submit']['#value'] = t('Update configuration');

    // Handle form submission
    $form['#submit'][] = 'modulename_handler';
}

function modulename_handler($form, &$form_state)
{
    // Update the system variable Site API Key
    $config = \Drupal::configFactory()->getEditable('siteapikey.configuration');
    $new_modulename = $form_state->getValue(['modulename']);
    $config->set('siteapikey', $new_modulename);
    $config->save();

    // Add message that Site API Key has been set
    drupal_set_message("Successfully set Site API Key to " . $new_modulename);
}

/**
 * Implements hook_uninstall().
 */
function modulename_uninstall(){
    // Remove the previously set Site API Key configuration
    \Drupal::configFactory()->getEditable('siteapikey.configuration')->delete();
}