<!DOCTYPE html>
<html data-ng-app="moneySaver">
<head>
    <title>Money Saver</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initialscale=1.0"/>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/stylesheet.css" rel="stylesheet" />
    <script type="text/javascript" src="fusionChart/fusioncharts.js"></script>
    <script type="text/javascript" src="fusionChart/themes/fusioncharts.theme.ocean.js"></script>
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
        include("process_saleshistory.php");
        include("fusionChart/fusioncharts.php");
    
        //Graph rendering
        $columnChart = new FusionCharts("line", "ex1", "100%", 400, "graphmode", "json", '{  
            "chart": {
        "caption": "Total Revenues from 2008-2013",
        "numberprefix": "$",
        "bgcolor": "FFFFFF",
        "showalternatehgridcolor": "0",
        "plotbordercolor": "008ee4",
        "plotborderthickness": "3",
        "showvalues": "0",
        "divlinecolor": "CCCCCC",
        "showcanvasborder": "0",
        "tooltipbgcolor": "00396d",
        "tooltipcolor": "FFFFFF",
        "tooltipbordercolor": "00396d",
        "numdivlines": "2",
        "yaxisvaluespadding": "20",
        "anchorbgcolor": "008ee4",
        "anchorborderthickness": "0",
        "showshadow": "0",
        "anchorradius": "4",
        "chartrightmargin": "25",
        "canvasborderalpha": "0",
        "showborder": "0"
    },
    "data": [
        {
            "label": "2009",
            "value": "4400000",
            "color": "008ee4",
            "stepSkipped": false,
            "appliedSmartLabel": true
        },
        {
            "label": "2010",
            "value": "4800000",
            "color": "008ee4",
            "stepSkipped": false,
            "appliedSmartLabel": true
        },
        {
            "label": "2011",
            "value": "5500000",
            "color": "008ee4",
            "stepSkipped": false,
            "appliedSmartLabel": true
        },
        {
            "label": "2012",
            "value": "6700000",
            "color": "008ee4",
            "anchorradius": "7",
            "tooltext": "Historical high",
            "stepSkipped": false,
            "appliedSmartLabel": true
        },
        {
            "label": "2013",
            "value": "4200000",
            "color": "008ee4",
            "stepSkipped": false,
            "appliedSmartLabel": true
        }
    ]
        }');
        $columnChart->render();
    
    
    ?>
    
    <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <p class="h3"> Customer Orders </p>
                    <form action="" method="post">
                        <input type="submit" name="tablebutton" value="Table mode">
                    </form>
                    <form action="" method="post">
                        <input type="submit" name="graphbutton" value="Graph Mode">
                    </form>
                    
                    <?php if ($success_message != "") { ?>
						<p class="alert alert-success"><?php echo $success_message; ?></p> 
					<?php } ?>

					<?php if ($error_message != "") { ?>
						<p class="alert alert-danger"><?php echo $error_message; ?></p> 
					<?php } ?>
					
                    <hr/> 
                    <div class="container-fluid" id="tablemode" <?php if(isset($_POST["graphbutton"])){echo "style='display: none;'";}else{echo "";}?>>
                        <div class="row">
                            <div class="col-sm-12 col-md-10 col-md-offset-1">
								<?php
								if (count($orderResult) > 0) {
									foreach ($orderResult as $order) {
										//Get order items for this order
										$getItemQuery = $db_handle->getConn()->prepare("SELECT products.id AS productid, products.img, products.name AS product_name, products.price ,customer_order.product_quantity FROM customer_order INNER JOIN products ON customer_order.product_id = products.id WHERE customer_order.order_id = :order_id");
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
														<a class='thumbnail pull-left' href='productdetails.php?productID=". $item['productid'] ."'> 
														<img class='media-object' src='".$itemImg[0]."' style='width: 72px; height: 72px;'>
														</a>
														<div class='media-body'>
															<h4 class='media-heading'><a href='productdetails.php?productID=". $item['productid'] ."'>".$item['product_name']."</a></h4>
															<h5 class='media-heading'> Quantity: ".$item['product_quantity']."</h5>
															<h5 class='media-heading'> Unit price: ".$item['price']."</h5>
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
                    
                    <div id="graphmode" <?php if(isset($_POST["tablebutton"])){echo "style='display: none;'";}else{echo "";}?>>
                        
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
          <p class="text-center copyright"><em>Copyright &copy; 2017. All Rights reserved by Money Saver Sdn Bhd</em></p>
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