<?php
if(!defined('INDEX')) die('Direct access is prohibited!');

// Include database connection
include $includes_path.'db_connection.php';

// Include appropriate model for page
include $model_path.'login'.$model_extension;

// Logout process
if(array_key_exists('logout', $_GET) && $_GET['logout'] == 1) {
	$_SESSION[] = array();
	session_destroy();
}

// Form has been submitted, lets process it!
if(array_key_exists('signin', $_POST)) {
	$username = trim($_POST['username']);
	$passowrd = trim($_POST['password']);
	
	if(strlen($username) > 1 && strlen($passowrd) > 1 && ($userinfo = auth_user($username,$passowrd))){
		// User is authenticated! Set up sessions and redirect!
		if(strlen($userinfo['alternate_id']) >= 1) {
			$_SESSION['sid'] = $userinfo['alternate_id'];
		}
		
		$_SESSION['logged_in'] = TRUE ;
		$_SESSION['user_role'] = $userinfo['user_role'];
		$_SESSION['username'] = $userinfo['username'];
		
	} else {
		// No user found, or incorrect data entered!
		$error_message = "Incorrect username or password.";
	}
}

if(array_key_exists('user_role', $_SESSION)) {
	switch ($_SESSION['user_role']) {
		case 'student':
			header("location:index.php?page=$default_student_controller&sid=$_SESSION[sid]");
			break;
		
		case 'admin':
			header("location:index.php?page=$default_admin_controller");
			break;
			
		case 'staff':
			header("location:index.php?page=$default_staff_controller");
			break;
	}
}

//** Display the page **//

// Include header file
include $view_path.'template/header.php';

// Include appropriate views
include $view_path.'pages/login.php';

// Include footer file
include $view_path.'template/footer.php';
?>