<?php
if(!defined('INDEX')) die('Direct access is prohibited!');

function phone_format($phone, $dividers = '(,),-') {
	
	$dividers = explode(',', $dividers);
	
	if(preg_match('/^([\d]{3})([\d]{3})([\d]{4})$/', $phone, $segmented_phone)) {
		return $dividers[0].$segmented_phone[1].$dividers[1].$segmented_phone[2].$dividers[2].$segmented_phone[3];
	} else {
		return FALSE ;
	}
}

function sid_format($sid, $divider = '-') {
	
	if(preg_match('/^([\d]{3})([\d]{2})([\d]{4})$/', $sid, $segmented_sid)) {
		return $segmented_sid[1].$divider.$segmented_sid[2].$divider.$segmented_sid[3];
	} else {
		return FALSE ;
	}	
}

?>