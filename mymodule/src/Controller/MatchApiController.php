<?php

namespace Drupal\mymodule\Controller;

use Drupal\node\NodeInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Serialization\Json;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Response;

class MatchApiController extends ControllerBase {
  function foo($api_key, $node_id) {
  	$site_api_key = \Drupal::config('system.site')->get('siteapikey');
	$id = $node_id;
	$entityObj = entity_load('node',$id);
	$bundle = $entityObj->bundle();
	$serializer = \Drupal::service('serializer');
	$node = \Drupal\node\Entity\Node::load($id);
  	$node_json = array('id' =>$node->Id(), 'title' => $node->getTitle());
	$params = json_encode($node_json);
  	if ($api_key != $site_api_key || $bundle != 'page') {
  		throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
  		return;
  	}
	//$params = $serializer->serialize($node_json, 'json');
    $response = new Response($params);
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }
}

