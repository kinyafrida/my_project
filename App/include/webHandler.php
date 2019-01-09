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
    public function getAllProperties() {
        $stmt = $this->pdo->prepare("SELECT p.*,pl.listing, pt.type, a_s.status, u.*  FROM properties p INNER JOIN property_listing pl ON p.property_listing = pl.id INNER JOIN users u ON p.manager = u.userId INNER JOIN property_type pt ON p.property_type = pt.id INNER JOIN approval_status a_s ON p.approval = a_s.id ORDER BY p.id DESC");
        $stmt->execute();
		$properties = $stmt->fetchAll();
		if(!$properties) exit('No rows');
		return $properties;
		$stmt = null;
    }
	
	/**
     * Fetching published properties
     */
    public function getPublishedProperties() {
        $stmt = $this->pdo->prepare("SELECT p.*,pl.listing, pt.type, a_s.status, u.*  FROM properties p INNER JOIN property_listing pl ON p.property_listing = pl.id INNER JOIN users u ON p.manager = u.userId INNER JOIN property_type pt ON p.property_type = pt.id INNER JOIN approval_status a_s ON p.approval = a_s.id WHERE p.approval = ? ORDER BY p.id DESC");
        $stmt->execute([1]);
		$properties = $stmt->fetchAll();
		if(!$properties) exit('No rows');
		return $properties;
		$stmt = null;
    }
	
	/**
     * Fetching unpublished properties
     */
    public function getUnpublishedProperties() {
        $stmt = $this->pdo->prepare("SELECT p.*,pl.listing, pt.type, a_s.status, u.*  FROM properties p INNER JOIN property_listing pl ON p.property_listing = pl.id INNER JOIN users u ON p.manager = u.userId INNER JOIN property_type pt ON p.property_type = pt.id INNER JOIN approval_status a_s ON p.approval = a_s.id WHERE p.approval = ? ORDER BY p.id DESC");
        $stmt->execute([2]);
		$properties = $stmt->fetchAll();
		if(!$properties) exit('No rows');
		return $properties;
		$stmt = null;
    }
	
	/**
     * Fetching deactivated properties
     */
    public function getDeactivatedProperties() {
        $stmt = $this->pdo->prepare("SELECT p.*,pl.listing, pt.type, a_s.status, u.*  FROM properties p INNER JOIN property_listing pl ON p.property_listing = pl.id INNER JOIN users u ON p.manager = u.userId INNER JOIN property_type pt ON p.property_type = pt.id INNER JOIN approval_status a_s ON p.approval = a_s.id WHERE p.approval = ? ORDER BY p.id DESC");
        $stmt->execute([3]);
		$properties = $stmt->fetchAll();
		if(!$properties) exit('No rows');
		return $properties;
		$stmt = null;
    }
	
	/**
     * Fetch a property 
     */

	public function getProperty($propertyId){
		$stmt = $this->pdo->prepare("SELECT p.*,pl.listing, pt.type, a_s.status, u.*  FROM properties p INNER JOIN property_listing pl ON p.property_listing = pl.id INNER JOIN users u ON p.manager = u.userId INNER JOIN property_type pt ON p.property_type = pt.id INNER JOIN approval_status a_s ON p.approval = a_s.id WHERE p.id = ? ");
        $stmt->execute([$propertyId]);
		$property = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!$property) exit('No rows');
		return $property;
		$stmt = null;		
	}
	
	/**
     * Fetching all uploads
     */
	public function getPropertyUploads($propertyId){
		$stmt = $this->pdo->prepare("SELECT * FROM property_uploads WHERE propertyId = ?");
        $stmt->execute([$propertyId]);
		$uploads = $stmt->fetchAll();
		return $uploads;
		$stmt = null;		
	}

	/**
     *property types
     */
	public function getPropertyTypes(){
		$stmt = $this->pdo->prepare("SELECT * FROM property_type");
        $stmt->execute();
		$uploads = $stmt->fetchAll();
		if(!$uploads) exit('No rows');
		return $uploads;
		$stmt = null;		
	}
	
	/**
     *property listing
     */
	public function getPropertyListing(){
		$stmt = $this->pdo->prepare("SELECT * FROM property_listing");
        $stmt->execute();
		$uploads = $stmt->fetchAll();
		if(!$uploads) exit('No rows');
		return $uploads;
		$stmt = null;		
	}
	
	/**
     *property status
     */
	public function getPropertyStatus(){
		$stmt = $this->pdo->prepare("SELECT * FROM approval_status WHERE id !=?");
        $stmt->execute([2]);
		$approval_status = $stmt->fetchAll();
		if(!$approval_status) exit('No rows');
		return $approval_status;
		$stmt = null;		
	}
	
	/**
     *property location
     */
	public function getPropertyLocation(){
		$stmt = $this->pdo->prepare("SELECT * FROM sub_counties ORDER BY general_location ASC");
        $stmt->execute();
		$uploads = $stmt->fetchAll();
		if(!$uploads) exit('No rows');
		return $uploads;
		$stmt = null;		
	}
	
	/**
     *property managers
     */
	public function getPropertyManager(){
		$stmt = $this->pdo->prepare("SELECT * FROM users ORDER BY name ASC");
        $stmt->execute();
		$uploads = $stmt->fetchAll();
		if(!$uploads) exit('No rows');
		return $uploads;
		$stmt = null;		
	}
	
	/**
     *get services
     */
	public function getServices(){
		$stmt = $this->pdo->prepare("SELECT * FROM services");
        $stmt->execute();
		$services = $stmt->fetchAll();
		if(!$services) exit('No rows');
		return $services;
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
	* Save property
	*/
	public function save_property($propertyType,$propertyListing,$location, $amount, $manager, $bedrooms,$showers,$carParks,$description,$propertyUrl) {
		$stmt = $this->pdo->prepare("INSERT INTO properties (property_type, property_listing, location,amount,bedrooms,showers,carParks, description,propertyUrl,manager) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?, ?)");
		$stmt->execute(array($propertyType,$propertyListing,$location, $amount,$bedrooms,$showers,$carParks,$description,$propertyUrl,$manager));		 
		$stmt = null;
		return $this->pdo->lastInsertId();
	}
	
	/**
	* Save edit property
	*/
	public function save_edit_property($propertyType,$propertyListing,$location, $amount, $manager, $bedrooms,$showers,$carParks,$description,$propertyUrl,$propertyId) {
		$stmt = $this->pdo->prepare("UPDATE properties SET property_type = ? , property_listing = ?, location = ?, amount = ?, bedrooms = ?, showers = ?,carParks = ?, description = ?, propertyUrl = ?, manager =? WHERE id = ? ");
		$stmt->execute(array($propertyType,$propertyListing,$location, $amount,$bedrooms,$showers,$carParks,$description,$propertyUrl,$manager,$propertyId));
		return $stmt -> rowCount();
		$stmt = null;		
	}
		
	/**
	* Save uploads
	*/
	public function save_uploads($propertyId,$uploadUrl) {
		$stmt = $this->pdo->prepare("INSERT INTO property_uploads (propertyId, imageUrl) VALUES (?, ?)");
		$stmt->execute(array($propertyId,$uploadUrl));
		return $this->pdo->lastInsertId();
		$stmt = null;
		
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

		return $this->pdo->lastInsertId();

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
		if(!$user) exit('No rows');
		return($user);
		$stmt = null;
	}
	
	
	/**
     *locality	 
     */

	public function getLocality(){
		$stmt = $this->pdo->prepare("SELECT DISTINCT location FROM properties ORDER BY location ");
        $stmt->execute();
		$locations = $stmt->fetchAll(PDO::FETCH_COLUMN);
		if(!$locations) exit('No rows');
		return $locations;
		$stmt = null;		
	}
	
	/**
	* Save technician
	*/
	public function save_technician($name,$phone,$location,$service, $photoUrl) {
		$stmt = $this->pdo->prepare("INSERT INTO service_providers (name, phone, photoUrl,locality,serviceId) VALUES (?, ?, ?, ?, ?)");
		$stmt->execute(array($name, $phone, $photoUrl,$location,$service));
		return($this->pdo->lastInsertId());
		$stmt = null;
	}
	
	/**
	* Save user
	*/
	public function save_user($name,$phone,$email,$photoUrl) {
		$user_type = 1;
		$stmt = $this->pdo->prepare("INSERT INTO users (name, phone_number,email_address, photo_url,user_type) VALUES (?, ?, ?, ?, ?)");
		$stmt->execute(array($name, $phone, $email, $photoUrl, $user_type));
		return($this->pdo->lastInsertId());
		$stmt = null;
	}
	
	/**
     *get all technicians
     */
	public function getServiceProviders(){
		$stmt = $this->pdo->prepare("SELECT * FROM service_providers ORDER BY name");
        $stmt->execute();
		$providers = $stmt->fetchAll();
		if(!$providers) exit('No rows');
		return $providers;
		$stmt = null;		
	}
	
	/**
     *get all Lesama Users
     */
	public function getLesamaUsers(){
		$stmt = $this->pdo->prepare("SELECT * FROM users WHERE user_type =? ORDER BY name");
        $stmt->execute([1]);
		$providers = $stmt->fetchAll();
		if(!$providers) exit('No rows');
		return $providers;
		$stmt = null;		
	}
	
	/**
     *get all Lesama Users
     */
	public function getContactPersons(){
		$stmt = $this->pdo->prepare("SELECT * FROM users WHERE user_type =? ORDER BY name");
        $stmt->execute([2]);
		$persons = $stmt->fetchAll();
		if(!$persons) exit('No rows');
		return $persons;
		$stmt = null;		
	}
	
	/**
     * specific service 
     */
	public function getService($serviceId){
		$stmt = $this->pdo->prepare("SELECT service FROM services WHERE id = ? ");
        $stmt->execute([$serviceId]);
		$service = $stmt->fetchColumn();
		if(!$service) exit('No rows');
		return $service;
		$stmt = null;		
	}
	
	/**
     * specific service provider 
     */
	public function getProvider($providerId){
		$stmt = $this->pdo->prepare("SELECT * FROM service_providers WHERE id = ? ");
        $stmt->execute([$providerId]);
		$provider = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!$provider) exit('No rows');
		return $provider;
		$stmt = null;		
	}
	
	
	/**
     * Delete service provider 
     */
	public function delete_technician($providerId){
		$stmt = $this->pdo->prepare("DELETE FROM service_providers WHERE id = ? ");
        $stmt->execute([$providerId]);
		return $stmt -> rowCount();
		$stmt = null;		
	}
	
	/**
     * Delete user
     */
	public function delete_user($userId){
		$stmt = $this->pdo->prepare("DELETE FROM users WHERE userId = ? ");
        $stmt->execute([$userId]);
		return $stmt -> rowCount();
		$stmt = null;		
	}
	
	/**
     * Delete upload
     */
	public function delete_upload($uploadId){
		$stmt = $this->pdo->prepare("DELETE FROM property_uploads WHERE id = ? ");
        $stmt->execute([$uploadId]);
		return $stmt -> rowCount();
		$stmt = null;		
	}
	
	/**
     * Edit service provider 
     */
	public function edit_technician($providerId,$name,$phone,$location,$service, $photoUrl){
		$stmt = $this->pdo->prepare("UPDATE service_providers SET name = ?, phone = ?, photoUrl = ?, locality = ?, serviceId = ? WHERE id = ? ");
        $stmt->execute([$name,$phone,$photoUrl,$location,$service,$providerId]);
		return $stmt -> rowCount();
		$stmt = null;		
	}
	
	/**
     * Edit User 
     */
	public function edit_user($userId,$name,$phone,$email, $photoUrl){
		$stmt = $this->pdo->prepare("UPDATE users SET name = ?, phone_number = ?, email_address = ?, photo_url = ? WHERE userId = ? ");
        $stmt->execute([$name,$phone,$email,$photoUrl,$userId]);
		return $stmt -> rowCount();
		$stmt = null;		
	}
	
	/**
     * Edit property upload
     */
	public function update_property_status($propertyId,$status){
		$stmt = $this->pdo->prepare("UPDATE properties SET approval = ? WHERE id = ? ");
        $stmt->execute([$status,$propertyId]);
		return $stmt -> rowCount();
		$stmt = null;		
	}
	
	/**
     * specific url 
     */
	public function getPropertyUrl($propertyId){
		$stmt = $this->pdo->prepare("SELECT propertyUrl FROM properties WHERE id = ? ");
        $stmt->execute([$propertyId]);
		$url = $stmt->fetchColumn();
		if(!$url) exit('No rows');
		return $url;
		$stmt = null;		
	}
	
	/**
     * specific upload url
     */
	public function getUploadUrl($uploadId){
		$stmt = $this->pdo->prepare("SELECT imageUrl FROM property_uploads WHERE id = ? ");
        $stmt->execute([$uploadId]);
		$url = $stmt->fetchColumn();
		return $url;
		$stmt = null;		
	}
}


?>