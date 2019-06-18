<?php
if(!defined('INDEX')) die('Direct access is prohibited!');

if(isset($pdoConnection) && $pdoConnection != null) {
	function auth_user($username, $password) {
		global $pdoConnection;
		
		$user = $pdoConnection->prepare("SELECT * FROM users WHERE username = :username AND authentication = SHA1(CONCAT(IFNULL(alternate_id,''),username,:password))");
		$user->bindParam(':username', $username);
		$user->bindParam(':password', $password);
		
		if($user->execute()) {
			return $user->fetch(PDO::FETCH_ASSOC);
		} else {
			return FALSE ;
		}
	}
} else {
	die('Please check your database configuration');
}