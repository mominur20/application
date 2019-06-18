<?php
if(!defined('INDEX')) die('Direct access is prohibited!');

if(isset($pdoConnection) && $pdoConnection != null) {
	function get_students($params = array()) {
		global $pdoConnection;
				
		$order = (	array_key_exists('order', $params) && strlen(trim($params['order'])) > 0 &&
					preg_match('/^[\w\d\-\_\.]+$/', $params['order'])) ? 's.'.$params['order'] : 's.last_name' ;
		$dir = (	array_key_exists('order', $params) && strtoupper((strlen(trim($params['dir'])) > 0 &&
					preg_match('/^[Aa][Ss][Cc]|[Dd][Ee][Ss][Cc]$/', $params['dir']))) ? $params['dir'] : 'asc' );
					
		$where = 'WHERE';
		
		$where .= (	array_key_exists('name', $params) && (strlen(trim($params['name'])) > 0)) ? 
					((preg_match('/^[\d]+$/' ,trim($params['name'])) ? " (s.sid LIKE :name OR s.work_phone LIKE :name)"  :
					"((CONCAT(s.first_name, ' ', s.last_name) LIKE :name) OR (CONCAT(s.last_name, ' ', s.first_name) LIKE :name))" )) : ' 1' ;

		$scope = (	array_key_exists('scope', $params)) ? (($params['scope'] == 'new') ?
					' AND t.received = 0 AND t.date_entered >= DATE_SUB(NOW(), INTERVAL 30 DAY) GROUP BY s.sid' : (($params['scope'] == 'outstanding') ?
					' AND t.received = 0 GROUP BY s.sid' : (($params['scope'] == 'undecided') ?
					'undecided' : ''))) : FALSE ;
					
		$query = (!$scope) ? "SELECT DISTINCT * FROM students s $where ORDER BY $order $dir " : 
					(($scope == 'undecided') ? "SELECT DISTINCT * FROM students s $where AND s.sid NOT IN (SELECT student_id FROM student_evaluation) ORDER BY $order $dir"
					: "SELECT * FROM students s JOIN transfers t ON s.sid=t.sid $where$scope ORDER BY $order $dir");
										
		$students = $pdoConnection->prepare($query);
		
		if(strlen($where) > 0)
			$values['name'] = "%$params[name]%";
		else {
			$values = array();
		}
		
		$students->execute($values);
		
		return $students->fetchAll();
	}
} else {
	die('Please check your database configuration');
}
?>
