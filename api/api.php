<?php

$crNo= $_GET['nationalNumber'];
$pNo= $_GET['phoneNumber'];
$URL="http://192.168.31.52:13080/SM/9/rest/tabadulfusers?query=CRNO=$crNo&view=expand";
$array = array();
$array = callCURL($URL);

if($array->count > 0){
	//echo "aaaaa".$array->count;
}else{
	$URL="http://192.168.31.52:13080/SM/9/rest/tabadulfusers?query=HPHONE=$pNo&view=expand";
	$array = callCURL($URL);
	//echo "bbbbb".$array->count;
}
if($array->count > 0){
	echo "customer found";
	//getTicketInfo();
}else{
	echo "customer not found";
}
function getTicketInfo(){
	$URL="http://192.168.22.109:13080/SM/9/rest/interactions/SD11645/";
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
	$json = json_decode($result);
	$arr = $json->Interaction->Description;
	for($i=0;$i< sizeof($arr);$i++){
//echo $arr[$i];
		//if()
	}
	
}
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
	$json = json_decode($result);
	return $json;
}
?>