<?php
if(isset($_GET['nationalNumber'])){
	$crNo= $_GET['nationalNumber'];
	$URL="http://192.168.31.52:13080/SM/9/rest/tabadulfusers?query=CRNO=$crNo&view=expand";
}
//$pNo= $_GET['phoneNumber'];

$array = array();
callCURL($URL);

function callCURL($URL){
	//$URL="http://192.168.31.52:13080/SM/9/rest/tabadulfusers?query=CRNO=$var&view=expand";
	
	$username='fasahws';
	$password='123';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$URL);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	$headers = array(
		'Content-Type: application/json',
		'Authorization: Basic '. base64_encode("$username:$password")
	);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result=curl_exec ($ch);
	curl_close ($ch);
	$result = str_replace("\"@","\"",$result);
	//print_r($result);
	//$json = json_decode($result);
	print_r($result);
}
?>