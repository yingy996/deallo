<?php
	$success_message = "";
	$error_message = "";
	
	require_once("dbcontroller.php");
	$db_handle = new DBController();

//Shows customer orders
	//Get customer order details
//SELECT order_details.order_id, order_details.customer_id, order_details.order_date, order_details.status, order_details.status_date, order_details.order_price, products.name AS product_name, customer_order.product_quantity FROM order_details INNER JOIN customer_order ON order_details.order_id = customer_order.order_id INNER JOIN products ON customer_order.product_id = products.id WHERE order_details.seller_id = 'jonlau'
	
	$orderBy = " ORDER BY order_details.status_date DESC";
    $sort = "";
    $filter = "";
	
	if(isset($_GET["sort"])) {
		if($_GET["sort"] == "orderasc") {
			$orderBy = " ORDER BY order_details.order_date ASC";
			$success_message = "Sorted by 'Order date' in ascending order";
		} else if($_GET["sort"] == "orderdesc") {
			$orderBy = " ORDER BY order_details.order_date DESC";
			$success_message = "Sorted by 'Order date' in descending order";
		} else if($_GET["sort"] == "statusasc") {
			$orderBy = " ORDER BY order_details.status_date ASC";
			$success_message = "Sorted by 'Status date' in ascending order";
		} else if($_GET["sort"] == "statusdesc") {
			$orderBy = " ORDER BY order_details.status_date DESC";
			$success_message = "Sorted by 'Status date' in descending order";
		} 
	}

	if(isset($_GET["filter"])) {
		if($_GET["filter"] == "notpaid") {
			$filter = " AND order_details.status = 'Not paid'";
			$success_message = "Filtered by 'Order status' = Not paid";
		} else if($_GET["filter"] == "paid") {
			$filter = " AND order_details.status = 'Paid'";
			$success_message = "Filtered by 'Order status' = Paid";
		} else if($_GET["filter"] == "processing") {
			$filter = " AND order_details.status = 'Processing'";
			$success_message = "Filtered by 'Order status' = Processing";
		} else if($_GET["filter"] == "delivered") {
			$filter = " AND order_details.status = 'Delivered'";
			$success_message = "Filtered by 'Order status' = Delivered";
		} else if ($_GET["filter"] == "canceled") {
			$filter = " AND order_details.status = 'Canceled'";
			$success_message = "Filtered by 'Order status' = Canceled";
		}
	}


	$getOrderQuery = $db_handle->getConn()->prepare("SELECT order_details.order_id, order_details.seller_id, order_details.order_date, order_details.status, order_details.status_date, order_details.order_price FROM order_details  WHERE order_details.customer_id = :username" . $filter . $orderBy);
	$getOrderQuery->bindParam(":username", $login_user);
	
	$getOrderQuery->execute();
    $orderResult = $getOrderQuery->fetchAll();

	
?>