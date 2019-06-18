<?php
if(!defined('INDEX')) die('Direct access is prohibited!');

if(isset($pdoConnection) && $pdoConnection != null) {

	function get_student($sid) {
		global $pdoConnection ;
		
		if($student = $pdoConnection->query("SELECT * FROM students WHERE sid=$sid LIMIT 1")) {
			return $student->fetch(PDO::FETCH_ASSOC);
		} else {
			return FALSE ; 		
		}
	}
	
	function get_student_program($sid) {
		global $pdoConnection;
		
		if($student_program = $pdoConnection->query("SELECT * FROM student_evaluation JOIN degree_programs ON program_id=prog_id WHERE student_id=$sid AND program_id <> ''")) {
			return $student_program->fetch(PDO::FETCH_ASSOC);
		} else {
			return FALSE ;
		}
	}
	
	function get_program_list() {
		global $pdoConnection;
		
		if($program_list = $pdoConnection->query("SELECT * FROM degree_programs ORDER BY prog_desc ASC")) {
			return $program_list->fetchAll();
		} else {
			return FALSE ;
		}
	}
	
	function add_program($sid, $program) {
		global $pdoConnection;
		
		if($pdoConnection->exec("INSERT INTO student_evaluation (student_id, program_id) VALUES ($sid, '$program')")) {
			return TRUE ;
		} else {
			return FALSE ;
		}
	}
	
	function get_institutions() {
		global $pdoConnection;
		
		// Grab a general list of institutions
		if($institutions = $pdoConnection->query("SELECT DISTINCT * FROM institutions")) {
			return $institutions->fetchAll();
		} else {
			return FALSE ;
		}
	}
	
	function get_added_institutions($sid) {
		global $pdoConnection;
		
		// Grab a list of institutions for the student
		if($institutions = $pdoConnection->query("SELECT * FROM transfers t JOIN institutions i ON t.inst_id = i.inst_id WHERE t.sid=$sid")) {
			return $institutions->fetchAll();
		} else {
			return FALSE ;
		}
	}
	
	function get_institution_id($institution_name) {
		global $pdoConnection ;
		
		if($institution_id = $pdoConnection->query("SELECT inst_id FROM institutions WHERE inst_name='$institution_name' LIMIT 1")) {
			$inst_id = $institution_id->fetch(PDO::FETCH_ASSOC);
			return $inst_id['inst_id'];
		} else {
			return FALSE ;
		}
	}
	
	function check_institution($institution_id) {
		global $pdoConnection;
		
		// Check to see if institution exists in database
		if($inst_id = $pdoConnection->query("SELECT inst_name FROM institutions WHERE inst_id=$institution_id LIMIT 1")) {
			if(count($inst_id->fetch(PDO::FETCH_NUM)) > 0)
				return TRUE ;
			else {
				return FALSE ;
			}
		} else {
			return FALSE ;
		}
	}
	
	function check_institution_by_name($institution_name) {
		global $pdoConnection;
		
		// Check to see if institution exists in database
		if($inst_id = $pdoConnection->query("SELECT inst_name FROM institutions WHERE inst_name='$institution_name' LIMIT 1")) {
			if($inst_id->fetch(PDO::FETCH_NUM)) {
				return TRUE ;	
			}
			else {
				return FALSE ;
			}
		} else {
			return FALSE ;
		}
	}
	
	function add_transfer($sid, $inst_id) {
		global $pdoConnection ;
		
		if($pdoConnection->query("INSERT INTO transfers (sid, inst_id) VALUES($sid, $inst_id)")) {
			return TRUE	;
		} else {
			return FALSE ;
		}
	}
	
	function add_institution($new_institution) {
		global $pdoConnection ;
		
		if($pdoConnection->query("INSERT INTO institutions(inst_name) VALUES('$new_institution')")) {
			return TRUE ;
		} else {
			return FALSE ;
		}
	}
	
	function confirm_transfer($transfer_id, $sid, $username) {
		global $pdoConnection;
		
		if($pdoConnection->query("UPDATE transfers SET received=1, receiver='$username' WHERE id=$transfer_id AND sid=$sid")){
			return TRUE ;
		} else {
			return FALSE ;
		}
	}
	
	function delete_transfer($transfer_id, $sid) {
		global $pdoConnection;
		
		if($pdoConnection->query("DELETE FROM transfers WHERE id=$transfer_id AND sid=$sid")){
			return TRUE ;
		} else {
			return FALSE ;
		}
	}
	
	function change_degree($sid) {
		global $pdoConnection;
		
		if($pdoConnection->query("DELETE FROM student_evaluation WHERE student_id=$sid")) {
			return TRUE ;
		} else {
			return FALSE ;
		}
	}
	
} else {
	die('Please check your database configuration');
}
?>