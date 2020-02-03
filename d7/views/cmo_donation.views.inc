<?php
/**
 * Implements hook_views_data()
 */
function cmo_donation_views_data()
{
   $data = array();	
   $data['cmo_donation_table']['table']['group'] = t('CMO Donation Table');

$data['cmo_donation_table']['table']['base'] = array(
    'field' => 'nid', // This is the identifier field for the view.
    'title' => t('CMO Donation Table'),
    'help' => t('CMO Donation table contains content and can be related to nodes.'),
    'weight' => -10,
  );

   $data['cmo_donation_table']['name'] = array(
    'title' => t('Name'),
    'help' => t('Just a plain text field.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE, // This is use by the table display plugin.
    ),
	'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );
  
 $data['cmo_donation_table']['i_am'] = array(
    'title' => t('Register As'),
    'help' => t('Just a plain text field.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE, // This is use by the table display plugin.
    ),
	'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );
  
  $data['cmo_donation_table']['mobile'] = array(
    'title' => t('Mobile'),
    'help' => t('Just a numeric field.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
  );
  
  $data['cmo_donation_table']['pancard'] = array(
    'title' => t('Pancard'),
    'help' => t('Just a numeric field.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
  );
  
  $data['cmo_donation_table']['tinnumber'] = array(
    'title' => t('Tin Number'),
    'help' => t('Just a numeric field.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
  );
  
  $data['cmo_donation_table']['email'] = array(
    'title' => t('Email'),
    'help' => t('Just a Email field.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE, // This is use by the table display plugin.
    ),
	'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );
    
   $data['cmo_donation_table']['amount'] = array(
    'title' => t('Amount'),
    'help' => t('Just a amount field.'),
    'field' => array(
      'handler' => 'views_handler_field_numeric',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
  );
  
  $data['cmo_donation_table']['payment_mode'] = array(
    'title' => t('Payment Mode'),
    'help' => t('Just a amount field.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE, // This is use by the table display plugin.
    ),
	'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );  
  
  return $data;
}
?>