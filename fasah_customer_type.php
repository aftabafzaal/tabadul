<?php
$URL="http://192.168.31.52:13080/SM/9/rest/tabadulfasahcat?view=expand";
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
	$count=0;
	$fasahcat =array();
	for($count=0;$count<sizeof($json->content);$count++){
		
		if (in_array($json->content[$count]->tabadulfasahcat->CustomerType, $fasahcat)) {
			
		}else{
			array_push($fasahcat,$json->content[$count]->tabadulfasahcat->CustomerType);
		}
		
	}
	
	print_r(json_encode($fasahcat));
?>