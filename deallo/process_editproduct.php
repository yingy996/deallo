<?php
	require_once("dbcontroller.php");

	$success_message = "";
    $error_message = "";
	$isValid = true;
	$db_handle = new DBController();

	if (isset($_GET["productID"])) {
		$productId = $_GET["productID"];
	} else {
		header("location: myproducts.php");
	}
	
//Retrieving current product info from database
	$query = $db_handle->getConn()->prepare("SELECT * FROM products WHERE id = :productId");
	$query->bindParam(":productId", $productId);
	
	$query->execute();
	$result = $query->fetchAll();

	//check if product exists
	if(empty($result)) {
		$error_message = "Problem in retrieving product data! Please try again later.";
	} else {
		//Get the values of the product info to display it in the input fields
		$row = $result[0];
		
		//get shipping agents to check respective checkbox
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
		
		//retrieve image files
		$dbImages = explode("_,_", $row["img"]);
		$dbCurrentImg = $row["img"]; //used to add new images
	}


//Process update of product info when the user submit the form
	if(!empty($_POST["productSubmit"])){
	//Validation of inputs 
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

			//get uploaded image files
			$images = rearrangeFile($_FILES["img-input"]);
			$errors= array();

			$imageFileNames = ""; //to be stored in database
			
			//validate and upload all the images 
			foreach ($images as $image) {
				$file_name = sanitizeInput($image["name"]);
			  	$file_size = $image["size"];
		   		$file_tmp = $image["tmp_name"];
		   		//$file_type=$_FILES["img-input"]["type"];
		   		$dest_file = "productImages/" . basename($file_name);
		   		$tmp=explode(".",$image["name"]);
		   		$file_ext=strtolower(end($tmp));

				$expensions= array("jpeg","jpg","png");

		   		//validate image file size
			  	if($file_size > 2097152){
				  	$errors[] = "File size must be less than 2 MB";
				  	$error_message .= "File size must be less than 2 MB. ";
			  	} elseif ($file_size > 0) {
					//validate image file type
					if(in_array($file_ext,$expensions)=== false){
						$errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
						$error_message .= "Extension not allowed, please choose a JPEG or PNG file. ";
					}
					
					//upload the image file
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
				$query->bindParam(":image", $imageNames);

				$productName = sanitizeInput($_POST["productName"]);
				$productDesc = sanitizeInput($_POST["productDescription"]);
				$productCategory = $_POST["productCategory"];
				$productPrice = sanitizeInput($_POST["productPrice"]);
				$shippingFee = $_POST["productShippingPrice"];
				$modified = date("Y-m-d");
				if ($imageFileNames != "") {
					$imageNames = $dbCurrentImg . "_,_" . $imageFileNames;
				} else {
					$imageNames = $dbCurrentImg;
				}
				
				$query->execute();

				if($query->rowCount() > 0) {
					$success_message = "You have succesfully updated your product! This page will be refreshed to display the updated information.";
					header("refresh:2; url=editproduct.php?productID=$productId");
					//unset($_POST);
				} else {
					$error_message = "Problem in updating product. Please try again!";
					header("refresh:2; url=editproduct.php?productID=$productId");
				}
		   	}
       	}
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
?>