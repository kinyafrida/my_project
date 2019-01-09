<?php
// Include the database configuration file
    require_once dirname(__FILE__) . '/../include/webHandler.php';
	$db = new DbHandler();

	$userId = $_REQUEST['userId'];

	$getUser = $db -> getUser($userId);

    $query = $db ->delete_user($userId);

	$photoUrl ="../".$getUser['photo_url'];
	
	if($query > 0){
		
		if(file_exists($photoUrl)){
		unlink($photoUrl);
	   }
		echo ('<script language="javascript">;');
		echo ('alert("Message: User Deleted");');
		echo ('window.location.href = "users.php";');
		echo ('</script>');  
 }

?>