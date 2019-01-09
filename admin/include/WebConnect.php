<?php
 
/**
 * Class to handle all db operations
 * This class will have CRUD methods for database tables
 *
 * @author Ravi Tamada
 */
class WebConnect {
 
    private $conn;
 
    function __construct() {
        
    }
 
   function callAPI($method, $url, $data){
	   $curl = curl_init(); 
	   switch ($method){ 
		   case "POST": curl_setopt($curl, CURLOPT_POST, 1);
			   if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			   break; 
		   case "PUT": curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
			   if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			   break; 
		   default: 
			   if ($data) $url = sprintf("%s?%s", $url, http_build_query($data));
	   }
	   // OPTIONS:
	   curl_setopt($curl, CURLOPT_URL, $url); 
	   curl_setopt($curl, CURLOPT_HTTPHEADER, 
				   array( 'authorization: 8d788d13e476ee74072abacce181d7bc', 
						 'Content-Type: application/json', ));
	   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
	   // EXECUTE: 
	   $result = curl_exec($curl); 
	   if(!$result){die("Connection Failure");} 
	   curl_close($curl);
	   return $result;
   }
   
   /**

     * Validate inputs

     */

	public function test_input($data) {

		  $data = trim($data);

		  $data = stripslashes($data);

		  $data = htmlspecialchars($data);

		  return $data;

	} 
}
 
?>
