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
    <body data-ng-controller="shoppingBasketCtrl">
        <!-- Navigation Bar -->
        <?php 
        ob_start();
        include("header.php"); 
		include("process_showorderdetails.php");
		include("process_updateorder.php");
        //include("process_showcart.php");

        $remove_prodId = '';
        $geturl = "$_SERVER[REQUEST_URI]";
        //echo $geturl;
        //include("process_basket_item_add.php"); 
        //include("process_basket_item_remove.php"); 

        if (isset($_GET['success']) ) {
            $success_message = $_GET['success'];
        }
        
        if (isset($_GET['err']) ) {
            $error_message = $_GET['err'];
        }
        
        //echo $add_prodId;
        ?>

        <!-- Body content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <p class="h3"> Manage Order </p>
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
                                <h4>Order id: <?php echo $order["order_id"]; ?></h4>
								<hr/>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>&nbsp;
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //$index = 0;	
                                        $subtotal = 0;
                                        $shippingTotal = 0;
                                        $total = 0;
                                        if (count($itemResult) > 0) {
                                            foreach ($itemResult as $item) {
                                                $itemImg = explode("_,_", $item["img"]);
												$shippingTotal += $item['shipping_fee'];
												$subtotal += $item['product_quantity'] * $item['price'];
                                                echo 
                                                    "<tr class='shoppingcart-product'>
                                            <td class='col-sm-8 col-md-6'>
                                                <div class='media'>
                                                    <a class='thumbnail pull-left' href='#'> <!--<img class='media-object' src='http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png' style='width: 72px; height: 72px;'>-->
                                                    <img class='media-object' src='".$itemImg[0]."' style='width: 72px; height: 72px;'>
                                                    </a>
                                                    <div class='media-body'>
                                                        <h4 class='media-heading'><a href='#'>".$item['product_name']."</a></h4>
                                                        <h5 class='media-heading'> Product ID: ".$item['id']."</h5>
                                                        <h5 class='media-heading'> Shipping fee: RM ".$item['shipping_fee']."</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class='col-sm-1 col-md-1' style='text-align: center'>".$item['product_quantity']."</td>
                                            <td class='col-sm-1 col-md-1 text-center'><strong>RM ". $item['price'] ."</strong></td>
                                            <td class='col-sm-1 col-md-1 text-center'><strong>RM ".  number_format((float)$item['product_quantity']*$item['price']+$item['shipping_fee'], 2, '.', '') ."</strong></td>";
                                            echo "</tr>"; 
											}
											
											$total = $subtotal + $shippingTotal; 
											echo "<tr>
													<td colspan='4' class='text-right'><h4>Total:&nbsp;&nbsp; RM ". number_format((float)$total, 2, '.', '') ."</h4></td>
												</tr>";
										}
										
										?>
                                        <!--
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
                                        </tr> -->
                                        <!--        
                                        <tr>
                                            <td colspan="3"></td>
                                            <td class="text-right">
                                                <button type="button" class="btn btn-default" onclick="window.location.href='productcategory.php?category=all'">
                                                    <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                                                </button>
											</td>
                                            <td class="text-right"> 
                                                <button type="button" class="btn btn-success" onclick="window.location.href='checkoutdetails.php'">
                                                    Checkout <span class="glyphicon glyphicon-play"></span>
                                                </button>
											</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                                
                                <!-- Manage order form starts here -->
                                <div class='col-sm-12 col-md-12'>
								<h4>Shipping details</h4>
								<br/>
                                <table class='table' border='0'>
                                <form method="post" action="">
                                    <div class="row">
                                        <tr>
                                            <td class="col-sm-2 col-md-4">Recipient's Name :</td>
                                            <td class="col-sm-10 col-md-8"><?php echo $order["recipient_name"]; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td class="col-sm-2 col-md-4">Recipient's Contact Number :</td>
                                            <td class="col-sm-10 col-md-8"><?php echo $order["recipient_contact"]; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td class="col-sm-2 col-md-4">Recipient's Address :</td>
                                            <td class="col-sm-10 col-md-8"><?php echo $order["shipping_address"]; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td class="col-sm-2 col-md-4">Tracking Number :</td>
                                            <td class="col-sm-10 col-md-8">
                                                <input type='text' name='trackingnum' class='form-control' value="<?php echo $order["tracking_number"]; ?>" style='width: 180px;'>
                                            </td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td class="col-sm-2 col-md-4">Order Status :</td>
                                            <td class="col-sm-10 col-md-8">
                                                <select class='form-control' name='status' style='width: 180px;'>
                                                    <option value="Not Paid" <?php if($order["status"] == "Not Paid"){ echo "selected='selected'"; }?>>Not Paid</option>
                                                    <option value="Paid" <?php if($order["status"] == "Paid"){ echo "selected='selected'"; }?>>Paid</option>
                                                    <option value="Processing" <?php if($order["status"] == "Processing"){ echo "selected='selected'"; }?>>Processing</option>
                                                    <option value="Delivered" <?php if($order["status"] == "Delivered"){ echo "selected='selected'"; }?>>Delivered</option>
                                                    <option value="Canceled" <?php if($order["status"] == "Canceled"){ echo "selected='selected'"; }?>>Canceled</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td><button type='submit' class='btn productBtn'>Update</button> &nbsp;
                                            <button type='button' class='btn btn-default' onclick="window.location.href='customerorders.php'">Back</button>
                                            <td></td>
                                        </tr>
                                    </div>
                                    
                                </form>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>       
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
        <script src="js/app.js"></script>
    </body>
</html>