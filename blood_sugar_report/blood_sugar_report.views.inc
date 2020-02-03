<?php
/**
 * Implement hook_views_data()
 */

function blood_sugar_report_views_data() {
	$data = array();
	
	$data['blood_sugar_report']['table']['group'] = t('Blood Sugar Report');
	//$data['blood_sugar_report']['table']['provider'] = 'blood_sugar_module';
	
	$data['blood_sugar_report']['table']['base'] = array(
		// Identifier (primary) field in this table for Views.
		'field' => 'pid',
		// Label in the UI.
		'title' => t('Blood Sugar Report'),
		// Longer description in the UI. Required.
		'help' => t('Contains blood sugar report of blood sugar user.'),
		'weight' => -9,
    );
	  // Numeric field, exposed as a field, sort, filter, and argument.
    $data['blood_sugar_report']['bs_level'] = array(
		'title' => t('Blood Sugar Level'),
		'help' => t('Blood sugar value.'),
		'field' => array(
		  // ID of field handler plugin to use.
		  'id' => 'numeric',
		),
		'sort' => array(
		  // ID of sort handler plugin to use.
		  'id' => 'standard',
		),
		'filter' => array(
		  // ID of filter handler plugin to use.
		  'id' => 'numeric',
		),
		'argument' => array(
		  // ID of argument handler plugin to use.
		  'id' => 'numeric',
		),
    );
	$data['blood_sugar_report']['name'] = array(
		'title' => t('User name'),
		'help' => t('Report user name.'),
		'field' => array(
		  // ID of field handler plugin to use.
		  'id' => 'standard',
		),
		'sort' => array(
		  // ID of sort handler plugin to use.
		  'id' => 'standard',
		),
		'filter' => array(
		  // ID of filter handler plugin to use.
		  'id' => 'string',
		),
		'argument' => array(
		  // ID of argument handler plugin to use.
		  'id' => 'string',
		),
	);
	$data['blood_sugar_report']['email'] = array(
		'title' => t('Email'),
		'help' => t('Report user email.'),
		'field' => array(
		  // ID of field handler plugin to use.
		  'id' => 'standard',
		),
		'sort' => array(
		  // ID of sort handler plugin to use.
		  'id' => 'standard',
		),
		'filter' => array(
		  // ID of filter handler plugin to use.
		  'id' => 'string',
		),
		'argument' => array(
		  // ID of argument handler plugin to use.
		  'id' => 'string',
		),
	);
	$data['blood_sugar_report']['date_time'] = array(
		'title' => t('Date time'),
		'help' => t('Report date and time.'),
		'field' => array(
		  // ID of field handler plugin to use.
		  'id' => 'standard',
		),
		'sort' => array(
		  // ID of sort handler plugin to use.
		  'id' => 'standard',
		),
		'filter' => array(
		  // ID of filter handler plugin to use.
		  'id' => 'string',
		),
		'argument' => array(
		  // ID of argument handler plugin to use.
		  'id' => 'string',
		),
	);
	// Numeric field, exposed as a field, sort, filter, and argument.
    $data['blood_sugar_report']['uid'] = array(
		'title' => t('User Id'),
		'help' => t('User id of current user.'),
		'field' => array(
		  // ID of field handler plugin to use.
		  'id' => 'numeric',
		),
		'sort' => array(
		  // ID of sort handler plugin to use.
		  'id' => 'standard',
		),
		'filter' => array(
		  // ID of filter handler plugin to use.
		  'id' => 'numeric',
		),
		'argument' => array(
		  // ID of argument handler plugin to use.
		  'id' => 'numeric',
		),
    );
	
	/*********PRESCRIPTION REPORT STARTS HERE*******************/
	$data['prescription_report']['table']['group'] = t('Prescription Report');
	
	$data['prescription_report']['table']['base'] = array(
		// Identifier (primary) field in this table for Views.
		'field' => 'prid',
		// Label in the UI.
		'title' => t('Prescription Report'),
		// Longer description in the UI. Required.
		'help' => t('Prescription Report table contains prescription report of blood sugar user.'),
		'weight' => -10,
    );
	$data['prescription_report']['file_name'] = array(
		'title' => t('File name'),
		'help' => t('Prescription file name.'),
		'field' => array(
		  // ID of field handler plugin to use.
		  'id' => 'standard',
		),
		'sort' => array(
		  // ID of sort handler plugin to use.
		  'id' => 'standard',
		),
		'filter' => array(
		  // ID of filter handler plugin to use.
		  'id' => 'string',
		),
		'argument' => array(
		  // ID of argument handler plugin to use.
		  'id' => 'string',
		),
	);
	$data['prescription_report']['file_des'] = array(
		'title' => t('File Description'),
		'help' => t('Prescription file description.'),
		'field' => array(
		  // ID of field handler plugin to use.
		  'id' => 'standard',
		),
		'sort' => array(
		  // ID of sort handler plugin to use.
		  'id' => 'standard',
		),
		'filter' => array(
		  // ID of filter handler plugin to use.
		  'id' => 'string',
		),
		'argument' => array(
		  // ID of argument handler plugin to use.
		  'id' => 'string',
		),
	);
	$data['prescription_report']['file_size'] = array(
		'title' => t('File Size'),
		'help' => t('Prescription file size.'),
		'field' => array(
		  // ID of field handler plugin to use.
		  'id' => 'standard',
		),
		'sort' => array(
		  // ID of sort handler plugin to use.
		  'id' => 'standard',
		),
		'filter' => array(
		  // ID of filter handler plugin to use.
		  'id' => 'string',
		),
		'argument' => array(
		  // ID of argument handler plugin to use.
		  'id' => 'string',
		),
	);
	$data['prescription_report']['email'] = array(
		'title' => t('File Email'),
		'help' => t('Email of user uploaded prescription file.'),
		'field' => array(
		  // ID of field handler plugin to use.
		  'id' => 'standard',
		),
		'sort' => array(
		  // ID of sort handler plugin to use.
		  'id' => 'standard',
		),
		'filter' => array(
		  // ID of filter handler plugin to use.
		  'id' => 'string',
		),
		'argument' => array(
		  // ID of argument handler plugin to use.
		  'id' => 'string',
		),
	);
	$data['prescription_report']['date_time'] = array(
		'title' => t('Date Time'),
		'help' => t('Date and time of prescription file uploaded user.'),
		'field' => array(
		  // ID of field handler plugin to use.
		  'id' => 'standard',
		),
		'sort' => array(
		  // ID of sort handler plugin to use.
		  'id' => 'standard',
		),
		'filter' => array(
		  // ID of filter handler plugin to use.
		  'id' => 'string',
		),
		'argument' => array(
		  // ID of argument handler plugin to use.
		  'id' => 'string',
		),
	);
	// Numeric field, exposed as a field, sort, filter, and argument.
    $data['prescription_report']['PID'] = array(
		'title' => t('PID'),
		'help' => t('Primary key of table Blood sugar report.'),
		'field' => array(
		  // ID of field handler plugin to use.
		  'id' => 'numeric',
		),
		'sort' => array(
		  // ID of sort handler plugin to use.
		  'id' => 'standard',
		),
		'filter' => array(
		  // ID of filter handler plugin to use.
		  'id' => 'numeric',
		),
		'argument' => array(
		  // ID of argument handler plugin to use.
		  'id' => 'numeric',
		),
    );
	// Numeric field, exposed as a field, sort, filter, and argument.
    $data['prescription_report']['UID'] = array(
		'title' => t('User Id'),
		'help' => t('User id of current user.'),
		'field' => array(
		  // ID of field handler plugin to use.
		  'id' => 'numeric',
		),
		'sort' => array(
		  // ID of sort handler plugin to use.
		  'id' => 'standard',
		),
		'filter' => array(
		  // ID of filter handler plugin to use.
		  'id' => 'numeric',
		),
		'argument' => array(
		  // ID of argument handler plugin to use.
		  'id' => 'numeric',
		),
    );

return $data;
}
