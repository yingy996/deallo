<?php
	require_once("dbcontroller.php");
	$success_message = "";
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
			
			//foreach seller, create an order with order details
			foreach ($sellerResult as $seller) {
				//Insert order details query
				$insertOrderQuery = $db_handle->getConn()->prepare("INSERT INTO order_details (order_id, customer_id, seller_id, order_date, status, status_date, order_price, shipping_address, recipient_name, recipient_contact) VALUES (:orderId, :customerId, :sellerId, :orderDate, :status, :statusDate, :orderPrice, :shipAddress, :recipientName, :recipientContact)");
				
				$insertOrderQuery->bindParam(":orderId", $order_id);
				$insertOrderQuery->bindParam(":customerId", $customer_id);
				$insertOrderQuery->bindParam(":sellerId", $seller_id);
				$insertOrderQuery->bindParam(":orderDate", $order_date);
				$insertOrderQuery->bindParam(":status", $status);
				$insertOrderQuery->bindParam(":statusDate", $status_date);
				$insertOrderQuery->bindParam(":orderPrice", $order_price);
				$insertOrderQuery->bindParam(":shipAddress", $shipping_address);
				$insertOrderQuery->bindParam(":recipientName", $recipient_name);
				$insertOrderQuery->bindParam(":recipientContact", $recipient_contact);
				
				//generate unique product id
				$order_id = generate_id();
				$isOrderIdUnique = false;

				do {
				   $selectQuery = $db_handle->getConn()->prepare("SELECT order_id FROM order_details WHERE order_id = :orderId");
				   $selectQuery->bindParam(":orderId", $order_id);

				   $selectQuery->execute();
				   $result = $selectQuery->fetchAll();

				   $total = count($result);

				   if($total == 0) {
					   $isOrderIdUnique = true;
				   } else {
					   $order_id = generate_id();
				   }
				} while(!$isOrderIdUnique);
				
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
				
				//EXECUTE QUERY to store order details
				$insertOrderQuery->execute();
				
				//If order details successfully inserted, continue to insert order item into customer_order table
				if($insertOrderQuery->rowCount() > 0) {
					$isAllSuccess = true;
					//Query to get shopping cart products of an order
					$getProductsQuery = $db_handle->getConn()->prepare("SELECT basket.id AS basket_id, basket.product_id AS product_id, basket.quantity AS quantity FROM basket INNER JOIN products ON basket.product_id = products.id WHERE basket.buyer_username = :username AND products.seller_id = :seller_id");
					$getProductsQuery->bindParam(":username", $login_user);
					$getProductsQuery->bindParam(":seller_id", $seller_id);
					$getProductsQuery->execute();
					$productsResult = $getProductsQuery->fetchAll();

					//For each of the product, insert it into customer_order table to record the order item
					foreach ($productsResult as $product) {
						$insertItemQuery = $db_handle->getConn()->prepare("INSERT INTO customer_order (order_id, product_id, product_quantity) VALUES (:order_id, :product_id, :product_quantity)");
						$insertItemQuery->bindParam(":order_id", $order_id);
						$insertItemQuery->bindParam(":product_id", $product_Id);
						$insertItemQuery->bindParam(":product_quantity", $product_Quantity);

						$product_Id = $product["product_id"];
						$product_Quantity = $product["quantity"];

						$insertItemQuery->execute();
						
						//delete ordered item from shopping cart
						$deleteCartQuery = $db_handle->getConn()->prepare("DELETE FROM basket WHERE id = :basket_id");
						$deleteCartQuery->bindParam(":basket_id", $basket_id);
						$basket_id = $product["basket_id"];
						
						$deleteCartQuery->execute();
						
						if ($insertItemQuery->rowCount() < 1) {
							$isAllSuccess = false;
						}
					}
					
					if ($isAllSuccess) {
						$success_message = "You have successfully placed your order!";
					} else {
						$error_message = "Problem in placing order. Please try again!";
					}
					
				} else {
					$error_message = "Problem in placing order. Please try again!";
				}
				
				
			}
			$insertQuery = $db_handle->getConn()->prepare("SELECT first_name, last_name, phone_number, address FROM user_account WHERE username = :username");
		} else {
			$error_message = "Input(s) is invalid! Please ensure inputs are valid";
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
?>