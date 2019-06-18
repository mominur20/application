<?php
// Start Session Tracking
session_start();
// Start Output buffer
ob_start();

// Loaded with index.php
define('INDEX', TRUE);

// Paths
$model_path = 'models/';
$view_path = 'views/';
$controller_path = 'controllers/';
$config_path = 'config/';
$includes_path = 'includes/';

// Extensions
$model_extension = '_model.php';
$controller_extension = '_controller.php';

$_404_file_name = '404';

// Default Controller
$default_controller = 'login';

// Load configuration file
include $config_path.'config.php';

if(array_key_exists('page', $_GET)) {
	$file = preg_match('/^[\w\d\-\.]+$/', $_GET['page']) ? $_GET['page']: '' ;
	
	$controller = $controller_path.$file.$controller_extension;	
	
	if(file_exists($controller)) {
		// Check to see that the controller exists
		include $controller;
	} else {
		// Otherwise display a 404 not found
		include $controller_path.$_404_file_name.$controller_extension;
	}
} else {
	$file = $default_controller;
	include $controller_path.$default_controller.$controller_extension;
}
?>