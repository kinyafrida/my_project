<?php
// Include the database configuration file
    require_once dirname(__FILE__) . '/../include/webHandler.php';
	$db = new DbHandler();

$propertyType ="";
$propertyId = $_POST['propertyId'];
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
		
		////// Delete the original photo //////////
		$url = $db -> getPropertyUrl($propertyId);
		if(file_exists("../".$url)){
		unlink("../".$url);
	   }		
		////////////////////////////
		
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
$query = $db ->save_edit_property($propertyType,$propertyListing,$location,$specificLocation, $amount, $manager, $bedrooms,$showers,$carParks,$description,$propertyUrl,$propertyId);

	if($query > 0){
	  echo ('<script language="javascript">;');
		echo ('alert("Message: Updated. Proceed to edit images");');
		echo ('window.location.href = "editImages.php?propertyId='.$propertyId.'";');
		echo ('</script>');
  }
    
} elseif(isset($_POST['proceed'])){
	echo ('<script language="javascript">;');
	echo ('window.location.href = "editImages.php?propertyId='.$propertyId.'";');
	echo ('</script>');
}
?>