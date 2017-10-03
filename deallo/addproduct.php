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
<body data-ng-controller="imgUploadCtrl">
    <!-- Navigation Bar -->
    <?php 
        include("process_addproduct.php");
        include("header.php");
    ?>
    
    <div class="container-fluid">
        <div class="col-xs-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 col-xl-6 col-xl-offset-3">
            <?php if(!empty($success_message)) { ?>	

            <div class="alert alert-success">
                <?php 
                    if(isset($success_message)) {
                        echo $success_message;
                    } 
                ?>
            </div>
            <?php } ?>

            <?php if(!empty($error_message)) { ?>	
                <div class="alert alert-danger">
                    <?php 
                        if(isset($error_message)) {
                            echo $error_message;
                        } 
                    ?>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="h3">Add New Product</h1>
                    <hr/>
                    <div class="row">
                        <div class="col-xs-3">

                        </div>
                    </div>
                </div>
            </div>

            <form  name="frmProduct" method="post" action="" novalidate role="form" enctype="multipart/form-data">
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
                                        <input type="file" name="img-input" accept="image/jpeg, image/png" ng-model-instant onchange="angular.element(this).scope().getImgUrl(event)" multiple />
                                    </div>
                                </span>
                                <input type="text" class="form-control img-preview-url" disabled="disabled" placeholder="{{imgName}}"/>
                            </div>

                            <div data-ng-repeat="img in images">
                                <img class="uploadedImg" data-ng-src="{{img}}"/>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <label for="category">Category:</label>
                            <select class="form-control" id="category" data-ng-model="category" name="productCategory">
                                <option value="jw">Jewelry</option>
                                <option value="clthacc">Clothing &amp; accessories</option>
                                <option value="rd">Room decor</option>
                                <option value="wd">Wedding accessories</option>
                                <option value="va">Vintage arts</option>
                                <option value="ty">Toy</option>
                                <option value="cs">Craft supplies</option>
                                <option value="etc">Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="productName">Product name:</label>
                            <input type="text" class="form-control" id="productName" data-ng-model="productName" name="productName"/>
                        </div>
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
                                <input type="number" class="form-control" id="price" data-ng-model="price" name="productPrice"/> 
                            </div>
                        </div>
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
                            <input type="text" id="shpgfee" data-ng-model="shpgfee" class="form-control" name="productShippingPrice"/>
                        </div>
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
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="shpgAgent[1]" id="shpgAgent" data-ng-model="shpgAgent.poslaju" value="poslaju"/> Poslaju</label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="shpgAgent[2]" id="shpgAgent" data-ng-model="shpgAgent.abx" value="abx"/> ABX Express</label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="shpgAgent[3]" id="shpgAgent" data-ng-model="shpgAgent.gdex" value="gdex"/> GD Express</label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="shpgAgent[4]" id="shpgAgent" data-ng-model="shpgAgent.fedex" value="fedex"/> FedEx</label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="shpgAgent[5]" id="shpgAgent" data-ng-model="shpgAgent.ctlink" value="ctlink"/> City-Link</label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="shpgAgent[6]" id="shpgAgent" data-ng-model="shpgAgent.other" value=""/> Other <input type="text" name="otherSAgent" data-ng-model="otherSAgent"/> </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">

                        </div>
                    </div>
                </div>
            </div>
                <input type="submit" class="btn btn-default" value="Add product" name="productSubmit"/>
            </form>
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
    <script src="js/img-upload.js"></script>
</body>
</html>