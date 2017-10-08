<?php
require_once("dbcontroller.php");

if(!empty($_POST["registerUser"])) {
	/* Form Required Field Validation */
	foreach($_POST as $key=>$value) {
		if(empty($_POST[$key])) {
		$error_message = "All Fields are required";
		break;
		}
	}
     
    /* First Name Validation */
    if(empty($_POST["firstName"])){
        $error_message = "Please enter your first name";
    }
    
    /* Last Name Validation */
    if(empty($_POST["lastName"])){
        $error_message = "Please enter your last name";
    }
    
    
    /* Email Validation */
	if(!isset($error_message)) {
		if (!filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
		$error_message = "Invalid Email Address";
		}
	}
    
    /* Username Validation */
    if(empty($_POST["userName"])){
        $error_message = "Please enter your username";
    }
    
    /* Password Validation */
    if(empty($_POST["userName"])){
        $error_message = "Please enter your password";
    }
    
	/* Password Matching Validation */
	if($_POST['password'] != $_POST['confirmPass']){ 
	$error_message = 'Please confirm your password<br>'; 
	}
    
    /* Phone number Validation */
    if(empty($_POST["phoneNum"])){
        $error_message = "Please enter your phone number";
    }

    /* Address Validation */
    if(empty($_POST["userAddress"])){
        $error_message = "Please enter your address";
    }
	
    
    /* Country Validation */
    if(empty($_POST["userCountry"])){
        $error_message = "Please enter your country name";
    }

    /* State Validation */
    if(empty($_POST["userState"])){
        $error_message = "Please enter your state name";
    }
    
    /* City Validation */
    if(empty($_POST["userCity"])){
        $error_message = "Please enter your city";
    }
    
    /* Poscode Validation */
    if(empty($_POST["userPostcode"])){
        $error_message = "Please enter your postcode";
    }
    
	/* Validation to check if Terms and Conditions are accepted */
	if(!isset($error_message)) {
		if(!isset($_POST["terms"])) {
		$error_message = "Accept Terms and Conditions to Register";
		}
	}
    
    

	if(!isset($error_message)) {
		
		$db_handle = new DBController();
		$query = "INSERT INTO user_account (id, email, first_name, last_name, username, password, phone_number, address, country, state, city, postcode) VALUES
		(NULL,'" . $_POST["userEmail"] . "', '" . $_POST["firstName"] . "', '" . $_POST["lastName"] . "', '" . $_POST["userName"] . "', '" . md5($_POST["password"]) . "', '" . $_POST["phoneNum"] . "', '" . $_POST["userAddress"] . "', '" . $_POST["userCountry"] . "', '" . $_POST["userState"] . "', '" . $_POST["userCity"] . "', '" . $_POST["userPostcode"] . "')";
		$result = $db_handle->insertQuery($query);
		if(!empty($result)) {
			$error_message = "";
			$success_message = "You have registered successfully!";	
			unset($_POST);
		} else {
			$error_message = "Problem in registration. Try Again!";	
		}
	}
}
?>