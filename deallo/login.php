<!DOCTYPE html>
<<<<<<< HEAD
<html data-ng-app="app">
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
        <script>

        </script>
    </head>
    <body id="loginpg"> <!--full page background img -->
        <?php 
        include("process_login.php");
        include("header.php");
        ?>
        <!-- Navigation Bar -->


        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-4 col-xs-offset-4">
                    <form id="login" method="post">
                        <fieldset>
                            <legend>Welcome!</legend>
                            <p>Login to your account now.</p>

                            <p class="text-success"><?php echo $resultMsg; ?></p>
                            <p class="text-danger"><?php echo $errorMsg; ?></p>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username and email"/>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password"/>
                            </div>

                            <p><input type="submit" class="btn btn-default" id="loginBtn" value="Login"/> &nbsp; <a href="#">Forgot password?</a></p>
                            <p class="text-muted"><em><small>Need an account? <a href="register.php">Sign up!</a></small></em></p>
                        </fieldset>
=======
<html data-ng-app="">
<head>
    <title>Deallo Craft House</title>
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
<body id="loginpg"> <!--full page background img -->
    <?php 
		include("header.php");
        include("process_login.php");
    ?>
    <!-- Navigation Bar -->
    

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
                <form id="login" method="post">
                    <fieldset>
                        <legend>Welcome!</legend>
                        <p>Login to your account now.</p>
                        
                        <p class="text-success"><?php echo $resultMsg; ?></p>
                        <p class="text-danger"><?php echo $errorMsg; ?></p>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username"/>
                        </div>
>>>>>>> master

                        <!-- Facebook login button-->
                        <hr/>
                        <?php
                        require_once __DIR__ . '/fb/fb_process_login.php';
                        ?>
                    </form>
                </div>

            </div>
        </div>

        <!-- Footer -->
        <?php 
        include("footer.php");
        ?>

        <!-- jQuery – required for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js"></script>
        <!-- All Bootstrap plug-ins file -->
        <script src="js/bootstrap.min.js"></script>
        <!--Basic AngularJS-->

        <!-- Facebook login JS script -->
        <!--<script src="fb_login.js"></script>-->
    </body>
</html>

<?php $session_value=(isset($_SESSION['id']))?$_SESSION['id']:''; ?>