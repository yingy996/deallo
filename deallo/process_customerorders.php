<?php
	$success_message = "";
	$error_message = "";
	
	require_once("dbcontroller.php");
	$db_handle = new DBController();

//Shows customer orders
	//Get customer order details
//SELECT order_details.order_id, order_details.customer_id, order_details.order_date, order_details.status, order_details.status_date, order_details.order_price, products.name AS product_name, customer_order.product_quantity FROM order_details INNER JOIN customer_order ON order_details.order_id = customer_order.order_id INNER JOIN products ON customer_order.product_id = products.id WHERE order_details.seller_id = 'jonlau'
	$getOrderQuery = $db_handle->getConn()->prepare("SELECT order_details.order_id, order_details.customer_id, order_details.order_date, order_details.status, order_details.status_date, order_details.order_price FROM order_details  WHERE order_details.seller_id = :username ORDER BY order_details.status_date DESC");
	$getOrderQuery->bindParam(":username", $login_user);
	
	$getOrderQuery->execute();
    $orderResult = $getOrderQuery->fetchAll();

	
?>