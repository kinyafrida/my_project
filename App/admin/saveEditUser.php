<?php
// Include the database configuration file
    require_once dirname(__FILE__) . '/../include/webHandler.php';
	$db = new DbHandler();

$query ="";

if(isset($_POST['submit'])){   
	
	// save the details
	$userId =$db -> test_input($_POST["userId"]) ;
	$name =$db -> test_input($_POST["name"]) ;
	$phone =$db -> test_input($_POST["phone"]) ;
	$email =$db -> test_input($_POST["email"]) ;
     
	
    // File upload configuration
    $targetDir = "users/";
    $allowTypes = array('jpg','png','jpeg','gif');
    
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
	
	$photoUrl = "";
	if ( !empty( $_FILES[ 'photo' ][ 'name' ] ) ) {
		// Delete the original photo
		
		/////////
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
	
	$query = $db ->edit_user($userId,$name,$phone,$email, $photoUrl);
	
	
	if($query > 0){
		echo ('<script language="javascript">;');
		echo ('alert("Message: User Edited");');
		echo ('window.location.href = "users.php";');
		echo ('</script>');
	  
 }
    
}

?>