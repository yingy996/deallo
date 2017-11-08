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
        include("header.php"); 
        include("process_customerorders.php");
        ?>

        <!-- Body content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <p class="h3"> Customer Orders </p>
					<hr/> 
					<div class="row">
						<div class="col-xs-12">
							&nbsp;
							<!-- Sorting dropdown -->
							<span class="dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Sort <span class="caret"></span></button>

								<ul class="dropdown-menu">
									<li class="dropdown-header">Order Date</li>
									<li><a href="customerorders.php?sort=orderasc" class="dropdown-item">Ascending</a></li>
									<li><a href="customerorders.php?sort=orderdesc" class="dropdown-item">Descending</a></li>
									<li class="divider"></li>
									<li class="dropdown-header">Status Date</li>
									<li><a href="customerorders.php?sort=statusasc" class="dropdown-item">Ascending</a>
									<li><a href="customerorders.php?sort=statusdesc" class="dropdown-item">Descending</a></li>
								</ul>
							</span>
							
							<!-- Filter -->
							<span class="dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Filter <span class="caret"></span></button>

								<ul class="dropdown-menu">
									<li class="dropdown-header">Order Status</li>
									<li><a href="customerorders.php?filter=notpaid" class="dropdown-item">Not paid</a></li>
									<li><a href="customerorders.php?filter=paid" class="dropdown-item">Paid</a></li>
									<li><a href="customerorders.php?filter=processing" class="dropdown-item">Processing</a>
									<li><a href="customerorders.php?filter=delivered" class="dropdown-item">Delivered</a></li>
									<li><a href="customerorders.php?filter=canceled" class="dropdown-item">Canceled</a></li>
								</ul>
							</span>
							&nbsp;
							<a href="customerorders.php" alt="Reset sorting and filtering" class="btn btn-default">Reset</a>
						</div>
					</div>
					<br/>
                    <?php if ($success_message != "") { ?>
						<p class="alert alert-success"><?php echo $success_message; ?></p> 
					<?php } ?>

					<?php if ($error_message != "") { ?>
						<p class="alert alert-danger"><?php echo $error_message; ?></p> 
					<?php } ?>
					<br/>
                    
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12 col-md-10 col-md-offset-1">
								<?php
								if (count($orderResult) > 0) {
									foreach ($orderResult as $order) {
										//Get order items for this order
										$getItemQuery = $db_handle->getConn()->prepare("SELECT products.img, products.name AS product_name, products.price ,customer_order.product_quantity FROM customer_order INNER JOIN products ON customer_order.product_id = products.id WHERE customer_order.order_id = :order_id");
										$getItemQuery->bindParam(":order_id", $order_id);
										$order_id = $order["order_id"];
										$getItemQuery->execute();
										$itemResult = $getItemQuery->fetchAll();
										
										//display the table for this order
										echo '<table class="table table-hover ordertable">
											<thead>
												<tr class="active">
													<th colspan="2">Order: '. $order["order_id"] .' &nbsp; &nbsp; &nbsp;  Customer: '. $order["customer_id"] .'</th>
													<th class="text-right" colspan="2">Date placed: '.$order["order_date"].'</th>
												</tr>
											</thead>
											<tbody>';
										$index = 0;
										if (count($itemResult) > 0) {
											foreach ($itemResult as $item) {
												$itemImg = explode("_,_", $item["img"]);

												echo 
                                                "<tr class='shoppingcart-product'>
													<td class='col-sm-8 col-md-6'>
													<div class='media'>
														<a class='pull-left' href='#'> 
														<img class='img-thumbnail media-object' src='".$itemImg[0]."' style='width: 72px; height: 72px;'>
														</a>
														<div class='media-body'>
															<h4 class='media-heading'><a href='#'>".$item['product_name']."</a></h4>
															<h5 class='media-heading'> Quantity: ".$item['product_quantity']."</h5>
															<h5 class='media-heading'> Unit price: RM ".$item['price']."</h5>
														</div>
													</div>
													</td>
													<td class='col-sm-1 col-md-1' style='text-align: center'>
													<p><strong>Total Price:</strong></p>
														<p>".
														$item["product_quantity"] * $item["price"] 
														." </p>
													</td>";
												if ($index == 0) {
													echo "<td class='col-sm-1 col-md-1 text-center status-td' rowspan='". count($itemResult) ."'>
													<p><strong>Status:</strong></p>
													<p> ".$order['status']."</p>
													<p><strong>Status Date: </strong></p><p>". $order['status_date'] ." </p>
													</td>
													
													<td class='text-center col-sm-1 col-md-1' rowspan='". count($itemResult) ."'>
														<a href='manageorder.php?orderId=". $order["order_id"] ."' class='btn btn-success'>
															<span class='glyphicon glyphicon-edit'></span> Manage
														</a>
													</td>";
												}
													
												echo "</tr>"; 
												$index++;
											}
											
											echo 
												"<tr class='text-right'>
													<td colspan='4'>
														<p class='h5'>Total: &nbsp;RM ". $order["order_price"] ." <small>(inclu. postage)</small></p>
													</td>
												</tr>";
										}
										
										echo "</tbody>
                                			</table>";
										
									}
								}
                         
							?>
								
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