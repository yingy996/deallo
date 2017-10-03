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
    <?php include("processlogin.php") ?>
    <div id="loginpg"> <!--full page background img -->
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
                <div class="col-xs-4 col-xs-offset-4">
                    <form id="login">
                        <fieldset>
                            <legend>Login</legend>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" data-ng-model="username" value="Enter username and email"/>

                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" data-ng-model="password"/>
                            </div>

                            <button type="submit" class="btn btn-default">Login</button> 
                        </fieldset>
                    </form>
                </div>
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
</body>
</html>