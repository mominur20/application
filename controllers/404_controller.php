<?php
if(!defined('INDEX')) die('Direct access is prohibited!');

$page_title = "404 Page Not Found";

// Include header file
include $view_path.'template/header.php';

// Include appropriate view
include $view_path.'pages/404.php';

// Include footer file
include $view_path.'template/footer.php';
?>