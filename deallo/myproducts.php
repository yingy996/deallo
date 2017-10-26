<!DOCTYPE html>
<html data-ng-app="moneySaver">
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
        include("process_showmyproducts.php");
    ?>
    
    <!-- Body content -->
    <div class="container-fluid">
        <!-- Sort and filter list -->
        <h1 class="h3">My Products</h1>
        <hr/>
        
        <!-- List of products -->
        <!-- Code reference https://stackoverflow.com/questions/21644493/how-to-split-the-ng-repeat-data-with-three-columns-using-bootstrap/30128450#30128450?newreg=2738e86b04ed403e84ffce4a201fff6f -->
        <br/>
		
		<?php 
			$index = 0;	
			if (count($results) > 0) {
				foreach ($results as $product) {
					$productImg = explode("_,_", $product["img"]);
					if ($index == 0) {
						echo '<div class="row">';
					}
					
					echo 
						'<div class="col-xs-6 col-md-3">
							<a href="#"> 
								<div class="row">
									<div class="col-xs-12 text-center square">
										<img class="productImg img-thumbnail" src="'. $productImg[0] .'"/>
									</div>
								</div>

								<div class="row">
									<div class="col-xs-12 text-center">
										<p>'.
											$product["name"]
										.'</p>
									</div>
								</div>

								<div class="row">
									<div class="col-xs-12 text-center">
										<p>RM'.
											$product["price"]
										.'</p>
									</div>
								</div>
							</a>
							
							<div class="row btnPadding">
								<a href="editproduct.php?productID='. $product["id"].'">
									<div class="col-xs-6 text-center btn btn-default productBtn">
										Edit
									</div>
								</a>
								
								<a href="#">
									<div class="col-xs-6 text-center btn btn-default productBtn">
										Remove
									</div>
								</a>
							</div>
						</div>';
					
					if ($index == 1) {
						echo '<div class="clearfix visible-xs"></div>';
					}
					
					if ($index == 3) {
						echo '</div>';
					}
					
					if ($index == 3){
						$index = 0;
					} else {
						$index++;
					}
				}
			}
			
		?>
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
    <script src="js/app.js"></script>
</body>
</html>