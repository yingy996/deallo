<?php
	require_once("dbcontroller.php");

	$isValid = true;
	$db_handle = new DBController();

	//if user submit the checkout form
	if(!empty($_POST["userCheckout"])) {
		
		if(empty($_POST["name"])) {
			$error_message = "Please enter the recipient name";
			$isValid = false;
		}
		
		if(empty($_POST["contact"])) {
			$error_message = "Please enter the recipient contact number";
			$isValid = false;
		}
		
		if(empty($_POST["address"])) {
			$error_message = "Please enter the shipping address";
			$isValid = false;
		}
		
		if($isValid) {
			//get seller of products
			$getSellerQuery = $db_handle->getConn()->prepare("SELECT DISTINCT products.seller_id AS seller_id FROM products INNER JOIN basket ON basket.product_id = products.id WHERE basket.buyer_username = :username");
			$getSellerQuery->bindParam(":username", $login_user);
			$getSellerQuery->execute();
			$sellerResult = $getSellerQuery->fetchAll();
			
			$error_message = $sellerResult[0]["seller_id"];
			//foreach seller, create an order with order details
			foreach ($sellerResult as $seller) {
				$order_id = generate_id();
				$customer_id = $login_user;
				$seller_id = $seller["seller_id"];
				$order_date = date("Y-m-d");
				$status = "Not paid";
				$status_date = date("Y-m-d");
				$shipping_address = sanitizeInput($_POST["address"]);
				$recipient_name = sanitizeInput($_POST["name"]);
				$recipient_contact = sanitizeInput($_POST["contact"]);
				
				//get order price
				$getPriceQuery = $db_handle->getConn()->prepare("SELECT SUM(((basket.quantity * products.price) + products.shipping_fee)) AS order_price FROM products INNER JOIN basket ON basket.product_id = products.id WHERE products.seller_id = :seller_id");
				$getPriceQuery->bindParam(":seller_id", $seller_id);
				$getPriceQuery->execute();
				$priceResult = $getPriceQuery->fetchAll();
				$order_price = $priceResult[0]["order_price"];
				
				
			}
			//insert order details into order details table
			
			//foreach order, insert all the items into the customer order
			
			//delete shopping cart items
			$insertQuery = $db_handle->getConn()->prepare("SELECT first_name, last_name, phone_number, address FROM user_account WHERE username = :username");
		} else {
			$error_message = "Something";
		}
	} else {
		$error_message = "No submit";
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
?>