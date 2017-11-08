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
    <style>
        .row {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <?php 
        include("header.php");
    ?>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>
		
		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			<div class="item active">
				<img src="images/carousel/art.jpg" alt="banner1" style="width:100%;">
			</div>
			<div class="item">
				<img src="images/carousel/fashion.jpg" alt="banner2" style="width:100%;">
			</div>
			<div class="item">
				<img src="images/carousel/crafts.jpg" alt="banner3" style="width:100%;">
			</div>
		</div>
		
		<!-- Left and right controls-->
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
      		<span class="sr-only">Next</span>
		</a>
	</div>
	
	<!--
    <div class="jumbotron">
        <div class="container-fluid">
            <h1>Money Saver</h1>
            <p>Plan your budget with us.</p>
            <button type="button" class="btn">Sign up now</button>
        </div>
    </div>
    -->
	
    <!-- Body content -->
    <div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<br/>
				<h2 class="h4">Product Category</h2>
				<hr/>
			</div>
		</div>
		
        <div class="row">
            <div class="col-xs-6 col-md-3 text-center">
				<a href=""><img src="images/category/jewelry.png" alt="Jewelry" style="width:100%;"/></a>
                <!--<div class="glyphicon glyphicon-edit text-muted"></div>
                <p class="text-muted"><strong>Record Your Expenses</strong></p>-->
            </div>
            
            <div class="col-xs-6 col-md-3 text-center">
				<a href=""><img src="images/category/clothing.png" alt="Clothing" style="width:100%;"/></a>
                <!--<div class="glyphicon glyphicon-list-alt text-muted"></div>
                <p class="text-muted"><strong>View Your Transactions</strong></p>-->
            </div>
            
            <div class="clearfix visible-xs"></div>
            
            <div class="col-xs-6 col-md-3 text-center">
				<a href=""><img src="images/category/roomdecor.png" alt="Room Decoration" style="width:100%;"/></a>
                <!--<div class="glyphicon glyphicon-piggy-bank text-muted"></div>
                <p class="text-muted"><strong>Plan Your Budget</strong></p>-->
            </div>
            
            <div class="col-xs-6 col-md-3 text-center">
				<a href=""><img src="images/category/wedding.png" alt="Wedding" style="width:100%;"/></a>
                <!--<div class="glyphicon glyphicon-piggy-bank text-muted"></div>
                <p class="text-muted"><strong>Plan Your Budget</strong></p>-->
            </div>
        </div>
		
		<div class="row">
            <div class="col-xs-6 col-md-3 text-center">
				<a href=""><img src="images/category/vintageart.png" alt="Vintage Art" style="width:100%;"/></a>
                <!--<div class="glyphicon glyphicon-cog text-muted"></div>
                <p class="text-muted"><strong>Easy Setting of Transactions</strong></p>-->
            </div>
            
            <div class="col-xs-6 col-md-3 text-center">
				<a href=""><img src="images/category/toys.png" alt="Toys" style="width:100%;"/></a>
                <!--<div class="glyphicon glyphicon-edit text-muted"></div>
                <p class="text-muted"><strong>Record Your Expenses</strong></p>-->
            </div>
            
            <div class="col-xs-6 col-md-3 text-center">
				<a href=""><img src="images/category/craftsupplies.png" alt="Craft Supplies" style="width:100%;"/></a>
                <!--<div class="glyphicon glyphicon-list-alt text-muted"></div>
                <p class="text-muted"><strong>View Your Transactions</strong></p>-->
            </div>
            
            <div class="clearfix visible-xs"></div>
            
            <div class="col-xs-6 col-md-3 text-center">
				<a href=""><img src="images/category/other.png" alt="Others" style="width:100%;"/></a>
                <!--<div class="glyphicon glyphicon-cog text-muted"></div>
                <p class="text-muted"><strong>Easy Setting of Transactions</strong></p>-->
            </div>
        </div>
		
		<br/>
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