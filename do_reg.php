<?php
require_once('recaptcha/recaptchalib.php');
$privatekey = '6LchHt4SAAAAAAuulHlyXGpPn7QzbqgDqVbWCl6Y';
$regtypes = array("chgk", "si", "legion");
$els = array( 
		"chgk" => array('komanda', 'gorod', 'kapitan', 'email', 'igroki', 'recaptcha_challenge_field', 'recaptcha_response_field'),
		"si" => array('komanda', 'igrok', 'recaptcha_challenge_field', 'recaptcha_response_field'),
);
$fields = array(
		"chgk" => array('komanda', 'nomer', 'gorod', 'kapitan', 'email', 'igroki'),
		"si" => array('komanda', 'igrok'),
);

if(empty($_POST['regtype']) || !in_array($_POST['regtype'], $regtypes)) {
	$_GET['page'] = 'badreg_empty';
	include 'index.php';
	return;
}

foreach($els[$_POST['regtype']] as $el) {
	if(empty($_POST[$el])) {
		$_GET['page'] = 'badreg_empty';
		include 'index.php';
		return;
	}
}

if(!empty($_POST["recaptcha_response_field"])) {
	$resp = recaptcha_check_answer ($privatekey,
			$_SERVER["REMOTE_ADDR"],
			$_POST["recaptcha_challenge_field"],
			$_POST["recaptcha_response_field"]);
	
	if (!$resp->is_valid) {
		// What happens when the CAPTCHA was entered incorrectly
			$_GET['page'] = 'badreg_robot';
			include 'index.php';
			return;
	}
}

$data = array();
foreach($fields[$_POST['regtype']] as $field) {
	$data[$field] = $_POST[$field];
}
$f = fopen("rgdata/{$_POST['regtype']}", "a+");
fwrite($f, sprintf("===== %s =====\n%s\n=====\n", date("c"), json_encode($data, JSON_UNESCAPED_UNICODE)));
fclose($f);

$_GET['page'] = 'goodreg';
include 'index.php';
return;
