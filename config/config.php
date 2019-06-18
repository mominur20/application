<?php
if(!defined('INDEX')) die('Direct access is prohibited!');

// Default pages based on roles
$default_student_controller = 'transfer';
$default_staff_controller = 'students';
$default_admin_controller = 'students';

// Access rights
$student_access = array('student', 'admin');
$staff_access = array('staff', 'admin');
$admin_access = array('admin');
