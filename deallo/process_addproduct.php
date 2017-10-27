<?php
    require_once("dbcontroller.php");

    $success_message = "";
    $error_message = "";
	$isValid = true;

    //When user clicked submit
    if(!empty($_POST["productSubmit"])){
            
        /* Shipping Agent validation */
        if(empty($_POST["shpgAgent"])){
            $error_message = "Please select at least one preferred shipping agent";
            $isValid = false;
        } 
        
        /* Shipping Price validation */
        /*if(empty($_POST["productShippingPrice"])){
            $error_message = "Shipping Price cannot be empty";
            $isValid = false;
        }*/
        
        /* Product Price validation */
        if(empty($_POST["productPrice"])){
            $error_message = "Product Price cannot be empty";
            $isValid = false;
        }
        
        /* Product Name validation */
        if(empty($_POST["productName"])){
            $error_message = "Product Name cannot be empty";
            $isValid = false;
        }
        
        /* Product Category validation */
        if(empty($_POST["productCategory"])){
            $error_message = "Product Category cannot be empty";
            
        }
        
       if(!empty($_FILES["img-input"])){
		   //get shipping agents
		   $shippingAgents = "";
		   if (isset($_POST["shpgAgent"])) {
			   $shippingAgents .= implode(",", $_POST["shpgAgent"]);
		   }
		   
		   if (isset($_POST["otherShpgAgent"])) {
			   $shippingAgents .= "," . sanitizeInput($_POST["otherSAgent"]);
		   }
		   $images = rearrangeFile($_FILES["img-input"]);
		   $errors= array();
		   
		   $imageFileNames = ""; //to be stored in database
		   //upload all the images 
		   foreach ($images as $image) {
			   $file_name = sanitizeInput($image["name"]);
			   $file_size = $image["size"];
			   $file_tmp = $image["tmp_name"];
			   //$file_type=$_FILES["img-input"]["type"];
			   $dest_file = "productImages/" . basename($file_name);
			   $tmp=explode(".",$image["name"]);
			   $file_ext=strtolower(end($tmp));

			   $expensions= array("jpeg","jpg","png");

			   if(in_array($file_ext,$expensions)=== false){
				   $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
				   $error_message .= "Extension not allowed, please choose a JPEG or PNG file. ";
			   }

			   if($file_size > 2097152){
				   $errors[] = "File size must be less than 2 MB";
				   $error_message .= "File size must be less than 2 MB. ";
			   } elseif ($file_size == 0) {
				   $errors[] = "Product image is required";
				   $error_message .= "Product image is required.";
			   }
			   
			   if(!move_uploaded_file($file_tmp, $dest_file)) {
				   $error_message = "There is an error uploading the file. Please try again." . $image["name"] . $image["tmp_name"];
				   $isValid = false;
			   } else {
				   if ($imageFileNames == "") {
					   $imageFileNames = $dest_file;
				   } else {
					   $imageFileNames .= "_,_" . $dest_file;
				   }
			   }
		   }
		   
		   /*$file_name = $_FILES["img-input"]["name"][0];
		   $file_size =$_FILES["img-input"]["size"];
		   $file_tmp =$_FILES["img-input"]["tmp_name"];
		   //$file_type=$_FILES["img-input"]["type"];
		   $dest_file = basename($file_name);
		   $tmp=explode(".",$_FILES["img-input"]["name"]);
		   $file_ext=strtolower(end($tmp));

		   $expensions= array("jpeg","jpg","png");

		   print_r($_FILES["img-input"]);
		   $error_message = $file_name[0];
		   if(in_array($file_ext,$expensions)=== false){
			   $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
			   $error_message .= "Extension not allowed, please choose a JPEG or PNG file. ";
		   }

		   if($file_size > 2097152){
			   $errors[] = "File size must be less than 2 MB";
			   $error_message .= "File size must be less than 2 MB. ";
		   } elseif ($file_size == 0) {
			   $errors[] = "Product image is required";
			   $error_message .= "Product image is required.";
		   }*/

		   if(empty($errors) && $isValid){ 
			   
			   //$success_message = $login_user;
			   //Upload product info into database
			   require_once("dbcontroller.php");

			   $db_handle = new DBController();
			   $query = $db_handle->getConn()->prepare("INSERT INTO products (id, name, description, category, price, shipping_fee, shipping_agents, seller_id, created, modified, img) VALUES (:id, :productName, :productDesc, :productCategory, :productPrice, :shippingFee, :shippingAgents, :sellerId, :created, :modified, :image)");

			   $query->bindParam(":productName", $productName);
			   $query->bindParam(":productDesc", $productDesc);
			   $query->bindParam(":productCategory", $productCategory);
			   $query->bindParam(":productPrice", $productPrice);
			   $query->bindParam(":shippingFee", $shippingFee);
			   $query->bindParam(":shippingAgents", $shippingAgents);
			   $query->bindParam(":sellerId", $login_user);
			   //$query->bindParam(":sellerId", $test);
			   $query->bindParam(":created", $created);
			   $query->bindParam(":modified", $modified);
			   $query->bindParam(":image", $imageFileNames);

			   $productName = sanitizeInput($_POST["productName"]);
			   $productDesc = sanitizeInput($_POST["productDescription"]);
			   $productCategory = $_POST["productCategory"];
			   $productPrice = sanitizeInput($_POST["productPrice"]);
			   $shippingFee = $_POST["productShippingPrice"];
			   $created = date("Y-m-d");
			   $modified = date("Y-m-d");
			   $test = "TestHuHU";

			   //generate unique product id
			   $productId = generate_id();
			   $isProductIdUnique = false;

			   do {
				   $selectQuery = $db_handle->getConn()->prepare("SELECT id FROM products WHERE id = :productId");
				   $selectQuery->bindParam(":productId", $productId);

				   $selectQuery->execute();
				   $result = $selectQuery->fetchAll();

				   $total = count($result);

				   if($total == 0) {
					   $isProductIdUnique = true;
				   } else {
					   $productId = generate_id();
				   }
			   } while(!$isProductIdUnique);

			   $query->bindParam(":id", $productId);

			   $query->execute();

			   if($query->rowCount() > 0) {
				   $success_message = "You have succesfully added your product!";	
				   unset($_POST);
			   } else {
				   $error_message = "Problem in adding product. Try Again!";	
			   }			   
		   }
       } else {
		   $error_message = $errors[0];
	   }
    }

	function generate_id(){
        $result = "";
        
        $letters = range("A", "Z");
        
        for ($i = 0; $i < 3; $i++){
            $result .= $letters[array_rand($letters)];
        }
        
        $numbers = range(0, 9);
        
        for ($i = 0; $i < 3; $i++){
            $result .= $numbers[array_rand($numbers)];
        }
        
        return $result;
    }

	//Credit: http://php.net/manual/en/features.file-upload.multiple.php
	function rearrangeFile(&$file){
		$file_arr = array();
		$file_count = count($file["name"]);
		$file_keys = array_keys($file);

		for ($i = 0; $i < $file_count; $i++) {
			foreach ($file_keys as $key) {
				$file_arr[$i][$key] = $file[$key][$i];
			}
		}

		return $file_arr;
	}
	/*function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }*/
?>