<?php
require_once('Zend/Json.php');
include 'recaptcha.php';
$regtypes = array("chgk", "si", "legion");
$els = array(
		"chgk" => array('komanda', 'gorod', 'kapitan', 'email', 'igroki', 'zachet', 'g-recaptcha-response'),
		"si" => array('komanda', 'igrok', 'g-recaptcha-response'),
		"legion" => array("igrok", "email", 'g-recaptcha-response'),
);
$fields = array(
		"chgk" => array('komanda', 'nomer', 'gorod', 'kapitan', 'email', 'igroki', 'zachet'),
		"si" => array('komanda', 'igrok'),
		"legion" => array("igrok", "email"),
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

if(!empty($_POST["g-recaptcha-response"])) {
	if (!check_captcha($_POST["g-recaptcha-response"])) {
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
fwrite($f, sprintf("===== %s =====\n%s\n=====\n", date("c"), Zend_Json::prettyPrint(Zend_Json::encode($data))));
fclose($f);

$_GET['page'] = 'goodreg';
include 'index.php';
return;
