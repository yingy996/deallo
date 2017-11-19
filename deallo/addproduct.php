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
<body data-ng-controller="addProductCtrl">
    <!-- Navigation Bar -->
    
    <?php 
		include("header.php");
		include("process_addproduct.php"); 
    ?>
    
    <div class="container-fluid">
        <div class="col-xs-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 col-xl-6 col-xl-offset-3">
            <?php if ($success_message != "") { ?>
            	<p class="alert alert-success"><?php echo $success_message; ?></p> 
			<?php } ?>
            
            <?php if ($error_message != "") { ?>
            	<p class="alert alert-danger"><?php echo $error_message; ?></p> 
			<?php } ?>
            
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="h3">Add New Product</h1>
                    <hr/>
                </div>
            </div>

            <form name="frmProduct" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" data-ng-submit="productSubmit($event)" novalidate role="form" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="h4">Product Information</h2>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="input-group img-preview">
                                <span class="input-group-btn">

                                    <div class="btn btn-default img-upload">
                                        <span class="glyphicon glyphicon-folder-open"></span>
                                        Browse
                                        <!--<input type="file" accept="image/jpeg, image/png" name="img-input" onchange="getImgUrl(event);"/> -->
                                        <input type="file" name="img-input[]" accept="image/jpeg, image/jpg, image/png" ng-model-instant onchange="angular.element(this).scope().getImgUrl(event)" multiple/>
                                    </div>
                                </span>
                                <input type="text" class="form-control img-preview-url" disabled="disabled" placeholder="{{imgName}}"/>
								
                            </div>

                            <div data-ng-repeat="img in images">
                                <img class="uploadedImg" data-ng-src="{{img}}"/>
                            </div>

                        </div>
						
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-xs-12">
                            <label for="category">Category:</label>
                            <select class="form-control" id="category" data-ng-model="category" name="productCategory" required>
                                <option value="jewelry">Jewelry</option>
                                <option value="clothesNAccessories">Clothing &amp; accessories</option>
                                <option value="roomDecor">Room decor</option>
                                <option value="weddingAccessories">Wedding accessories</option>
                                <option value="vintageArts">Vintage arts</option>
                                <option value="toy">Toy</option>
                                <option value="craftSupplies">Craft supplies</option>
                                <option value="etc">Others</option>
                            </select>
                        </div>
                        
                        <p class="alert alert-danger" data-ng-show="frmProduct.productCategory.$error.required && (frmProduct.productCategory.$touched || submitted)">*Product category is required</p>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="productName">Product name:</label>
                            <input type="text" class="form-control" id="productName" data-ng-model="productName" name="productName" value="<?php if(isset($_POST["productName"])) echo $_POST["productName"]; ?>"required/>
                        </div>
                        
                        <p class="alert alert-danger" data-ng-show="frmProduct.productName.$error.required && (frmProduct.productName.$touched || submitted)" >*Product name is required</p>
                        
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="desc">Product description:</label>
                            <textarea id="desc" data-ng-model="desc" class="form-control" name="productDescription" rows="4" placeholder="Enter description for the product"></textarea>
                        </div>                            
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <label for="price">Price:</label>
                            <div class="input-group">
                                <div class="input-group-addon">RM</div>
                                <input type="number" class="form-control" id="price" data-ng-model="price" name="productPrice" required/> 
                            </div>                                           
                        </div>
                        
                        <p class="alert alert-danger" data-ng-show="frmProduct.productPrice.$error.required && (frmProduct.productPrice.$touched || submitted)" >*Product price is required</p>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <br/>
                            <h2 class="h4">Shipping Information</h2>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="shpgFee">Shipping fee:</label>
                            <div class="input-group">
                                <div class="input-group-addon">RM</div>
                                <input type="number" class="form-control" id="shpgfee" data-ng-model="shpgfee" name="productShippingPrice"/> 
                            </div>
                        </div>
                        
                        <!--<p class="alert alert-danger" data-ng-show="frmProduct.productShippingPrice.$error.required && (frmProduct.productShippingPrice.$touched || submitted)" >*Shipping fee is required</p>-->
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-12">
                                    <p><strong>Shipping agent:</strong></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 form-group">
                                    <div class="form-check">
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="shpgAgent[]" id="shpgAgent" data-ng-model="shpgAgent[0]" value="poslaju"/> Poslaju</label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="shpgAgent[]" id="shpgAgent" data-ng-model="shpgAgent[1]" value="abx"/> ABX Express</label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="shpgAgent[]" id="shpgAgent" data-ng-model="shpgAgent[2]" value="gdex"/> GD Express</label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="shpgAgent[]" id="shpgAgent" data-ng-model="shpgAgent[3]" value="fedex"/> FedEx</label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="shpgAgent[]" id="shpgAgent" data-ng-model="shpgAgent[4]" value="ctlink" /> City-Link</label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="otherShpgAgent" id="shpgAgent"/> Other <input type="text" name="otherSAgent" data-ng-model="otherSAgent"/> </label>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<!--<p class="alert alert-danger" data-ng-show="!checkAgents() && (frmProduct.shpgAgent.$touched || submitted)" >*At least one shipping agent is required</p>-->
                    </div>

                </div>
            </div>
                <input type="submit" class="btn btn-default" value="Add product" name="productSubmit"/>
            </form>
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
    <script src="js/img-upload.js"></script>
</body>
</html>