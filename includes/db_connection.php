<?php
if(!defined('INDEX')) die('Direct access is prohibited!');

// Constants
	define('DSN', 'mysql:host=localhost;dbname= ');
	define('USERNAME', '');
	define('PASSWORD', ' ');	

try {
	// Try connection to database
	$pdoConnection = new PDO(DSN, USERNAME, PASSWORD);
} catch(PDOException $ex) {
	// Terminate script
	die('<b>Error connecting to database:</b> '.$ex->getMessage());
}

?>