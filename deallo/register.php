<?php
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
		require_once("dbcontroller.php");
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
<!DOCTYPE html>
<html data-ng-app="">
<head>
    <title>Money Saver</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initialscale=1.0"/>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/stylesheet.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <!--3 bar icon-->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-to-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="#">Money Saver</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-to-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact us</a></li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Products <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Burger</a></li>
                            <li><a href="#">Appetizer</a></li>
                            <li><a href="#">Dessert</a></li>
                            <li><a href="#">Drink</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="btn disabled hidden-xs">|</a></li>
                    <li><a href="#">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <form name="frmRegistration" method="post" action="">
                    <?php if(!empty($success_message)) { ?>	
                    <div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
                    <?php } ?>
                    <?php if(!empty($error_message)) { ?>	
                    <div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
                    <?php } ?>
                    <fieldset>
                        <legend>Personal Info</legend>
                        
                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="firstname">*First name:</label>
                                <input type="text" class="form-control col-xs-6" id="firstname" data-ng-model="firstname" name="firstName" value="<?php if(isset($_POST['firstName'])) echo $_POST['firstName']; ?>"/>
                            </div>
                        
                            <div class="form-group col-xs-6">
                                <label for="lastname">*Last name:</label>
                                <input type="text" class="form-control" id="lastname" data-ng-model="lastname" name="lastName" value="<?php if(isset($_POST['lastName'])) echo $_POST['lastName']; ?>"/>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="email">*Email:</label>
                                <input type="email" class="form-control" id="email" data-ng-model="email" name="userEmail" value="<?php if(isset($_POST['userEmail'])) echo $_POST['userEmail']; ?>"/>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="username">*Username:</label>
                                <input type="text" class="form-control" id="username" data-ng-model="username" name="userName" value="<?php if(isset($_POST['userName'])) echo $_POST['userName']; ?>"/>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="password">*Password:</label>
                                <input type="password" class="form-control" id="password" data-ng-model="password" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>"/>
                            </div> 
							
							<div class="form-group col-xs-6">
                                <label for="confirmpass">*Confirm Password:</label>
                                <input type="confirmpass" class="form-control" id="confirmpass" data-ng-model="confirmpass" name="confirmPass" />
                            </div>  
                        </div>
					</fieldset>
					<br/>
					<fieldset>
						<legend>Contact Info</legend>
						<div class="row">
                                                      
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-12">
                            	<label for="phone">Phone Number:</label>
                            	<input type="text" class="form-control" id="phone" data-ng-model="phone" name="phoneNum" value="<?php if(isset($_POST['phoneNum'])) echo $_POST['phoneNum']; ?>"/>
                            </div>                            
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-12">
                            	<label for="address">Address:</label>
								<input type="text" maxlength="40" data-ng-model="address" class="form-control" name="userAddress" value="<?php if(isset($_POST['userAddress'])) echo $_POST['userAddress']; ?>"/>
                            </div>                            
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-6">
								<!--Using Boostrap form helper js to load country list-->
								<!-- http://js.nicdn.de/bootstrap/formhelpers/docs/country.html-->
                            	<label for="country">Country:</label>
								<select class="form-control bfh-countries" id="country" data-country="MY" data-ng-model="country" name="userCountry" value="<?php if(isset($_POST['userCountry'])) echo $_POST['userCountry']; ?>">
								</select>
                            </div>   
							
							<div class="form-group col-xs-6">
								<label for="state">State:</label>
								<select class="form-control bfh-states" data-country="country" data-ng-model="state" name="userState" value="<?php if(isset($_POST['userState'])) echo $_POST['userState']; ?>">
								</select>
							</div>
                        </div>
                        
						<div class="row">
                            <div class="form-group col-xs-12">
                            	<label for="city">City:</label>
								<input type="text" maxlength="40" data-ng-model="city" class="form-control" data-ng-model="city" name="userCity" value="<?php if(isset($_POST['userCity'])) echo $_POST['userCity']; ?>">
                            </div>                            
                        </div>
						
						<div class="row">
                            <div class="form-group col-xs-12">
                            	<label for="postcode">Postcode:</label>
								<input type="text" maxlength="40" data-ng-model="postcode" class="form-control" name="userPostcode" value="<?php if(isset($_POST['userPostcode'])) echo $_POST['userPostcode']; ?>"/>
                            </div>                            
                        </div>
						
						
						
						<div class="row">
                            <div class="form-group col-xs-12">
                                <input type="checkbox" class="form-control" data-ng0model="terms" name="terms"> I accept Terms and Conditions
                        </div>
						
						
					</fieldset>
                        

                        <button type="submit" class="btn btn-default" name="registerUser" value="register">Submit</button> 
                    
                </form>
            </div>
        </div>
        
    </div>
    
    
    
    <!-- Footer -->
    <footer class="footer navbar-static-bottom">
      <div class="container">
          <ul class="list-inline text-center">
              <li><a href="#">Home</a></li>
              <li>&#8226;</li>
              <li><a href="#">About</a></li>
              <li>&#8226;</li>
              <li><a href="#">Products</a></li>
              <li>&#8226;</li>
              <li><a href="#">Contact us</a></li>
          </ul>
          <p class="text-center copyright"><em>Copyright &copy; 2017. All Rights reserved by Money Saver Sdn Bhd</em></p>
      </div>
    </footer>
    <!-- jQuery – required for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- All Bootstrap plug-ins file -->
    <script src="js/bootstrap.min.js"></script>
    <!--Basic AngularJS-->
    <script src="js/angular.min.js"></script>
	<!--Bootstrap form helper-->
	<script src="js/bootstrap-formhelpers-countries.en_US.js"></script>
	<script src="js/bootstrap-formhelpers-countries.js"></script>
	<script src="js/bootstrap-formhelpers-states.en_US.js"></script>
	<script src="js/bootstrap-formhelpers-states.js"></script>
	
</body>
</html>