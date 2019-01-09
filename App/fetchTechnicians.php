<?php
require_once dirname(__FILE__) . '/include/DbHandler.php';

$db = new DbHandler();

$serviceId = $_REQUEST['serviceId'];

// array for JSON response
$response = array();
$providers = $db -> getAllProviders($serviceId);
if(count($providers) > 0){
	$response["technicians"] = array();
	
	$detail = array();
	foreach($providers as $provider){
	$detail["id"] = $provider["id"];
	$detail["name"] = $provider["name"];
	$detail["phone"] = $provider["phone"];
	$detail["rating"] = $provider["rating"];
	$detail["photo"] = $provider["photoUrl"];
	$detail["locality"] = $provider["locality"];
		
	array_push($response["technicians"], $detail);	
	}
	$response["success"] = 1;	
	echo json_encode($response);
	
	}else{	
	$response["success"] = 0;
	$response["message"] = "No detail fetched";	
	echo json_encode($response);
}
?>