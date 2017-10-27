<!DOCTYPE html>
<html data-ng-app="moneySaver">
<head>
    <title>Deallo Craft House</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initialscale=1.0"/>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/stylesheet.css" rel="stylesheet" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css"> 
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
                        <li><a href="productcategory.php?category=<?php echo $category; ?>&sort=pricelowhigh" class="dropdown-item">Low to High</a></li>
                        <li><a href="productcategory.php?category=<?php echo $category; ?>&sort=pricehighlow" class="dropdown-item">High to Low</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Ratings</li>
                        <li><a href="productcategory.php?category=<?php echo $category; ?>&sort=ratinglowhigh" class="dropdown-item">Low to High</a>
                        <li><a href="productcategory.php?category=<?php echo $category; ?>&sort=ratinghighlow" class="dropdown-item">High to Low</a></li>
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
            $rated = true;
            
			if (count($results) > 0) {
				foreach ($results as $product) {
                    //get rating for each product
                     $query2 = $db_handle->getConn()->prepare("SELECT CAST(AVG(rating.rating_value) AS DECIMAL(10,1)) AS rating_average FROM products INNER JOIN rating ON rating.product_id=products.id AND products.id = :productID");
                    $query2->bindParam(":productID", $product["id"]);
                    $query2->execute();
                    $result2 = $query2->fetchAll();
                    
                    if($result2[0][0] != ""){
                        $rating = $result2[0]["rating_average"];
                        //$rating = $resultrating_average;
                    }else{
                        $rating = 0;
                    }
                    
                    
					$productImg = explode("_,_", $product["img"]);
					if ($index == 0) {
						echo '<div class="row">';
					}
					
					echo 
						'<div class="col-xs-6 col-md-3">
							<a href="productdetails.php?productID='. $product["id"] .'"> 
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
                                    <form>
                                        <fieldset class="rating" >
                                            <input type="radio" id="star5" name="rating" value="5.0" ' . (($rating <= 5.0 && $rating > 4.5) ? "checked" : (($rated == true) ? "disabled" : "")) . '/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                            <input type="radio" id="star4half" name="rating" value="4.5" ' . (($rating <= 4.5 && $rating > 4.0) ? "checked" : (($rated == true) ? "disabled" : "")) . '/><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                            <input type="radio" id="star4" name="rating" value="4.0" ' . (($rating <= 4.0 && $rating > 3.5) ? "checked" : (($rated == true) ? "disabled" : "")) . '/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                            <input type="radio" id="star3half" name="rating" value="3.5" ' . (($rating <= 3.5 && $rating > 3.0) ? "checked" : (($rated == true) ? "disabled" : "")) . '/><label class="half" for="star3half" title="Average - 3.5 stars"></label>
                                            <input type="radio" id="star3" name="rating" value="3.0" ' . (($rating <= 3.0 && $rating >2.5) ? "checked" : (($rated == true) ? "disabled" : "")) . '/><label class = "full" for="star3" title="Average - 3 stars"></label>
                                            <input type="radio" id="star2half" name="rating" value="2.5" ' . (($rating <= 2.5 && $rating > 2.0) ? "checked" : (($rated == true) ? "disabled" : "")) . '/><label class="half" for="star2half" title="Below Average - 2.5 stars"></label>
                                            <input type="radio" id="star2" name="rating" value="2.0" ' . (($rating <= 2.0 && $rating > 1.5) ? "checked" : (($rated == true) ? "disabled" : "")) . ' /><label class = "full" for="star2" title="Below Average - 2 stars"></label>
                                            <input type="radio" id="star1half" name="rating" value="1.5" ' . (($rating <= 1.5 && $rating > 1.0) ? "checked" : (($rated == true) ? "disabled" : "")) . '/><label class="half" for="star1half" title="Unpopular - 1.5 stars"></label>
                                            <input type="radio" id="star1" name="rating" value="1.0" ' . (($rating <= 1.0 && $rating > 0.5) ? "checked" : (($rated == true) ? "disabled" : "")) . '/><label class = "full" for="star1" title="Very Unpopular - 1 star"></label>
                                            <input type="radio" id="starhalf" name="rating" value="0.5" ' . (($rating <= 0.5 & $rating > 0 ) ? "checked" : (($rated == true) ? "disabled" : "")) . '/><label class="half" for="starhalf" title="Very Unpopular - 0.5 stars"></label>
                                        </fieldset>
                                        </form>
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
						</div>';
					
					if ($index == 1) {
						echo '<div class="clearfix visible-xs"></div>';
					}

					if ($index == 3){
						echo '</div>';
						$index = 0;
					} else {
						$index++;
					}     
                    
				}
				
				if ($index != 0) {
					echo '</div>';
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