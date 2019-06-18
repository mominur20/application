<?php
if(!defined('INDEX')) die('Direct access is prohibited!');

// Include database connection
include $includes_path.'db_connection.php';

// Include appropriate model for page
include $model_path.'entryForm'.$model_extension;

// List of US state and territories
$states_array = array(	'states' 		=> array(	'AL' => 'Alabama',
													'AK' => 'Alaska',
													'AZ' => 'Arizona',
													'AR' => 'Arkansas',
													'CA' => 'California',
													'CO' => 'Colorado',
													'CT' => 'Connecticut',
													'DE' => 'Delaware',
													'DC' => 'District Of Columbia',
													'FL' => 'Florida',
													'GA' => 'Georgia',
													'HI' => 'Hawaii',
													'ID' => 'Idaho',
													'IL' => 'Illinois',
													'IN' => 'Indiana',
													'IA' => 'Iowa',
													'KS' => 'Kansas',
													'KY' => 'Kentucky',
													'LA' => 'Louisiana',
													'ME' => 'Maine',
													'MD' => 'Maryland',
													'MA' => 'Massachusetts',
													'MI' => 'Michigan',
													'MN' => 'Minnesota',
													'MS' => 'Mississippi',
													'MO' => 'Missouri',
													'MT' => 'Montana',
													'NE' => 'Nebraska',
													'NV' => 'Nevada',
													'NH' => 'New Hampshire',
													'NJ' => 'New Jersey',
													'NM' => 'New Mexico',
													'NY' => 'New York',
													'NC' => 'North Carolina',
													'ND' => 'North Dakota',
													'OH' => 'Ohio',
													'OK' => 'Oklahoma',
													'OR' => 'Oregon',
													'PA' => 'Pennsylvania',
													'RI' => 'Rhode Island',
													'SC' => 'South Carolina',
													'SD' => 'South Dakota',
													'TN' => 'Tennessee',
													'TX' => 'Texas',
													'UT' => 'Utah',
													'VT' => 'Vermont',
													'VA' => 'Virginia',
													'WA' => 'Washington',
													'WV' => 'West Virginia',
													'WI' => 'Wisconsin',
													'WY' => 'Wyoming'),
						'territories' 	=> array(	'AS' => 'American Samoa',
													'GU' => 'Guam',
													'MP' => 'Northern Mariana Islands',
													'PR' => 'Puerto Rico',
													'UM' => 'United States Minor Outlying Islands',
													'VI' => 'Virgin Islands'),
						'armed_forces' 	=> array(	'AA' => 'Armed Forces Americas',
													'AP' => 'Armed Forces Pacific',
													'AE' => 'Armed Forces Others'));
													
$form_processed = FALSE ;
$form_valid = FALSE ;

if(array_key_exists('submit', $_POST)) {
	$form_processed = TRUE ;
	
	// Validate form
	// Validate name
	$first_name = (isset($_POST['first_name']) && strlen(trim($_POST['first_name'])) > 1) ? ucwords(strtolower($_POST['first_name'])) : FALSE ;
	$last_name = (isset($_POST['last_name']) && strlen(trim($_POST['last_name'])) > 1) ? ucwords(strtolower($_POST['last_name'])) : FALSE ;
	
	// Validate SID
	$sid = FALSE ; // Defaults to false
	
	if (isset($_POST['sid'])) {
		// Trim all but numbers
		preg_match_all('!\d+!', $_POST['sid'], $matches);
		$sid_stripped = trim(implode('', $matches[0]));
		
		if (strlen($sid_stripped) == 9) {
			$sid = $sid_stripped;
		}
	}

	// Validate Phone number
	$phone = FALSE ; // Defaults to false
	
	if (isset($_POST['phone'])) {
		// Trim all but numbers
		preg_match_all('!\d+!', $_POST['phone'], $matches);
		$phone_stripped = trim(implode('', $matches[0]));
		
		if (strlen($phone_stripped) == 10) {
			$phone = $phone_stripped;
		}
	}
	
	// Validate gender
	$gender = (isset($_POST['gender'])) ? $_POST['gender'] : FALSE ;
	
	// Validate street address
	$address = (isset($_POST['address']) && count(explode(' ', $_POST['address'])) > 1) ? $_POST['address'] : FALSE ;
	
	// Validate city
	$city = (isset($_POST['city']) && strlen(trim($_POST['city'])) > 1) ? ucwords(strtolower($_POST['city'])) : FALSE ;
	
	// Validate state
	$state = FALSE ;
	
	foreach ($states_array as $states) {
		if (array_key_exists($_POST['state'], $states)) {
			$state = $_POST['state'];
			break;
		}
	}
	
	// Validate Zip
	$zip = FALSE ; // Defaults to null
	
	if (isset($_POST['zip'])) {
		// Trim all but numbers
		preg_match_all('!\d+!', $_POST['zip'], $matches);
		$zip_stripped = trim(implode('', $matches[0]));
		
		if (strlen($zip_stripped) == 5 || strlen($zip_stripped) == 9) {
			$zip = $zip_stripped;
		}
	}
	
	// Check if everything is valid and lets go!
	if(	$first_name &&
		$last_name &&
		$sid &&
		$phone &&
		$gender &&
		$address &&
		$city &&
		$state &&
		$zip) {
		// We're all set, lets go!
		
		$student_info['first_name'] = $first_name;
		$student_info['last_name'] = $last_name;
		$student_info['sid'] = $sid;
		$student_info['phone'] = $phone;
		$student_info['gender'] = $gender;
		$student_info['address'] = $address;
		$student_info['city'] = $city;
		$student_info['state'] = $state;
		$student_info['zip'] = $zip;
		
		if(add_student($student_info)) {
			$form_valid = TRUE ;
		}
	}
}

//** Display the page **//

$page_title = 'Student Entry Form : Binary';

// Include header file
include $view_path.'template/header.php';

// Include appropriate view
include $view_path.'pages/entryForm.php';

// Include footer file
include $view_path.'template/footer.php';
?>