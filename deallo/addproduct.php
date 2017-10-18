<?php
if(!empty($_POST["productSubmit"])){
            /* Product Category validation */
        if(empty($_POST["productCategory"])){
            $error_message = "Product Category cannot be empty";
        }
       
       /* Product Name validation */
        if(empty($_POST["productName"])){
            $error_message = "Product Name cannnot be empty";
        }
       
       /* Product Description validation */
        if(empty($_POST["productDescription"])){
            $error_message = "Product Description cannot be empty";
        }
       
       /* Product Price validation */
        if(empty($_POST["productPrice"])){
            $error_message = "Product Price cannot be empty";
        }
       
       /* Shipping Price validation */
        if(empty($_POST["productShippingPrice"])){
            $error_message = "Shipping Price cannot be empty";
        }
       
       /* Shipping Agent validation */
        if(empty($_POST["shpgAgent"])){
            $error_message = "Please select at least one preferred shipping agent";
        }   

   if(isset($_FILES['img-input']) && (!isset($error_message))){
       
      $checkBox = implode(',',$_POST['shpgAgent']);
      $errors= array();
      $file_name = $_FILES['img-input']['name'];
      $file_size =$_FILES['img-input']['size'];
      $file_tmp =$_FILES['img-input']['tmp_name'];
      $file_type=$_FILES['img-input']['type'];
      $tmp=explode('.',$_FILES['img-input']['name']);
      $file_ext=strtolower(end($tmp));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be less than 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"productImages/".$file_name);
         require_once("dbcontroller.php");
         $db_handle = new DBController();
         $query = "INSERT INTO products (id, image, product_name, product_description, product_price, shipping_price, shipping_agent, seller_information) VALUES (NULL,'" . $file_name . "', '" . $_POST["productName"] . "', '" . $_POST["productDescription"] . "', '" . $_POST["productPrice"] . "', '" . $_POST["productShippingPrice"] . "', '" . $checkBox . "', '" . "U HUEHUEHEUHEUHEUHEUHUE" . "')";
        $result = $db_handle->insertQuery($query);
          

          if(!empty($result)) {
			$error_message = "";
			$success_message = "You have succesfully added your product!";	
			unset($_POST);
		} else {
			$error_message = "Problem in adding product. Try Again!";	
		}
      }
      
   }
}
?>

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
    <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <!--3 bar icon-->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-to-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="#">Money Saver</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-to-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact us</a></li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Products <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Burger</a></li>
                            <li><a href="#">Appetizer</a></li>
                            <li><a href="#">Dessert</a></li>
                            <li><a href="#">Drink</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="btn disabled hidden-xs">|</a></li>
                    <li><a href="#">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid">
                    <?php if(!empty($success_message)) { ?>	
                    <div class="alert alert-success">
                    <?php if(isset($success_message)) echo $success_message; ?></div>
                    <?php } ?>
                    <?php if(!empty($error_message)) { ?>	
                    <div class="alert alert-danger"><?php if(isset($error_message)) echo $error_message; ?></div>
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