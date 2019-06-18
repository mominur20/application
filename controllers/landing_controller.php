<?php
if(!defined('INDEX')) die('Direct access is prohibited!');

//** Display the page **//

$page_title = 'Landing : Binary' ;

// Include header file
include $view_path.'template/header.php';

// Include appropriate view for page
include $view_path.'pages/landing.php';

// Include footer file
include $view_path.'template/footer.php';
?>