<!DOCTYPE html>
<html data-ng-app="">
<head>
    <title>Deallo</title>
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
                    <form action="edituseraccount.php">
                        <legend>Personal Info</legend>
                        <?php foreach($result as $row) : ?>
                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="firstname">*First name:</label>
                                <input type="text" class="form-control col-xs-6" id="firstname" data-ng-model="user.firstname" name="firstName" placeholder="<?php echo $row["first_name"]; ?>"  disabled/>
                            </div>
                        
                            <div class="form-group col-xs-6">
                                <label for="lastname">*Last name:</label>
                                <input type="text" class="form-control" id="lastname" data-ng-model="user.lastname" name="lastName" placeholder="<?php echo $row["last_name"]; ?>"  disabled/>
                            </div>

                            
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="email">*Email:</label>
                                <input type="email" class="form-control" id="email" data-ng-model="user.email" name="userEmail" placeholder="<?php echo $row["email"]; ?>"  disabled/>
                            </div>

                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="username">*Username:</label>
                                <input type="text" class="form-control" id="username" data-ng-model="user.username" name="userName" data-ng-minlength="4" placeholder="<?php echo $row["first_name"]; ?>"  disabled/>
                            </div>
                            

                        </div>

					<br/>

						<legend>Contact Info</legend>
                        
                        <div class="row">
                            <div class="form-group col-xs-12">
                            	<label for="phone">Phone Number:</label>
                            	<input type="tel" class="form-control" id="phone" data-ng-model="user.phone" name="phoneNum" placeholder="<?php echo $row["phone_number"]; ?>"  disabled/>
                                <span id="validMsg" class="glyphicon glyphicon-ok hide text-success"></span>
                                <span id="errorMsg" class="glyphicon glyphicon-remove hide text-danger"></span>
                            </div>                            
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-12">
                            	<label for="address">Address:</label>
								<input type="text" data-ng-model="user.address" class="form-control" name="userAddress" placeholder="<?php echo $row["address"]; ?>"  disabled/>
                            </div>                            
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-xs-6">
								<!--Using Boostrap form helper js to load country list-->
								<!-- http://js.nicdn.de/bootstrap/formhelpers/docs/country.html-->
                            	<label for="country">Country:</label>
								<input type="text" data-ng-model="user.country" class="form-control" name="userCountry" placeholder="<?php echo $row["country"]; ?>"  disabled/>
                            </div>   
							
							<div class="form-group col-xs-6">
								<label for="state">State:</label>
								<input type="text" data-ng-model="user.state" class="form-control" name="userState" placeholder="<?php echo $row["state"]; ?>"  disabled/>
							</div>
                        </div>
                        
						<div class="row">
                            <div class="form-group col-xs-12">
                            	<label for="city">City:</label>
								<input type="text" maxlength="40" data-ng-model="user.city" class="form-control"  name="userCity" placeholder="<?php echo $row["city"]; ?>"  disabled/>
                            </div>                            
                        </div>
						
						<div class="row">
                            <div class="form-group col-xs-12">
                            	<label for="postcode">Postcode:</label>
								<input type="text" data-ng-model="user.postcode" class="form-control" name="userPostcode" placeholder="<?php echo $row["postcode"]; ?>"  disabled/>
                            </div>
                            
                        </div>
						
                    <input type="submit" value="Edit Account Information"/>
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