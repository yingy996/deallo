<!DOCTYPE html>
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
<body>
    <!-- Navigation Bar -->
    <?php 
        include("header.php");
    ?>
    
    <div class="jumbotron">
        <div class="container-fluid">
            <h1>Money Saver</h1>
            <p>Plan your budget with us.</p>
            <button type="button" class="btn">Sign up now</button>
        </div>
    </div>
    
    <!-- Body content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-6 col-md-3 text-center">
                <div class="glyphicon glyphicon-edit text-muted"></div>
                <p class="text-muted"><strong>Record Your Expenses</strong></p>
            </div>
            
            <div class="col-xs-6 col-md-3 text-center">
                <div class="glyphicon glyphicon-list-alt text-muted"></div>
                <p class="text-muted"><strong>View Your Transactions</strong></p>
            </div>
            
            <div class="clearfix visible-xs"></div>
            
            <div class="col-xs-6 col-md-3 text-center">
                <div class="glyphicon glyphicon-piggy-bank text-muted"></div>
                <p class="text-muted"><strong>Plan Your Budget</strong></p>
            </div>
            
            <div class="col-xs-6 col-md-3 text-center">
                <div class="glyphicon glyphicon-cog text-muted"></div>
                <p class="text-muted"><strong>Easy Setting of Transactions</strong></p>
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
    <script src="js/angular.min.js"></script>
</body>
</html>