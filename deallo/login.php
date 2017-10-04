<!DOCTYPE html>
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
            window.fbAsyncInit = function() {
                FB.init({
                    appId      : '296435147524384',
                    xfbml      : true,
                    version    : 'v2.10'
                });
                FB.AppEvents.logPageView();
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
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
                        <div id="loginBtn">
                            <fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>
                        </div>
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
    </body>
</html>