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
        if (!empty($_POST['prod_id'])) {
            $add_prodId = $_POST['prod_id'];
        } else {
            $add_prodId= '';
        }
        include("process_basket_item_add.php"); 
        //include("process_basket_item_remove.php"); 

        echo $add_prodId;
        ?>

        <!-- Body content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <p class="h3"> Shopping Basket </p>
                    <subtitle style="color:limegreen;"> <?php 
                            echo $success_message;
                        ?>
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
                                        <tr class="shoppingcart-product">
                                            <td class="col-sm-8 col-md-6">
                                                <div class="media">
                                                    <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
                                                    <div class="media-body">
                                                        <h4 class="media-heading"><a href="#">Product name</a></h4>
                                                        <h5 class="media-heading"> Seller: <a href="#">seller name</a></h5>
                                                        <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
                                                    </div>
                                                </div></td>
                                            <td class="col-sm-1 col-md-1" style="text-align: center">
                                                <input type="email" class="form-control" id="exampleInputEmail1" value="3">
                                            </td>
                                            <td class="col-sm-1 col-md-1 text-center"><strong>$4.87</strong></td>
                                            <td class="col-sm-1 col-md-1 text-center"><strong>$14.61</strong></td>
                                            <td class="col-sm-1 col-md-1">
                                                <button type="button" class="btn btn-danger">
                                                    <span class="glyphicon glyphicon-remove"></span> Remove
                                                </button></td>
                                        </tr>

                                        <tr>
                                            <td>   </td>
                                            <td>   </td>
                                            <td>   </td>
                                            <td><h5>Subtotal</h5></td>
                                            <td class="text-right"><h5><strong>$24.59</strong></h5></td>
                                        </tr>
                                        <tr>
                                            <td>   </td>
                                            <td>   </td>
                                            <td>   </td>
                                            <td><h5>Estimated shipping</h5></td>
                                            <td class="text-right"><h5><strong>$6.94</strong></h5></td>
                                        </tr>
                                        <tr>
                                            <td>   </td>
                                            <td>   </td>
                                            <td>   </td>
                                            <td><h3>Total</h3></td>
                                            <td class="text-right"><h3><strong>$31.53</strong></h3></td>
                                        </tr>
                                        <tr>
                                            <td>   </td>
                                            <td>   </td>
                                            <td>   </td>
                                            <td>
                                                <button type="button" class="btn btn-default">
                                                    <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                                                </button></td>
                                            <td>
                                                <button type="button" class="btn btn-success">
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