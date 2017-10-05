<?php
$first_name = $last_name = $email = $username = $password = $phone_number = $address = $country = $state = $city = $postcode = "";
$first_nameErr = $last_nameErr = $emailErr = $usernameErr = $passwordErr = $phone_numberErr = $addressErr = $countryErr = $stateErr = $cityErr = $postcodeErr = "";
$errorpresence = false;
$error_message = "";

if(!empty($_POST["registerUser"])) {
	
     
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
    
    
    /* Email Validation */
	if(empty($_POST["userEmail"])){
        $emailErr = "Please enter your email";
        $errorpresence = true;
    } else{
        $email = sanitizeInput($_POST["userEmail"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format";
            $errorpresence = true;
        }
    }
    
    /* Username Validation */
    if(empty($_POST["userName"])){
        $usernameErr = "Please enter your username";
        $errorpresence = true;
    }else{
         if (!preg_match("/^[a-zA-Z0-9]*$/",$_POST["userName"])) {
            $usernameErr = "Invalid username input";
            $errorpresence = true;
        }else{
            $username = sanitizeInput($_POST["userName"]);
        }
        
    }
    
    /* Password Validation */
    if(empty($_POST["password"])){
        $passwordErr = "Please enter your password";
        $errorpresence = true;
    }
    
	/* Password Matching Validation */
	if($_POST['password'] != $_POST['confirmPass']){ 
	   $passwordErr = 'Please confirm your password<br>'; 
        $errorpresence = true;
	}else{
        $password = password_hash(sanitizeInput($_POST["password"]), PASSWORD_DEFAULT);
    }
    
    /* Phone number Validation */
    if(!empty($_POST["phoneNum"])){
        if (!preg_match("/^[0-9]{10,12}$/",$_POST["phoneNum"])) {
            $phone_numberErr = "Invalid phone number";
            $errorpresence = true;
        }else{
            $phone_number = sanitizeInput($_POST["phoneNum"]);
        }
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
    
    
	/* Validation to check if Terms and Conditions are accepted */
	if(!isset($error_message)) {
		if(!isset($_POST["terms"])) {
		$error_message = "Accept Terms and Conditions to Register";
		}
	}
    
    

	if($error_message == "" && $errorpresence == false) {
        
        require_once("dbcontroller.php");
		$db_handle = new DBController();
        
        /*check for duplicate email and username*/
        $checkEmailDuplicateQuery = $db_handle->getConn()->prepare("SELECT email FROM user_account WHERE email= :email");
        $checkEmailDuplicateQuery->bindParam(":email", $email);
        $checkEmailDuplicateQuery->execute();
        $duplicateEmailQueryResult = count($checkEmailDuplicateQuery->fetchAll());
        
        
        $checkUsernameDuplicateQuery = $db_handle->getConn()->prepare("SELECT username FROM user_account WHERE username= :username");
        $checkUsernameDuplicateQuery->bindParam(":username", $username);
        $checkUsernameDuplicateQuery->execute();
        $duplicateUsernameQueryResult = count($checkUsernameDuplicateQuery->fetchAll());
        
        
        /* If not duplicate email and username then proceed to insert user registration info into database table */
		if($duplicateEmailQueryResult > 0){
            $emailErr = "Email already exist.";
        }else if($duplicateUsernameQueryResult > 0){
            $usernameErr = "Username already exists";
        }else{
            $query = $db_handle->getConn()->prepare("INSERT INTO user_account (id, email, first_name, last_name, username, password, phone_number, address, country, state, city, postcode) VALUES
            (NULL, :email, :first_name, :last_name, :username, :password, :phone_number, :address, :country, :state, :city, :postcode)");
            $query->bindParam(":email", $email);
            $query->bindParam(":first_name", $first_name);
            $query->bindParam(":last_name", $last_name);
            $query->bindParam(":username", $username);
            $query->bindParam(":password", $password);
            $query->bindParam(":phone_number", $phone_number);
            $query->bindParam(":address", $address);
            $query->bindParam(":country", $country);
            $query->bindParam(":state", $state);
            $query->bindParam(":city", $city);
            $query->bindParam(":postcode", $postcode);



            $result = $query->execute();
            if($result = true) {
                $error_message = "";
                $success_message = "You have registered successfully!";	
                unset($_POST);
                header("refresh:3; url=login.php");
            } else {
                $error_message = "Problem in registration. Try Again!";	
            }
        }   
	} else {
        $error_message = "Failed to submit";
    }
}

function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }
?>