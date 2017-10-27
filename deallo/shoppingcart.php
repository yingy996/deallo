<!DOCTYPE html>
<html data-ng-app="moneySaver">
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
    <body data-ng-controller="shoppingBasketCtrl">
        <!-- Navigation Bar -->
        <?php 
        include("header.php"); 
        include("process_showcart.php");

        if (!empty($_POST['prod_id'])) {
            $add_prodId = $_POST['prod_id'];
            header("Refresh:1");
        } else {
            $add_prodId= '';
        }

        include("process_basket_item_add.php"); 
        //include("process_basket_item_remove.php"); 

        //echo $add_prodId;
        ?>

        <!-- Body content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <p class="h3"> Shopping Basket </p>
                    <subtitle style="color:limegreen;">  
                        <?php if(!empty($success_message)) { ?>	
                        <div class="alert alert-success">
                        <?php if(isset($success_message)) echo $success_message; ?></div>
                        <?php } ?>
                        <?php if(!empty($error_message)) { ?>	
                        <div class="alert alert-danger"><?php if(isset($error_message)) echo $error_message; ?></div>
                        <?php } ?>
                    </subtitle>
                    <hr/>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-10 col-md-offset-1">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Total</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //$index = 0;	
                                        $subtotal = 0;
                                        $shippingtotal = 0;
                                        $total = 0;
                                        if (count($results) > 0) {
                                            foreach ($results as $item) {
                                                $itemImg = explode("_,_", $item["img"]);

                                                echo 
                                                    "<tr class='shoppingcart-product'>
                                            <td class='col-sm-8 col-md-6'>
                                                <div class='media'>
                                                    <a class='thumbnail pull-left' href='#'> <!--<img class='media-object' src='http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png' style='width: 72px; height: 72px;'>-->
                                                    <img class='media-object' src='".$itemImg[0]."' style='width: 72px; height: 72px;'>
                                                    </a>
                                                    <div class='media-body'>
                                                        <h4 class='media-heading'><a href='#'>".$item['name']."</a></h4>
                                                        <h5 class='media-heading'> Seller: <a href='#'>".$item['seller_id']."</a></h5>
                                                        <h6 class='media-heading'> Date added: ".$item['date_added']."</h6>
                                                        <!--<span>Status: </span><span class='text-success'><strong>In Stock</strong></span> -->
                                                    </div>
                                                </div>
                                            </td>
                                            <td class='col-sm-1 col-md-1' style='text-align: center'>
                                                <input type='email' class='form-control' id='exampleInputEmail1' value='".$item['quantity']."'>
                                            </td>
                                            <td class='col-sm-1 col-md-1 text-center'><strong>RM ".$item['price']."</strong></td>
                                            <td class='col-sm-1 col-md-1 text-center'><strong>RM ". number_format((float)$item['quantity']*$item['price'], 2, '.', '') ."</strong></td>
                                            <td class='col-sm-1 col-md-1'>
                                                <button type='button' class='btn btn-danger'>
                                                    <span class='glyphicon glyphicon-remove'></span> Remove
                                                </button>
                                            </td>
                                        </tr>"; 
                                                $subtotal += $item['quantity']*$item['price'];
                                                $shippingtotal += $item['shipping_fee'];
                                            } 
                                        }
                                        ?>

                                        <tr>
                                            <td colspan="3"></td>
                                            <td><h5>Subtotal</h5></td>
                                            <td class="text-right"><h5><strong><?php echo "RM ".number_format((float)$subtotal, 2, '.', ''); ?></strong></h5></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td><h5>Estimated shipping</h5></td>
                                            <td class="text-right"><h5><strong><?php echo "RM ".number_format((float)$shippingtotal, 2, '.', ''); ?></strong></h5></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td><h4>Total</h4></td>
                                            <td class="text-right"><h4><strong>RM <?php $total = $subtotal + $shippingtotal; 
                                                echo number_format((float)$total, 2, '.', ''); ?></strong></h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>
                                                <button type="button" class="btn btn-default" onclick="window.location.href='productcategory.php'">
                                                    <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                                                </button></td>
                                            <td> 
                                                <button type="button" class="btn btn-success" onclick="window.location.href='checkoutdetails.php'">
                                                    Checkout <span class="glyphicon glyphicon-play"></span>
                                                </button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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