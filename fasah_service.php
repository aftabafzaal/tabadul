<?php

	$category = $_GET['category'];
	if($category == 'Importer'){
		$category =  "Importer's";
	}
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
	$fasah_service =array();
	for($count=0;$count<sizeof($json->content);$count++){
		
		//array_push($fasah_sub_cat,$json->content[$count]->tabadulfasahcat->CustomerType);
		if($json->content[$count]->tabadulfasahcat->CustomerType == $category){
			
			if (in_array($json->content[$count]->tabadulfasahcat->service, $fasah_service)) {
			
				}else{
					array_push($fasah_service,$json->content[$count]->tabadulfasahcat->service);
			}
		
		}
		
	} 
	print_r(json_encode($fasah_service));
?>