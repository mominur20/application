<?php
if(!defined('INDEX')) die('Direct access is prohibited!');

if(isset($pdoConnection) && $pdoConnection != null) {
	
	function add_student($student_info) {
		global $pdoConnection ;
		
		if(is_array($student_info) && $pdoConnection->query("INSERT INTO students(	sid,
															first_name,
															last_name,
															work_phone,
															gender,
															address,
															city,
															state,
															zip)
													VALUES(	$student_info[sid],
															'$student_info[first_name]',
															'$student_info[last_name]',
															$student_info[phone],
															'$student_info[gender]',
															'$student_info[address]',
															'$student_info[city]',
															'$student_info[state]',
															$student_info[zip])")) {
			return TRUE ;
		} else {
			return FALSE ;
		}
	}
	
} else {
	die('Please check your database configuration');
}
?>