<?php
// Include the database configuration file
    require_once dirname(__FILE__) . '/../include/webHandler.php';
	$db = new DbHandler();

	$providerId = $_REQUEST['providerId'];

	$getProvider = $db -> getProvider($providerId);

    $query = $db ->delete_technician($providerId);

	$photoUrl ="../".$getProvider['photoUrl'];
	
	if($query > 0){
		
		if(file_exists($photoUrl)){
		unlink($photoUrl);
	   }
		echo ('<script language="javascript">;');
		echo ('alert("Message: Provider Deleted");');
		echo ('window.location.href = "viewTechnicians.php";');
		echo ('</script>');  
 }

?>