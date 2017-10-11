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
        include("process_showproduct.php");
    ?>
    
    <!-- Body content -->
    <div class="container-fluid">
        <!-- Sort and filter list -->
        <h1 class="h3">Products</h1>
        <hr/>
        <div class="row">
            <div class="col-xs-3">
                <!-- Sorting dropdown -->
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Sort <span class="caret"></span></button>
                    
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">Price</li>
                        <li><a href="#" class="dropdown-item">Low to High</a></li>
                        <li><a href="#" class="dropdown-item">High to Low</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Ratings</li>
                        <li><a href="#" class="dropdown-item">Low to High</a>
                        <li><a href="#" class="dropdown-item">High to Low</a></li>
                    </ul>
                </div>
            </div>   
            
            
            <!-- Filter -->
            <div class="col-xs-9">    
                <div class="form-group row form-inline">
                    <label for="minPrice">Price range:</label>

                    <input type="number" class="form-control" data-ng-model="minPrice" id="minPrice" min="0" size="4"/> <span>&ndash;</span>
                    <input type="number" class="form-control" data-ng-model="maxPrice" min="0"/>
                    <span>&nbsp;</span>
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" data-ng-model="freeShpg">
                        Free shipping
                    </label>
                </div>
            </div>
        </div>
        
        
        
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
							<div class="row">
								<div class="col-xs-12 text-center">
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
		
        <!--<div class="row" data-ng-repeat="product in products" data-ng-switch on="$index % 4">
            <div class="col-xs-6 col-md-3 text-center" data-ng-switch-when="0">
                <div class="row">
                    <div class="col-xs-12">
                        {{products[$index].id}}
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        {{products[$index].name}}
                    </div>
                </div>
                 
            </div>
            
            <div class="col-xs-6 col-md-3 text-center" data-ng-switch-when="0">
                <div class="row">
                    <div class="col-xs-12">
                        {{products[$index+1].id}}
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        {{products[$index+1].name}}
                    </div>
                </div>
                 
            </div>
            
            <div class="clearfix visible-xs" data-ng-switch-when="0"></div>
            
            <div class="col-xs-6 col-md-3 text-center" data-ng-switch-when="0">
                <div class="row">
                    <div class="col-xs-12">
                        {{products[$index+2].id}}
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        {{products[$index+2].name}}
                    </div>
                </div>
                
            </div>
            
            <div class="col-xs-6 col-md-3 text-center" data-ng-switch-when="0">
                <div class="row">
                    <div class="col-xs-12">
                        {{products[$index+3].id}}
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        {{products[$index+3].name}}
                    </div>
                </div>
            </div>
        </div>-->
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