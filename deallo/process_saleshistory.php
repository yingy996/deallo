<?php 
	$success_message = "";
	$error_message = "";
	
	require_once("dbcontroller.php");
	$db_handle = new DBController();
	require_once("dbcontroller.php");
	
	$db_handle = new DBController();
    $query = $db_handle->getConn()->prepare("SELECT order_details.order_id, order_details.customer_id, order_details.order_date, order_details.status, order_details.status_date, order_details.order_price FROM order_details WHERE order_details.seller_id = :username ORDER BY order_details.status_date DESC");
	$query->bindParam(":username", $login_user);

    $query->execute();
    $orderResult = $query->fetchAll();

    $monthlysalesquery = $db_handle->getConn()->prepare("SELECT YEAR(status_date) as SalesYear, MONTH(status_date) as SalesMonth, SUM(order_price) as TotalSales FROM order_details WHERE status_date > DATE_SUB(now(), INTERVAL 12 MONTH) GROUP BY YEAR(status_date), MONTH(status_date) ORDER BY YEAR(status_date), MONTH(status_date)");

    $monthlysalesquery->execute();
    $monthlysalesqueryResult = $monthlysalesquery->fetchAll();

?>