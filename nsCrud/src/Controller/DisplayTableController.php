<?php

namespace Drupal\nsCrud\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;

/**
 * Class DisplayTableController.
 *
 * @package Drupal\nsCrud\Controller
 */
class DisplayTableController extends ControllerBase {

  /**
   * Display.
   *
   * @return string
   * 
   */
  public function display() {

    //create table header
	$user_input_form = Url::fromRoute('nsCrud.data_form');
	$add_data_form = \Drupal::l(' Add Data', $user_input_form);

	$header_table = array();
	$header_table = array($add_data_form);
    $header_table = array(
      'id'=>    t('Sr.No.'),
      'name' => t('Name'),
      'dob' => t('DOB'),
      'age' => t('Age'),
      'gender' => t('Gender'),
	  'delete' => t('Delete'),
	  'update' => t('Update'),
	 // 'add_data' => t('Add Data'),
    );

	//select records from table
    $query = \Drupal::database()->select('ns_data', 'nd');
    $query->fields('nd', ['id','name','dob','age','gender']);
    $results = $query->execute()->fetchAll();
    $rows=array();
    foreach($results as $data){
        $delete = Url::fromUserInput('/data/form/delete/'.$data->id);
        $edit   = Url::fromUserInput('/nsCrud/form/data?num='.$data->id);

      //print the data from table
		$rows[] = array(
			'id' =>$data->id,
			'name' => $data->name,
			'dob' => $data->dob,
			'age' => $data->age,
			'gender' => $data->gender,
			'delete' => \Drupal::l('Delete', $delete),
			'update' => \Drupal::l('Edit', $edit),
			//'add_data' => \Drupal::l('Add Data', $user_input_form),
		);

    }
    //display data in site
    $form['table'] = [
			'#prefix'=> '<div>'.$add_data_form.'</div>',
            '#type' => 'table',
            '#header' => $header_table,
            '#rows' => $rows,
            '#empty' => t('No data found Please '.$add_data_form),
        ];
        return $form;

  }

}
