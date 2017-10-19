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
        include("process_viewuseraccount.php");
		include("process_edituseraccount.php");
    ?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">

                    <?php if(!empty($success_message)) { ?>	
                    <div class="alert alert-success">
                    <?php if(isset($success_message)) echo $success_message; ?></div>
                    <?php } ?>
                    <?php if(!empty($error_message)) { ?>	
                    <div class="alert alert-danger"><?php if(isset($error_message)) echo $error_message; ?></div>
                    <?php } ?>
				
                    <form name="frmEditAccount" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate role="form">
                        <legend>Personal Info</legend>
                        <?php foreach($selectResult as $row) : ?>
                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="firstname">*First name:</label>
                                <input type="text" class="form-control col-xs-6" id="firstname" name="firstName" data-ng-pattern="/^[a-zA-Z ]*$/" value="<?php echo $row["first_name"]; ?>" <?php if(!isset($_POST["editProfile"])) { echo "disabled"; } ?> required/>
                            </div>
                        
                            <div class="form-group col-xs-6">
                                <label for="lastname">*Last name:</label>
                                <input type="text" class="form-control" id="lastname" name="lastName" data-ng-pattern="/^[a-zA-Z ]*$/" value="<?php echo $row["last_name"]; ?>"  <?php if(!isset($_POST["editProfile"])) { echo "disabled"; } ?> required/>
                            </div>

                            <p class="alert alert-danger" data-ng-show="frmEditAccount.firstName.$error.required && frmEditAccount.firstName.$touched" >*First name is required</p>

                            <p class="alert alert-danger" data-ng-show="frmEditAccount.firstName.$error.pattern && frmEditAccount.firstName.$touched">*First name must be alphabetic</p>

                            <p class="alert alert-danger" data-ng-show="frmEditAccount.lastName.$error.required && frmEditAccount.lastName.$touched">*Last name is required</p>

                            <p class="alert alert-danger" data-ng-show="frmEditAccount.lastName.$error.pattern && frmEditAccount.lastName.$touched">*Last name must be alphabetic</p>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="email">*Email:</label>
                                <input type="email" class="form-control" id="email" name="userEmail" value="<?php echo $row["email"]; ?>"  disabled/>
                            </div>

                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="username">*Username:</label>
                                <input type="text" class="form-control" id="username" name="userName" data-ng-minlength="4" value="<?php echo $row["username"]; ?>"  disabled/>
                            </div>
                           
                        </div>
					<br/>

						<legend>Contact Info</legend>
                        
                        <div class="row">
                            <div class="form-group col-xs-12">
                            	<label for="phone">Phone Number:</label>
                            	<input type="tel" class="form-control" id="phone" name="phoneNum" placeholder="<?php echo $row["phone_number"]; ?>" <?php if(!isset($_POST["editProfile"])) { echo "disabled"; } ?>/>
                                <span id="validMsg" class="glyphicon glyphicon-ok hide text-success"></span>
                                <span id="errorMsg" class="glyphicon glyphicon-remove hide text-danger"></span>
                            </div>                            
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-12">
                            	<label for="address">Address:</label>
								<input type="text" class="form-control" name="userAddress" value="<?php echo $row["address"]; ?>" <?php if(!isset($_POST["editProfile"])) { echo "disabled"; } ?>/>
                            </div>                            
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-6">
								<!--Using Boostrap form helper js to load country list-->
								<!-- http://js.nicdn.de/bootstrap/formhelpers/docs/country.html-->
								<label for="country">Country:</label>
								<select class="form-control bfh-countries" id="country" <?php if($row["country"] != "") { echo 'data-country="'. $row["country"] .'"'; } ?> data-ng-model="user.country" name="userCountry" data-ng-pattern="/^[a-zA-Z ]*$/" <?php if(!isset($_POST["editProfile"])) { echo "disabled"; } ?>><span class="error"><?php if($countryErr != "") echo "<p class='alert alert-danger'>" . $countryErr . "</p>";?></span>
								</select>
                            </div>   
							
							<div class="form-group col-xs-6">
								<label for="state">State:</label>
								<select class="form-control bfh-states" data-country="country" <?php if($row["state"] != "") { echo 'data-state="'. $row["state"] .'"'; } ?>data-ng-model="user.state" name="userState" data-ng-pattern="/^[a-zA-Z ]*$/" <?php if(!isset($_POST["editProfile"])) { echo "disabled"; } ?>><span class="error"><?php if($stateErr != "") echo "<p class='alert alert-danger'>" . $stateErr . "</p>"?>; </span>
								</select>
							</div>
                        </div>
                        
						<div class="row">
                            <div class="form-group col-xs-12">
                            	<label for="city">City:</label>
								<input type="text" maxlength="40" class="form-control"  name="userCity" value="<?php echo $row["city"]; ?>" <?php if(!isset($_POST["editProfile"])) { echo "disabled"; } ?>/>
                            </div>                            
                        </div>
						
						<div class="row">
                            <div class="form-group col-xs-12">
                            	<label for="postcode">Postcode:</label>
								<input type="text" class="form-control" name="userPostcode" value="<?php echo $row["postcode"]; ?>" <?php if(!isset($_POST["editProfile"])) { echo "disabled"; } ?>/>
                            </div>
                            
                        </div>
						
                    <input type="submit" class="btn btn-default" value="Edit Profile" <?php if(isset($_POST["editProfile"])){ echo 'name="edituserInfo"'; } else { echo 'name="editProfile"'; } ?>/>
                    <?php endforeach; ?>
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