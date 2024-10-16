<?php 

/**
 * Used to define the routes in the system.
 * 
 * A route should be defined with a key matching the URL and an
 * controller#action-to-call method. E.g.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 */
$routes = array(
	'/test' => 'test#index',
	'/' => 'view#index',
	'/create' => 'view#create',
	'/read' => 'view#read',
	//'/update' => 'application#update',
	//'/delete' => 'application#delete',
	'/tasks/add' => 'task#add',
	'/tasks/read' => 'task#read',
	'/tasks/success' => 'view#success',
);