<!DOCTYPE html>
<html data-ng-app="moneySaver">
    <head>
        <title>Deallo Craft House</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initialscale=1.0"/>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/stylesheet.css" rel="stylesheet" />
        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
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
		include("process_basket_item_remove.php"); 
		include("process_basket_item_add.php"); 
        include("process_showcheckout.php");
		include("process_checkout.php");

        $remove_prodId = '';
        $geturl = "$_SERVER[REQUEST_URI]";
        //echo $geturl;
        

        if (isset($_GET['success']) ) {
            $success_message = $_GET['success'];
        }
        
        //echo $add_prodId;
        ?>

        <!-- Body content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <p class="h3"> Confirm Checkout  </p>

                    <hr/>
                    <subtitle style="color:limegreen;">  
                        <?php if(!empty($success_message)) { ?>	
                        <div class="alert alert-success">
                            <?php if(isset($success_message)) echo $success_message; ?></div>
                        <?php } ?>
                        <?php if(!empty($error_message) && empty($success_message)) { ?>	
                        <div class="alert alert-danger"><?php if(isset($error_message)) echo $error_message; ?></div>
                        <?php } ?>
                    </subtitle>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-10 col-md-offset-1">
                                <form method="post" role="form">
                                    <fieldset>
                                        <legend>Shopping Cart</legend>
									</fieldset>
								</form>
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
														<input type='text' readonly class='form-control' id='exampleInputEmail1' value='".$item['quantity']."'>
													</td>
													<td class='col-sm-1 col-md-1 text-center'><strong>RM ".$item['price']."</strong></td>
													<td class='col-sm-1 col-md-1 text-center'><strong>RM ". number_format((float)$item['quantity']*$item['price'], 2, '.', '') ."</strong></td>
													<td class='col-sm-1 col-md-1'>"; ?>
                                                <form method='post' action='process_basket_item_remove.php'>
                                                    <input type='hidden' name='remove_prodID' value='<?php echo $item['product_id']; ?>' />
                                                    <input type='hidden' name='url' value='<?php echo $geturl; ?>' />
                                                    <button type='submit' class='btn btn-danger'>
                                                        <span class='glyphicon glyphicon-remove'></span> Remove
                                                    </button>
                                                </form>
                                                <?php echo "</td>
												</tr>"; 

														$subtotal += $item['quantity']*$item['price'];
														$shippingtotal += $item['shipping_fee'];
													} 
												}
												?>
												<!-- Displaying prices -->
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
											</tbody>
										</table>
									
								<form name="frmCheckout" method="post" action="" novalidate role="form">
									<fieldset>
										<legend>Shipping Details</legend>
										<p class="text-muted"><em>* indicates the field is a required field</em></p>
										<div class="row">
											<div class="form-group col-xs-6">
												<label for="name">*Recipient Name:</label>
												<input type="text" class="form-control" id="name" name="name" data-ng-model="recipient.name" data-ng-pattern="/^[a-zA-Z ]*$/" data-ng-init="recipient.name='<?php echo $user["first_name"] . " " . $user["last_name"]; ?>'" required/>
											</div>
											
											<div class="form-group col-xs-6">
												<label for="contact">*Recipient Contact Number:</label>
												<input type="text" class="form-control" id="contact" name="contact" data-ng-model="recipient.contact" data-ng-pattern="/^[0-9]*$/" data-ng-init="recipient.contact='<?php echo $user["phone_number"]; ?>'" required/>
											</div>
											
											<!--Displaying errors: recipient name-->
											<p class="alert alert-danger" data-ng-show="frmCheckout.name.$error.required && frmCheckout.name.$touched">*Recipient name is required</p>

											<p class="alert alert-danger" data-ng-show="frmCheckout.name.$error.pattern && frmCheckout.name.$touched">Recipient name must be alphabetic</p>
											
											<!--Displaying errors: recipient contact-->
											<p class="alert alert-danger" data-ng-show="frmCheckout.contact.$error.required && frmCheckout.contact.$touched">*Recipient contact number is required</p>

											<p class="alert alert-danger" data-ng-show="frmCheckout.contact.$error.pattern && frmCheckout.contact.$touched">Recipient contact number must be numeric</p>
										</div>
										
										<div class="row">
											<div class="form-group col-xs-12">
												<label for="address">*Shipping Address:</label>
												<input type="text" id="address" data-ng-model="recipient.address" class="form-control" name="address" data-ng-pattern="/[\w',-\\/.\s]/" data-ng-init="recipient.address='<?php echo $user["address"]; ?>'" required/>
											</div> 

											<!--Displaying errors: address-->
											<p class="alert alert-danger" data-ng-show="frmCheckout.address.$error.required && frmCheckout.address.$touched">Shipping Address is required</p>
											
											<p class="alert alert-danger" data-ng-show="frmCheckout.address.$error.pattern && frmCheckout.address.$touched">Invalid shipping address</p>
										</div>
									</fieldset>
                                    <div id="checkoutcancel">
                                        <button type="button" class="btn btn-default" onclick="window.location.href='shoppingcart.php'">
                                            <span class="glyphicon glyphicon-shopping-cart"></span> Cancel
                                        </button>
									</div>
                                    <script>
                                        
                                        paypal.Button.render({

                                            env: 'sandbox', // sandbox | production

                                            // PayPal Client IDs - replace with your own
                                            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
                                            client: {
                                                sandbox:    'AfwOEf37FpiJVb8VlBx4C3-lrQei8DL45kZ8es6zu3vaH401FA1jg0Ud9AH9bhaNcHxGoRB2tkBAeuv5',
                                                production: '<insert production client id>'// none since this is for test
                                            },

                                            // Show the buyer a 'Pay Now' button in the checkout flow
                                            commit: true,

                                            // payment() is called when the button is clicked
                                            payment: function(data, actions) {

                                                // Make a call to the REST api to create the payment
                                                return actions.payment.create({
                                                    payment: {
                                                        transactions: [
                                                            {
                                                                amount: { total: '<?php echo $total; ?>', currency: 'MYR' }
                                                            }
                                                        ]
                                                    }
                                                });
                                            },

                                            // onAuthorize() is called when the buyer approves the payment
                                            onAuthorize: function(data, actions) {

                                                // Make a call to the REST api to execute the payment
                                                return actions.payment.execute().then(function() {
                                                    window.alert('Payment Complete!');

                                                    document.getElementById('userCheckout').click();

                                                });
                                            }

                                        }, '#paypal-button-container');
                                    </script>
                                    
                                    <div id="paypal-button-container"></div>
									<input type="submit" id="userCheckout" name="userCheckout" value="Checkout" class="btn btn-success"
                                           style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1"/>
 
								</form>
								
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