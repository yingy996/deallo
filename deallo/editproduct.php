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
<body data-ng-controller="addProductCtrl">
    <!-- Navigation Bar -->
    
    <?php 
		include("header.php");
		include("process_editproduct.php"); 
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
                                        <input type="file" name="img-input" accept="image/jpeg, image/jpg, image/png" ng-model-instant onchange="angular.element(this).scope().getImgUrl(event)" multiple/>
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
                            <select class="form-control" id="category" name="productCategory" required>
                                <option value="jewelry" <?php if($row['category'] == 'jewelry'){ echo 'selected="selected"'; }?>>Jewelry</option>
                                <option value="clothesNAccessories" <?php if($row['category'] == 'clothesNAccessories'){ echo 'selected="selected"'; }?>>Clothing &amp; accessories</option>
                                <option value="roomDecor" <?php if($row['category'] == 'roomDecor'){ echo 'selected="selected"'; }?>>Room decor</option>
                                <option value="weddingAccessories" <?php if($row['category'] == 'weddingAccessories'){ echo 'selected="selected"'; }?>>Wedding accessories</option>
                                <option value="vintageArts" <?php if($row['category'] == 'vintageArts'){ echo 'selected="selected"'; }?>>Vintage arts</option>
                                <option value="toy" <?php if($row['category'] == 'toy'){ echo 'selected="selected"'; }?>>Toy</option>
                                <option value="craftSupplies" <?php if($row['category'] == 'craftSupplies'){ echo 'selected="selected"'; }?>>Craft supplies</option>
                                <option value="etc" <?php if($row['category'] == 'etc'){ echo 'selected="selected"'; }?>>Others</option>
                            </select>
                        </div>
                        
                        <p class="alert alert-danger" data-ng-show="frmProduct.productCategory.$error.required && (frmProduct.productCategory.$touched || submitted)">*Product category is required</p>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="productName">Product name:</label>
                            <input type="text" class="form-control" id="productName" name="productName" value="<?php echo $row["name"]; ?>"required/>
                        </div>
                        
                        <p class="alert alert-danger" data-ng-show="frmProduct.productName.$error.required && (frmProduct.productName.$touched || submitted)" >*Product name is required</p>
                        
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="desc">Product description:</label>
                            <textarea id="desc" class="form-control" name="productDescription" rows="4" placeholder="Enter description for the product"><?php echo $row["description"]; ?></textarea>
                        </div>                            
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <label for="price">Price:</label>
                            <div class="input-group">
                                <div class="input-group-addon">RM</div>
                                <input type="number" class="form-control" id="price" name="productPrice" value="<?php echo $row["price"]; ?>" required/> 
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
                                <input type="number" class="form-control" id="shpgfee" name="productShippingPrice" value="<?php echo $row["shipping_fee"]; ?>" required/> 
                            </div>
                        </div>
                        
                        <p class="alert alert-danger" data-ng-show="frmProduct.productShippingPrice.$error.required && (frmProduct.productShippingPrice.$touched || submitted)" >*Shipping fee is required</p>
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
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="shpgAgent[]" id="shpgAgent" value="poslaju" <?php if(in_array("poslaju", $shpgAgents)){ echo "checked='checked'"; } ?>/> Poslaju</label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="shpgAgent[]" id="shpgAgent" value="abx" <?php if(in_array("abx", $shpgAgents)){ echo "checked='checked'"; } ?>/> ABX Express</label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="shpgAgent[]" id="shpgAgent" value="gdex" <?php if(in_array("gdex", $shpgAgents)){ echo "checked='checked'"; } ?>/> GD Express</label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="shpgAgent[]" id="shpgAgent" value="fedex" <?php if(in_array("fedex", $shpgAgents)){ echo "checked='checked'"; } ?>/> FedEx</label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="shpgAgent[]" id="shpgAgent" value="ctlink" <?php if(in_array("ctlink", $shpgAgents)){ echo "checked='checked'"; } ?>/> City-Link</label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="otherShpgAgent" id="shpgAgent" value="" <?php if($isOtherAgent){ echo "checked='checked'"; } ?>/> Other <input type="text" name="otherSAgent" value="<?php if($isOtherAgent){ echo $otherAgent; } ?>"/> </label>
                                    </div>
                                </div>
                            </div>
                        </div>
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