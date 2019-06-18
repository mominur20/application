<?php
if(!defined('INDEX')) die('Direct access is prohibited!');

if(!in_array($_SESSION['user_role'], $staff_access)) {
	header("location:index.php?page=login");
}

// Include database connection
include $includes_path.'db_connection.php';

// Include common functions file
include $includes_path.'common.php';

// Include model
include $model_path.'students'.$model_extension;

$name = (isset($_GET['name'])) ? $_GET['name'] : '';
$order_by = (isset($_GET['orderBy'])) ? $_GET['orderBy'] : '';
$order = (isset($_GET['order'])) ? $_GET['order'] : '';

$url = '?';

foreach ($_GET as $key => $value) {
	if(strtolower($key) == 'ajax') continue;
	if(strtolower($key) == 'order') {
		if(strtolower($value) == 'asc')
			$value = 'desc';
		else
			$value = 'asc';
	}
		
	$url .= $key.'='.$value.'&';
}

$params = array('name' => $name, 'order' => $order_by, 'dir' => $order);

if(array_key_exists('scope', $_GET) && preg_match('/^all|new|outstanding|undecided$/', strtolower($_GET['scope']))) {
	$params['scope'] = $_GET['scope'];
}
			
$students = get_students($params);

if(isset($_GET['ajax']) && $_GET['ajax'] == 1) {
	include $view_path.'pages/students.php';
	die();
}

//** Display the page **//

$page_title = "Students : Binary";

// Include header file
include $view_path.'template/header.php';

// Include appropriate view file
include $view_path.'pages/students.php';

// Include footer file
include $view_path.'template/footer.php';
?>