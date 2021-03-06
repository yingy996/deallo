<?php
//Shows the details of the checkout (e.g. shopping cart items, shipping address...)
	require_once("dbcontroller.php");

	$error_message = "";
	$db_handle = new DBController();
	
	//Get shopping basket details
	$query = $db_handle->getConn()->prepare("SELECT 
	b.id, b.product_id, b.quantity, b.date_added, 
	prod.name, prod.price, prod.shipping_fee, prod.seller_id, prod.img
	FROM basket b
	LEFT JOIN products prod on b.product_id = prod.id
	WHERE b.buyer_username = '".$login_user."'");

	$query->execute();
	$results = $query->fetchAll();

	//if there is no item to checkout, show error message
	if (count($results) == 0) {
		$error_message = "No item to checkout! Please continue shopping.";
	}

	//Get shipping details from user account
	$userDetailsQuery = $db_handle->getConn()->prepare("SELECT first_name, last_name, phone_number, address FROM user_account WHERE username = :username");
	$userDetailsQuery->bindParam(":username", $login_user);

	$userDetailsQuery->execute();
    $userDetailsResult = $userDetailsQuery->fetchAll();
	$user = $userDetailsResult[0];
?>