<?php
require_once dirname(__FILE__) . '/include/DbHandler.php';

$db = new DbHandler();

$listing = $_REQUEST['listing'];

// array for JSON response

$response = array();

// fetch all the properties

$properties = $db -> getAllProperties($listing);

if(count($properties) > 0){
	$response["properties"] = array();
	$propertyId ="";
	
foreach($properties as $property){
	$detail = array();
	$property_uploads = array();
	
	$propertyId = $property["id"];	
	$uploads = $db -> getPropertyUploads($propertyId);
	
	foreach($uploads as $up){
		array_push($property_uploads, $up["imageUrl"]);
	}
	
	$detail["id"] = $propertyId;
	$detail["property_type"] = $property["type"];
	$detail["property_type_id"] = $property["property_type"];
	$detail["property_listing"] = $property["property_listing"];
	$detail["location"] = $property["location"];
	$detail["amount"] = $property["amount"];
	$detail["bedrooms"] = $property["bedrooms"];
	$detail["showers"] = $property["showers"];
	$detail["carParks"] = $property["carParks"];
	$detail["description"] = $property["description"];
	$detail["status"] = $property["status"];
	$detail["propertyUrl"] = $property["propertyUrl"];
	$detail["manager"] = $property["name"];
	$detail["manager_phone"] = $property["phone_number"];
	$detail["manager_email"] = $property["email_address"];
	$detail["manager_photo"] = $property["photo_url"];
	$detail["uploads"] = $property_uploads;
	
	array_push($response["properties"], $detail);
	
}
	
$propertyTypes = $db -> getPropertyTypes();
	if(count($propertyTypes)){
		$response["types"] = array();
		$typ = array();
		foreach($propertyTypes as $propertyType){
			
		$typ["typeId"] = $propertyType["id"];
		$typ["type"] = $propertyType["type"];
		
		array_push($response["types"], $typ);
	}
	}else{
		$response["success"] = 2;
		$response["message"] = "Types not fetched";
	}
	
	
	$response["success"] = 1;	
	echo json_encode($response);
	
}else{
	
	$response["success"] = 0;
	$response["message"] = "No property fetched";
	
	echo json_encode($response);
}

?>