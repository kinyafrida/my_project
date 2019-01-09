<?php
// Include the database configuration file
    require_once dirname(__FILE__) . '/../include/webHandler.php';
	$db = new DbHandler();

$query ="";

if(isset($_POST['submit'])){   
	
	// save the details
	$name =$db -> test_input($_POST["name"]) ;
	$phone =$db -> test_input($_POST["phone"]) ;
	$service =$db -> test_input($_POST["service"]) ;
	$location =$db -> test_input($_POST["location"]) ;
     
	
    // File upload configuration
    $targetDir = "users/";
    $allowTypes = array('jpg','png','jpeg','gif');
    
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
	
	$photoUrl = "";
	if ( !empty( $_FILES[ 'photo' ][ 'name' ] ) ) {
	$tmpFilePath = $_FILES[ 'photo' ][ 'tmp_name' ];
	$_FILES[ 'photo' ][ 'name' ] = htmlspecialchars( $_FILES[ 'photo' ][ 'name' ] );
	$_FILES[ 'photo' ][ 'name' ] =$db -> test_input($_FILES[ 'photo' ][ 'name' ] );
	$targetFilePath = "../".$targetDir. $_FILES[ 'photo' ][ 'name' ];
		$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
		if(in_array($fileType, $allowTypes)){
			if(move_uploaded_file($tmpFilePath, $targetFilePath)){
                    // Image db insert sql
                    $photoUrl = $targetDir. $db -> test_input($_FILES[ 'photo' ][ 'name' ]);
                }else{
                    $errorUpload .= $_FILES['photo']['name'].', ';
                }
		}		
}
	
	$query = $db ->save_technician($name,$phone,$location,$service, $photoUrl);
	
	
	if($query > 0){
		echo ('<script language="javascript">;');
		echo ('alert("Message: Provider added");');
		echo ('window.location.href = "technicians.php";');
		echo ('</script>');
	  
 }
    
}

?>