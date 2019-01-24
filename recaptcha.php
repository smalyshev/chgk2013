<?php
function check_captcha( $resposnse ) {
	$privatekey = '6LemAYwUAAAAACXjGuIaqWTuq7QYlmeUhLlDn_xN';

	$verifyResponse = file_get_contents( 'https://www.google.com/recaptcha/api/siteverify?secret=' . $privatekey . '&response=' . $resposnse );
	$responseData = @json_decode( $verifyResponse );
	return (bool)$responseData->success;
}