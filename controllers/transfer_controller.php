<?php
if(!defined('INDEX')) die('Direct access is prohibited!');

// Include database connection
include $includes_path.'db_connection.php';

// Include common file
include $includes_path.'common.php';

// Include appropriate model for page
include $model_path.'transfer'.$model_extension;

$valid_sid = FALSE ;

if(array_key_exists('logged_in', $_SESSION)) {
	
	if(array_key_exists('sid', $_GET)  && ($formatted_sid = sid_format($_GET['sid']))) {
		if((array_key_exists('sid', $_SESSION) && $_SESSION['sid'] === $_GET['sid']) || in_array($_SESSION['user_role'], $staff_access)) {
			$valid_sid = TRUE ;
		}
		$sid = $_GET['sid'];
		
		// Change degree program, accessible only to students and admins
		if(array_key_exists('degree_change', $_GET) && in_array($_SESSION['user_role'], $student_access)) {
			if(change_degree($sid)) {
				header("location: index.php?page=transfer&sid=$sid");
			}
		}
		
		$student = get_student($sid);
		$student_program = get_student_program($sid);
		
		$program_list = get_program_list();
		
		if($student) {
			$formatted_phone = phone_format($student['work_phone'], '(,) , - ');
		} else {
			$valid_sid = FALSE ;
		}
	}
	
		// Validate submitted form
	$form_processed = FALSE ;
	$form_valid = FALSE ;
	$inst_other = FALSE ;
	
	if(array_key_exists('program', $_POST) && in_array($_SESSION['user_role'], $student_access)) {
		$form_processed = TRUE ;
		
		foreach ($program_list as $program) {
			if(in_array($_POST['program-id'], $program)) {
				$form_valid = TRUE ;
				break;
			}
		}
	
		if($form_valid) {
			if(add_program($sid, $_POST['program-id'])) {
				header('Location: '.$_SERVER['REQUEST_URI']);
			} else {
				$message = "<br>Problem Updating database...";
			}
		} else {
			$message = "<h4 class='text-danger'>Sorry, that is not a valid program.</h4>";
		}
		
	}
	
		if(array_key_exists('add-institution', $_POST) && in_array($_SESSION['user_role'], $student_access)) {
		$form_processed = TRUE ;
		
		$inst_id = $_POST['institution'];
		
		$inst_id_other = $_POST['other-inst'];
		
		if(preg_match('/^[\d]+$/', $inst_id) && check_institution($inst_id)) {
			$form_valid = TRUE ;
			// All good to go! Update student info!
			if(!add_transfer($sid, $inst_id)) {
				$message = 'Error inserting row into database.';
			}
			
		} elseif (trim(strtolower($inst_id)) == 'other') {
			// If other is selected, lets validate it!
			$inst_other = TRUE;
			if(preg_match('/^[\w\s\d]+$/', $inst_id_other)) {
				// All valid
				$form_valid = TRUE ;
				
				// Insert new value
				$new_institution = ucwords(strtolower(trim($inst_id_other)));
				
				if(check_institution_by_name($new_institution)) {
					if(!add_transfer($sid, get_institution_id($new_institution))){
						$message = 'Error inserting row into database.';
					}
				} else if(add_institution($new_institution)) {
					if(!add_transfer($sid, 'LAST_INSERT_ID()')){
						$message = 'Error inserting row into database.';
					}
				}
			} else {
				$message = 'Please enter a valid institution.';	
			}
		} else {
			// No valid options are selected
			$message = 'Not a valid institution';
		} 
		
	}
	 
	// Confirm tranfer, accessible only to staff and admin
	if(array_key_exists('confirm', $_GET) && preg_match('/^[0-9]+$/', $_GET['confirm']) && in_array($_SESSION['user_role'], $staff_access)) {
		confirm_transfer($_GET['confirm'], $sid, $_SESSION['username']);
	}
	
	// Delete tranfer, accessible only to students and admin
	if(array_key_exists('delete', $_GET) && preg_match('/^[0-9]+$/', $_GET['delete']) && in_array($_SESSION['user_role'], $student_access)) {
		delete_transfer($_GET['delete'], $sid);
	}
}

if($valid_sid) {
	$added_institutions = get_added_institutions($sid);
	$institutions = get_institutions();
} else {
	header("location: index.php?page=login");
}

//** Display the page **//

$page_title = 'Transfer : Binary';

// Include header file
include $view_path.'template/header.php';

// Include appropriate view for page
include $view_path.'pages/transfer.php';

// Include footer file
include $view_path.'template/footer.php';
?>