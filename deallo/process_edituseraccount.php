<?php
$first_name = $last_name =  $phone_number = $address = $country = $state = $city = $postcode = "";
$first_nameErr = $last_nameErr = $phone_numberErr = $addressErr = $countryErr = $stateErr = $cityErr = $postcodeErr = "";
$errorpresence = false;
$error_message = "";

require_once("dbcontroller.php");
$db_handle = new DBController();
 //temporary email later get from session 
        //$temporaryusername = "woohoo";
        
if(!empty($_POST["edituserInfo"])) {
     /* First Name Validation */
    if(empty($_POST["firstName"])){
        $first_nameErr = "Please enter your first name";
        $errorpresence = true;
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/",$_POST["firstName"])) {
            $first_nameErr = "Invalid First Name input";
            $errorpresence = true;
        }else{
            $first_name = sanitizeInput($_POST["firstName"]);
          
        }
    }
    
    /* Last Name Validation */
    if(empty($_POST["lastName"])){
        $last_nameErr = "Please enter your last name";
        $errorpresence = true;
    }else {
        if (!preg_match("/^[a-zA-Z ]*$/",$_POST["lastName"])) {
            $last_nameErr = "Invalid Last Name input";
            $errorpresence = true;
        }else{
            $last_name = sanitizeInput($_POST["lastName"]);
        }
    }
    
    
   /* Phone number Validation */
    if(!empty($_POST["phoneNum"])){
        if (!preg_match("/^[0-9]{10,12}$/",$_POST["phoneNum"])) {
            $phone_numberErr = "Invalid phone number";
            $errorpresence = true;
        }else{
            $phone_number = sanitizeInput($_POST["phoneNum"]);
        }
    } else {
		$phone_number = $selectResult[0]["phone_number"];
	}

    /* Address Validation */
    if(!empty($_POST["userAddress"])){
        if (!preg_match("/[\w',-\\/.\s]/",$_POST["userAddress"])) {
            $addressErr = "Invalid address format";
            $errorpresence = true;
        }else{
            $address = sanitizeInput($_POST["userAddress"]);
        }
    }
	
    
    /* Country Validation */
    if(!empty($_POST["userCountry"])){
        if (!preg_match("/^[a-zA-Z ]*$/",$_POST["userCountry"])) {
            $countryErr = "Invalid country name";
            $errorpresence = true;
        }else{
            $country = sanitizeInput($_POST["userCountry"]);
        }
    }
    
    /* State Validation */
    if(!empty($_POST["userState"])){
        if (!preg_match("/^[a-zA-Z ]*$/",$_POST["userState"])) {
            $countryErr = "Invalid state name";
            $errorpresence = true;
        }else{
            $state = sanitizeInput($_POST["userState"]);
        }
    }    
    
    /* City Validation */
    if(!empty($_POST["userCity"])){
        if (!preg_match("/^[a-zA-Z ]*$/",$_POST["userCity"])) {
            $cityErr = "Invalid city name";
            $errorpresence = true;
        }else{
            $city = sanitizeInput($_POST["userCity"]);
        }
    } 
    
    /* Postcode Validation - all inputs are accepted for postcode except special characters */
    $postcode = sanitizeInput($_POST["userPostcode"]);
	
	if($error_message == "" && $errorpresence == false) {
		
        $query = $db_handle->getConn()->prepare("UPDATE user_account SET first_name = :first_name, last_name = :last_name, phone_number = :phone_number, address = :address, country = :country, state = :state, city = :city, postcode = :postcode WHERE username = :username");
            
		$query->bindParam(":first_name", $first_name);
		$query->bindParam(":last_name", $last_name);
		$query->bindParam(":phone_number", $phone_number);
		$query->bindParam(":address", $address);
		$query->bindParam(":country", $country);
		$query->bindParam(":state", $state);
		$query->bindParam(":city", $city);
		$query->bindParam(":postcode", $postcode);
		$query->bindParam(":username", $login_user);

        $result = $query->execute();
       
		if(!empty($result)) {
			$error_message = "";
			$success_message = "You have edited your account information successfully! This page will be refreshed soon.";
            
			unset($_POST);
            echo "<meta http-equiv='refresh' content='2'>";

		} else {
			$error_message = "Problem in registration. Try Again!";	
		}
	} else {
		//$error_message = "test";
	}
}
?>