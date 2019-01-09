<?php
// Include the database configuration file
    require_once dirname(__FILE__) . '/../include/webHandler.php';
	$db = new DbHandler();

$propertyType ="";

if(isset($_POST['submit'])){   
	
	// save the details
	$propertyType =$db -> test_input($_POST["propertyType"]) ;
	$propertyListing =$db -> test_input($_POST["propertyListing"]) ;
	$location =$db -> test_input($_POST["location"]) ;	
	$amount =$db -> test_input($_POST["amount"]) ;
	$manager =$db -> test_input($_POST["manager"]) ;
	$bedrooms =$db -> test_input($_POST["bedrooms"]) ;
	$showers =$db -> test_input($_POST["showers"]) ;
	$carParks =$db -> test_input($_POST["carParks"]) ;
	$description =$db -> test_input($_POST["description"]) ;

     
    // File upload configuration
    $targetDir = "uploads/";
    $allowTypes = array('jpg','png','jpeg','gif');
    
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
	
	$propertyUrl = "";
	if ( !empty( $_FILES[ 'propertyPhoto' ][ 'name' ] ) ) {
	$tmpFilePath = $_FILES[ 'propertyPhoto' ][ 'tmp_name' ];
	$_FILES[ 'propertyPhoto' ][ 'name' ] = htmlspecialchars( $_FILES[ 'propertyPhoto' ][ 'name' ] );
	$_FILES[ 'propertyPhoto' ][ 'name' ] =$db -> test_input($_FILES[ 'propertyPhoto' ][ 'name' ] );
	$targetFilePath = "../".$targetDir. $_FILES[ 'propertyPhoto' ][ 'name' ];
		$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
		if(in_array($fileType, $allowTypes)){
			if(move_uploaded_file($tmpFilePath, $targetFilePath)){
                    // Image db insert sql
                    $propertyUrl = $targetDir. $db -> test_input($_FILES[ 'propertyPhoto' ][ 'name' ]);
                }else{
                    $errorUpload .= $_FILES['propertyPhoto']['name'].', ';
                }
		}		
}
	$query = $db ->save_property($propertyType,$propertyListing,$location, $amount, $manager, $bedrooms,$showers,$carParks,$description,$propertyUrl);
	
	$propertyId = $query;
	
	$uploadUrl = "";
	$uploaded = "";
    if(!empty($_FILES['facilities']['name'])){
        foreach($_FILES['facilities']['name'] as $key=>$val){			
            // File upload path
			$myDate = date('Y-m-d H:i:s');
            $fileName = basename($_FILES['facilities']['name'][$key]);
            $targetFilePath ="../".$targetDir . $myDate. $fileName;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["facilities"]["tmp_name"][$key], $targetFilePath)){
					$uploadUrl = $targetDir . $myDate. $_FILES['facilities']['name'][$key];	
                    // Image db insert sql
					$uploaded = $db ->save_uploads($propertyId,$uploadUrl);
                }else{
					echo("Error in uploading".$_FILES['facilities']['name'][$key]);
                }
            }else{
                $errorUploadType .= $_FILES['facilities']['name'][$key].', ';
            }
        }        
      
    }	
	else{
       $statusMsg = 'Please select indoor facilities.';
    }
	
	if($uploaded > 0){
	  echo ('<script language="javascript">;');
		echo ('alert("Message: Property added");');
		echo ('window.location.href = "index.php";');
		echo ('</script>');
  }
    
}
?>