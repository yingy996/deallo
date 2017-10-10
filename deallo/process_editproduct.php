<?php
	require_once("dbcontroller.php");

	$success_message = "";
    $error_message = "";
	$isValid = true;

	$db_handle = new DBController();
	$query = $db_handle->getConn()->prepare("SELECT * FROM products WHERE id = :productId");
	$query->bindParam(":productId", $productId);
	$productId = "NLA557";
	$query->execute();
	$result = $query->fetchAll();

	//check if product exists
	if(empty($result)) {
		$error_message = "Problem in retrieving product data! Please try again later.";
	} else {
		//Get the values of the product info to display it in the input fields
		$row = $result[0];
		$success_message = $row["category"];
		
		$defaultAgents = array("poslaju", "abx", "gdex", "fedex", "ctlink");
		$shpgAgents = explode(",", $row["shipping_agents"]);
		$isOtherAgent = false;
		$otherAgent = "";
		foreach ($shpgAgents as $agent) {
			if (!in_array($agent, $defaultAgents)) {
				$isOtherAgent = true;
				$otherAgent = $agent;
				break;
			}
		}
	}

	if(!empty($_POST["productSubmit"])){
		/* Shipping Agent validation 
        if(empty($_POST["shpgAgent"])){
            $error_message = "Please select at least one preferred shipping agent";
        } */
        
        /* Shipping Price validation */
        if(empty($_POST["productShippingPrice"])){
            $error_message = "Shipping Price cannot be empty";
        }
        
        /* Product Price validation */
        if(empty($_POST["productPrice"])){
            $error_message = "Product Price cannot be empty";
        }
        
        /* Product Name validation */
        if(empty($_POST["productName"])){
            $error_message = "Product Name cannot be empty";
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
		   /*$file_name = $_FILES["img-input"]["name"];
		   $file_size =$_FILES["img-input"]["size"];
		   $file_tmp =$_FILES["img-input"]["tmp_name"];
		   //$file_type=$_FILES["img-input"]["type"];
		   $dest_file = "productImages/" . basename($file_name);
		   $tmp=explode(".",$_FILES["img-input"]["name"]);
		   $file_ext=strtolower(end($tmp));

		   $expensions= array("jpeg","jpg","png");

			if($file_size > 2097152){
			   $errors[] = "File size must be less than 2 MB";
			   $error_message .= "File size must be less than 2 MB. ";
		   } elseif ($file_size == 0) {
			   $errors[] = "Product image is required";
			   $error_message .= "Product image is required. ";
		   }
			
		   if(in_array($file_ext,$expensions)=== false){
			   $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
			   $error_message .= "Extension not allowed, please choose a JPEG or PNG file. ";
		   }*/

		   if(empty($errors) && $isValid){ 
			   
			   if(!move_uploaded_file($file_tmp, $dest_file)) {
				   $error_message = "There is an error uploading the file. Please try again. ";
			   } else {
				   //$success_message = $login_user;
				   //Upload product info into database
				   require_once("dbcontroller.php");

				   $db_handle = new DBController();
				   $query = $db_handle->getConn()->prepare("UPDATE products SET name = :productName , description = :productDesc, category = :productCategory, price = :productPrice, shipping_fee = :shippingFee, shipping_agents = :shippingAgents, seller_id = :sellerId, modified = :modified, img = :image WHERE id = :id");

				   $query->bindParam(":id", $productId);
				   $query->bindParam(":productName", $productName);
				   $query->bindParam(":productDesc", $productDesc);
				   $query->bindParam(":productCategory", $productCategory);
				   $query->bindParam(":productPrice", $productPrice);
				   $query->bindParam(":shippingFee", $shippingFee);
				   $query->bindParam(":shippingAgents", $shippingAgents);
				   $query->bindParam(":sellerId", $login_user);
				   $query->bindParam(":modified", $modified);
				   $query->bindParam(":image", $imageFileNames);

				   $productName = sanitizeInput($_POST["productName"]);
				   $productDesc = sanitizeInput($_POST["productDescription"]);
				   $productCategory = $_POST["productCategory"];
				   $productPrice = sanitizeInput($_POST["productPrice"]);
				   $shippingFee = $_POST["productShippingPrice"];
				   $modified = date("Y-m-d");

				   $query->execute();

				   if($query->rowCount() > 0) {
					   $success_message = "You have succesfully added your product!";	
					   unset($_POST);
				   } else {
					   $error_message = "Problem in adding product. Try Again!";
				   }
			   }

		   }
       }
	}

?>