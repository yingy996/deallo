<!DOCTYPE html>
<html data-ng-app="moneySaver">
    <head>
        <title>Money Saver</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initialscale=1.0"/>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/stylesheet.css" rel="stylesheet" />
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="http://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css"> 

        <link href="css/ratingstarcss.css" rel="stylesheet"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
    </head>
    <body data-ng-controller="productDetailsCtrl">
        <!-- Navigation Bar -->

        <?php 
        include("header.php"); 
        include("process_productdetails.php"); 
        ?>

        <!-- Body content -->
        <div class="container-fluid">
            <div class="content-wrapper">
                 <?php if(!empty($success_message)) { ?>	
                    <div class="alert alert-success">
                    <?php if(isset($success_message)) echo $success_message; ?></div>
                    <?php } ?>
                    <?php if(!empty($error_message)) { ?>	
                    <div class="alert alert-danger"><?php if(isset($error_message)) echo $error_message; ?></div>
                    <?php } ?>
                <form action="shoppingcart.php" method="post">
                    <div class="item-container">	
                        <div class="product-container">	
                                    <div class="col-md-12">
                                                <div class="product col-md-3 service-image-left">
                                                   <center>
                                                    <img id="item-display" name="item-display" <?php echo "src='$dbImages[0]'" ?> alt=""></img>
                                                    </center>
                                                </div>

                                                <div class="product-container service1-items col-sm-2 col-md-2 pull-left">
                                                   <center>

                                        <?php 
                                        $index = 1;
                                            foreach($dbImagesSliced as $dbImageSliced){

                                                /*echo "<a id='item-" . $index . "' class='service1-item'><img src='$dbImageSliced' alt=''></img></a>";*/
                                                echo "<img id='item-" . $index . "' class='service1-item' src='$dbImageSliced' alt=''></img>";
                                                $index ++;

                                            }

                                        ?>

                                        </center>
                                    </div>


                                <div class="col-md-7">
                                    <div class="product-title" name="product-title"><?php echo $result[0]["name"]; ?></div>
                                    <div class="col-md-12" class="col-xs-12">

                                    <form method="post">
                                    <fieldset class="rating">
                                        <input type="radio" id="star5" name="rating" value="5.0" <?php if($rating == 5.0){echo "checked";}else if($rated == true){echo "disabled";}?>/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                        <input type="radio" id="star4half" name="rating" value="4.5" <?php if($rating == 4.5){echo "checked";}else if($rated == true){echo "disabled";}?>/><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                        <input type="radio" id="star4" name="rating" value="4.0" <?php if($rating == 4.0){echo "checked";}else if($rated == true){echo "disabled";}?>/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                        <input type="radio" id="star3half" name="rating" value="3.5" <?php if($rating == 3.5){echo "checked";}else if($rated == true){echo "disabled";}?>/><label class="half" for="star3half" title="Average - 3.5 stars"></label>
                                        <input type="radio" id="star3" name="rating" value="3.0" <?php if($rating == 3.0){echo "checked";}else if($rated == true){echo "disabled";}?>/><label class = "full" for="star3" title="Average - 3 stars"></label>
                                        <input type="radio" id="star2half" name="rating" value="2.5" <?php if($rating == 2.5){echo "checked";}else if($rated == true){echo "disabled";}?>/><label class="half" for="star2half" title="Below Average - 2.5 stars"></label>
                                        <input type="radio" id="star2" name="rating" value="2.0" <?php if($rating == 2.0){echo "checked";}else if($rated == true){echo "disabled";}?>/><label class = "full" for="star2" title="Below Average - 2 stars"></label>
                                        <input type="radio" id="star1half" name="rating" value="1.5" <?php if($rating == 1.5){echo "checked";}else if($rated == true){echo "disabled";}?>/><label class="half" for="star1half" title="Unpopular - 1.5 stars"></label>
                                        <input type="radio" id="star1" name="rating" value="1.0" <?php if($rating == 1.0){echo "checked";}else if($rated == true){echo "disabled";}?>/><label class = "full" for="star1" title="Very Unpopular - 1 star"></label>
                                        <input type="radio" id="starhalf" name="rating" value="0.5" <?php if($rating == 0.5){echo "checked";}else if($rated == true){echo "disabled";}?>/><label class="half" for="starhalf" title="Very Unpopular - 0.5 stars"></label>
                                    </fieldset>
                                        <?php if($rated == false){
                                            echo "<input type='submit' id='ratingbutton' name='ratingbutton' value='rateproduct'/>";
                                        }else{
                                            echo"You have already rated!";
                                        }                       
                                        ?>
                                    </form>
                                        <!--<button type="button" id="ratingbutton" name="ratingbutton" value="rateproduct">Submit Rating</button>-->

                                    </div>
                                    <hr>
                                    <div class="btn-group cart">
                                        <input type="hidden" name="prod_id" value="<?php echo $productId ?>"/>
                                        <button type="submit" class="btn btn-success">
                                            Add to cart 
                                        </button>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="container-fluid">		
			<div class="col-md-12 product-info">
					<ul id="myTab" class="nav nav-tabs nav_tabs">
						
						<li class="active"><a href="#service-one" data-toggle="tab">DESCRIPTION</a></li>
						<li><a href="#service-two" data-toggle="tab">Shipping Information</a></li>
						
						
					</ul>
				<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade in active" id="service-one">
						 
							<section class="container product-info">
                                <?php echo $result[0]["description"]; ?>
							</section>
										  
						</div>
                        <div class="tab-pane fade" id="service-two">

                            <section class="product-info">
                                <?php echo $result[0]["shipping_agents"]; ?>
                            </section>

                        </div>
                        
				</div>
				<hr>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Footer -->
        <footer class="footer navbar-static-bottom">
            <div class="product-container">
                <ul class="list-inline text-center">
                    <li><a href="#">Home</a></li>
                    <li>&#8226;</li>
                    <li><a href="#">About</a></li>
                    <li>&#8226;</li>
                    <li><a href="#">Products</a></li>
                    <li>&#8226;</li>
                    <li><a href="#">Contact us</a></li>
                </ul>
                <p class="text-center copyright"><em>Copyright &copy; Sharon Lo</em> | <a href="disclaimer.html">Disclaimer</a></p>
            </div>
        </footer>
        <!-- jQuery – required for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js"></script>
        <!-- All Bootstrap plug-ins file -->
        <script src="js/bootstrap.min.js"></script>
        <!--Basic AngularJS-->
        <script src="js/angular.min.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>