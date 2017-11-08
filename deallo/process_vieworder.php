<?php 
	$success_message = "";
	$error_message = "";
	if (isset($_GET["orderId"])) {
		$order_id = $_GET["orderId"];
	} else {
		header("location: mypurchases.php");
	}
	//$order_id = "HDE147";
	require_once("dbcontroller.php");

	$db_handle = new DBController();

	//get order details
	$getOrderQuery = $db_handle->getConn()->prepare("SELECT order_id, seller_id, order_date, status, status_date, order_price, recipient_name, recipient_contact, shipping_address,tracking_number FROM order_details WHERE customer_id = :username AND order_id = :order_id");

	$getOrderQuery->bindParam(":username", $login_user);
	$getOrderQuery->bindParam(":order_id", $order_id);
	$getOrderQuery->execute();

	$orderResult = $getOrderQuery->fetchAll();
	$order = $orderResult[0];


	//get products of the order
	$getItemQuery = $db_handle->getConn()->prepare("SELECT products.img, products.id, products.shipping_fee, products.name AS product_name, products.price ,customer_order.product_quantity FROM customer_order INNER JOIN products ON customer_order.product_id = products.id WHERE customer_order.order_id = :order_id");
	$getItemQuery->bindParam(":order_id", $orderId);
	$orderId = $order["order_id"];
	$getItemQuery->execute();
	$itemResult = $getItemQuery->fetchAll();

?>