<?php

class DbHandler {	

	

    private $pdo;

 

    function __construct() {

		include("pdo_connect.php");

		$db = new DbConnect();

        $this->pdo = $db->connect();

    }

	

	/**

     * Fetching all properties

     */

    public function getAllProperties($listing) {
        $stmt = $this->pdo->prepare("SELECT p.*, pt.type, u.* FROM properties p INNER JOIN users u ON p.manager = u.userId INNER JOIN property_type pt ON p.property_type = pt.id  WHERE p.property_listing = ?  ORDER BY p.id DESC");

        $stmt->execute([$listing]);
		$properties = $stmt->fetchAll();
		if(!$properties) exit('No rows');
		return $properties;
		$stmt = null;
    }
	
	/**
     * Fetching all uploads
     */
	public function getPropertyUploads($propertyId){
		$stmt = $this->pdo->prepare("SELECT * FROM property_uploads WHERE propertyId = ?");
        $stmt->execute([$propertyId]);
		$uploads = $stmt->fetchAll();
		if(!$uploads) exit('No rows');
		return $uploads;
		$stmt = null;		
	}
	
	/**
     * Fetching service providers
     */
	public function getAllProviders($serviceId){
		$stmt = $this->pdo->prepare("SELECT * FROM service_providers WHERE serviceId = ?");
        $stmt->execute([$serviceId]);
		$providers = $stmt->fetchAll();
		if(!$providers) exit('No rows');
		return $providers;
		$stmt = null;		
	}
	
	/**
     *property types
     */
	public function getPropertyTypes(){
		$stmt = $this->pdo->prepare("SELECT * FROM property_type ORDER BY type ASC");
        $stmt->execute();
		$types = $stmt->fetchAll();
		if(!$types) exit('No rows');
		return $types;
		$stmt = null;		
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

	

	/**

     * Validate phone

     */

	public function validate_phone($phone) {

		if(strlen($phone) == 9){

			$phone = "+254".$phone;

		  }

		if(strlen($phone) == 10){

			$phone = ltrim($phone, "0");

			$phone = "+254".$phone;

		}

		return $phone;		  

	}

	

	/**

	* Save registration

	*/

	public function save_registration($name, $phone, $password) {

		$stmt = $this->pdo->prepare("INSERT INTO users (name, phone_number, password) VALUES (?, ?, ?)");

		$stmt->execute(array($name, $phone, $password));		 

		$stmt = null;

		return $this->$pdo->lastInsertId();

	}

	

	/**

	* Login check

	*/

	public function check_login($phone, $password) {

		session_start();

		$stmt = $this->pdo->prepare("SELECT * FROM users WHERE phone_number = ?");

		$stmt->execute([$phone]);

		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		$stmt = null;

		

		if(!$result){

			$_SESSION["fail"] = 1;

		} 

		else {

		  	$stmt1 = $this->pdo->prepare("SELECT * FROM users WHERE phone_number = ? AND password = ?");

			$stmt1->execute(array($phone, $password));

			$result1 = $stmt1->fetch(PDO::FETCH_ASSOC);

			if(!$result1){

				$_SESSION["fail"] = 2;

			} else{

				unset($_SESSION["fail"]);

				$userId = $result1['userId'];

				$_SESSION["userId"] = $userId;			

			}

			$stmt1 = null;

		}		

	}

	

	/**

	* Fetch a user

	*/

	public function getUser($userId){

		$stmt = $this->pdo->prepare("SELECT * FROM users WHERE userId = ?");

		$stmt->execute([$userId]);

		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		return($user);

		$stmt = null;

	}

}

?>