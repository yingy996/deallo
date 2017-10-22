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
                <form action="shoppingcart.php" method="post">
                    <div class="item-container">	
                        <div class="product-container">	
                            <div class="col-md-12">
                                <div class="product col-md-3 service-image-left">
                                    <center>
                                        <!--
<img id="item-display" src="http://www.corsair.com/Media/catalog/product/g/s/gs600_psu_sideview_blue_2.png" alt=""></img> -->
                                        <?php 

                                        echo "<img id='item-display' alt='' src='$dbImages[0]'/>";

                                        ?>
                                    </center>
                                </div>

                                <div class="product-container service1-items col-sm-2 col-md-2 pull-left">
                                    <center>
                                        <a id="item-1" class="service1-item">
                                            <!--
<img src="http://www.corsair.com/Media/catalog/product/g/s/gs600_psu_sideview_blue_2.png" alt=""></img> -->
                                            <?php
                                            if(!empty($dbImages[1])) {
                                                echo "<img id='item-display' alt='' src='$dbImages[1]'/>";
                                            }
                                            ?>
                                        </a>
                                        <a id="item-2" class="service1-item">
                                            <!-- <img src="http://www.corsair.com/Media/catalog/product/g/s/gs600_psu_sideview_blue_2.png" alt=""></img> -->
                                            <?php
                                            if(!empty($dbImages[2])) {
                                                echo "<img id='item-display' alt='' src='$dbImages[2]'/>";
                                            }
                                            ?>
                                        </a>
                                        <a id="item-3" class="service1-item">
                                            <!-- <img src="http://www.corsair.com/Media/catalog/product/g/s/gs600_psu_sideview_blue_2.png" alt=""></img> -->
                                            <?php
                                            if(!empty($dbImages[3])) {
                                                echo "<img id='item-display' alt='' src='$dbImages[3]'/>";
                                            }
                                            ?>
                                        </a>
                                    </center>
                                </div>


                                <div class="col-md-7">
                                    <div class="product-title">
                                        <?php echo $row["name"]; ?>
                                    </div>
                                    <div class="col-md-12" class="col-xs-12">
                                        <fieldset class="rating">
                                            <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                            <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                            <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                            <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                            <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                            <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                            <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                            <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                            <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                            <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                        </fieldset>
                                    </div>
                                    <div class="product-desc" class="col-md-12" class="col-xs-12">
                                        <?php echo $row["description"]; ?>
                                    </div>
                                    <hr>
                                    <div class="product-price">
                                        <?php echo "RM ".$row["price"]; ?>
                                    </div>
                                    <!--<div class="product-stock">In Stock</div>-->
                                    <hr>
                                    <div class="btn-group cart">
                                        <input type="hidden" name="prod_id" value="<?php echo $row['id'] ?>"/>
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
                                <li><a href="#service-two" data-toggle="tab">SELLER INFORMATION</a></li>
                                <li><a href="#service-three" data-toggle="tab">REVIEWS</a></li>

                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade in active" id="service-one">

                                    <section class="container product-info">
                                        <?php echo $row["description"]; ?>
                                    </section>

                                </div>
                                <div class="tab-pane fade" id="service-two">

                                    <section class="product-info">
                                        <?php echo $row["seller_id"]; ?>
                                    </section>

                                </div>
                                <div class="tab-pane fade" id="service-three">
                                    <section class="product-info">
                                        dunno need or not
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