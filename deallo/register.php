<!DOCTYPE html>
<html data-ng-app="">
<head>
    <title>Deallo Craft House</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initialscale=1.0"/>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/stylesheet.css" rel="stylesheet" />
    <link href="css/intlTelInput.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!-- Navigation Bar -->
    <?php 
		include("header.php");
        include("process_register.php");
    ?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 col-xl-6 col-xl-offset-3">
                <form id="registerForm" name="frmRegistration" method="post" action="" novalidate role="form">
                    <?php if(!empty($success_message)) { ?>	
                    <div class="alert alert-success">
                    <?php if(isset($success_message)) echo $success_message; ?></div>
                    <?php } ?>
                    <?php if(!empty($error_message)) { ?>	
                    <div class="alert alert-danger"><?php if(isset($error_message)) echo $error_message; ?></div>
                    <?php } ?>
                    <fieldset>
                        <legend>Personal Info</legend>
                        
                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="firstname">*First name:</label>
                                <input type="text" class="form-control col-xs-6" id="firstname" data-ng-model="user.firstname" name="firstName" data-ng-pattern="/^[a-zA-Z ]*$/" value="<?php if(isset($_POST['firstName'])) echo $_POST['firstName']; ?>" required/>
                            </div>
                        
                            <div class="form-group col-xs-6">
                                <label for="lastname">*Last name:</label>
                                <input type="text" class="form-control" id="lastname" data-ng-model="user.lastname" name="lastName" data-ng-pattern="/^[a-zA-Z ]*$/" value="<?php if(isset($_POST['lastName'])) echo $_POST['lastName']; ?>" required/>
                            </div>
                            
                            
                            <!--Displaying errors: firstname, lastname-->
                            
                            <p class="alert alert-danger" data-ng-show="frmRegistration.firstName.$error.required && frmRegistration.firstName.$touched" >*First name is required</p>

                            <p class="alert alert-danger" data-ng-show="frmRegistration.firstName.$error.pattern && frmRegistration.firstName.$touched">*First name must be alphabetic</p>

                            <p class="alert alert-danger" data-ng-show="frmRegistration.lastName.$error.required && frmRegistration.lastName.$touched">*Last name is required</p>

                            <p class="alert alert-danger" data-ng-show="frmRegistration.lastName.$error.pattern && frmRegistration.lastName.$touched">*Last name must be alphabetic</p>
                            
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="email">*Email:</label>
                                <input type="email" class="form-control" id="email" data-ng-model="user.email" name="userEmail" value="<?php if(isset($_POST['userEmail'])) echo $_POST['userEmail']; ?>" required/>
                            </div>
                            
                            <p class="alert alert-danger" data-ng-show="frmRegistration.userEmail.$error.required && frmRegistration.userEmail.$touched">*Email is required</p>
                    
                            <p class="alert alert-danger" data-ng-show="!frmRegistration.userEmail.$error.required && frmRegistration.userEmail.$invalid && frmRegistration.userEmail.$touched">*Email format is invalid, format example: 1234@email.com</p>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="username">*Username:</label>
                                <input type="text" class="form-control" id="username" data-ng-model="user.username" name="userName" data-ng-minlength="4" value="<?php if(isset($_POST['userName'])) echo $_POST['userName']; ?>" required/>
                            </div>
                            
                            <p class="alert alert-danger" data-ng-show="frmRegistration.userName.$error.required && frmRegistration.userName.$touched">*Username is required</p>
                            
                            <p class="alert alert-danger" data-ng-show="frmRegistration.userName.$error.minlength && frmRegistration.userName.$touched">*Username must has 4 characters and above</p>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="password">*Password:</label>
                                <input type="password" class="form-control" id="password" data-ng-model="user.password" name="password" data-ng-minlength="6"  value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>" required/>
                            </div> 
							
							<div class="form-group col-xs-6">
                                <label for="confirmpass">*Confirm Password:</label>
                                <input type="password" class="form-control" id="confirmpass" data-ng-model="user.confirmpass" name="confirmPass" required/>
                            </div>
                            
                            <p class="alert alert-danger" data-ng-show="frmRegistration.password.$error.required && frmRegistration.password.$touched">*Password is required</p>
                            
                            <p class="alert alert-danger" data-ng-show=" frmRegistration.password.$error.minlength && frmRegistration.password.$touched">Password must contain at least 6 characters</p>
                            
                            <p class="alert alert-danger" data-ng-show="frmRegistration.confirmPass.$error.required && frmRegistration.confirmPass.$touched">*Please re-enter your password</p>
                            
                            <p class="alert alert-danger" data-ng-show="user.confirmpass != user.password">Password does not match</p>
                        </div>
					</fieldset>
					<br/>
					<fieldset>
						<legend>Contact Info</legend>
                        
                        <div class="row">
                            <div class="form-group col-xs-12">
                            	<label for="phone">Phone Number:</label>
                            	<input type="tel" class="form-control" id="phone" data-ng-model="user.phone" name="phoneNum" value="<?php if(isset($_POST['phoneNum'])) echo $_POST['phoneNum']; ?>"/>
                                <span id="validMsg" class="glyphicon glyphicon-ok hide text-success"></span>
                                <span id="errorMsg" class="glyphicon glyphicon-remove hide text-danger"></span>
                            </div>                            
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-12">
                            	<label for="address">Address:</label>
								<input type="text" data-ng-model="user.address" class="form-control" name="userAddress" value="<?php if(isset($_POST['userAddress'])) echo $_POST['userAddress']; ?>"/>
                            </div>                            
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-6">
								<!--Using Boostrap form helper js to load country list-->
								<!-- http://js.nicdn.de/bootstrap/formhelpers/docs/country.html-->
                            	<label for="country">Country:</label>
								<select class="form-control bfh-countries" id="country" data-country="MY" data-ng-model="user.country" name="userCountry" value="<?php if(isset($_POST['userCountry'])) echo $_POST['userCountry']; ?>">
								</select>
                            </div>   
							
							<div class="form-group col-xs-6">
								<label for="state">State:</label>
								<select class="form-control bfh-states" data-country="country" data-ng-model="user.state" name="userState" value="<?php if(isset($_POST['userState'])) echo $_POST['userState']; ?>">
								</select>
							</div>
                        </div>
                        
						<div class="row">
                            <div class="form-group col-xs-12">
                            	<label for="city">City:</label>
								<input type="text" maxlength="40" data-ng-model="user.city" class="form-control"  name="userCity" value="<?php if(isset($_POST['userCity'])) echo $_POST['userCity']; ?>">
                            </div>                            
                        </div>
						
						<div class="row">
                            <div class="form-group col-xs-12">
                            	<label for="postcode">Postcode:</label>
								<input type="text" data-ng-model="user.postcode" class="form-control" name="userPostcode" value="<?php if(isset($_POST['userPostcode'])) echo $_POST['userPostcode']; ?>"/>
                            </div>
                            
                        </div>
						
						
						
						<div class="row">
                            <div class="col-xs-12">
                                <label><input type="checkbox" data-ng-model="terms" name="terms"> I accept Terms and Conditions</label>
                            </div>
                        </div>
                    </fieldset>  

                        <button type="submit" class="btn btn-default" name="registerUser" data-ng-disabled="frmRegistration.$invalid || user.password!=user.confirmpass" value="register">Submit</button> 
                    
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
    <script src="js/bootstrap-formhelpers-phone.js"></script>
    <script src="js/bootstrap-formhelpers-phone.en_US.js"></script>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/intlTelInput.js"></script>
    
    <script src="js/validphonenum.js"></script>
    
	
</body>
</html>