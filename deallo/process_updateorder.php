<?php
require_once("dbcontroller.php");
require_once("header.php");

$orderID = "";
$update_status = "";
$update_trackingnum = "";
//$quantity = "";
$success_message = "";
$error_message = "";
$result = "";

if (isset($_POST['trackingnum']) && isset($_POST['status'])) {
    $orderID = $order["order_id"];
    $update_status = $_POST['status'];
    $update_trackingnum = $_POST['trackingnum'];
	
	//update database
	$updateOrderQuery = $db_handle->getConn()->prepare("UPDATE order_details SET tracking_number = :trackingNumber , status = :status, status_date = :status_date WHERE order_id = :id");

	$updateOrderQuery->bindParam(":trackingNumber", $update_trackingnum);
	$updateOrderQuery->bindParam(":status", $update_status);
	$updateOrderQuery->bindParam(":status_date", $status_date);
	$updateOrderQuery->bindParam(":id", $orderID);
	
	$status_date =  date("Y-m-d");
	$updateOrderQuery->execute();

	if($updateOrderQuery->rowCount() > 0) {
		$success_message = "Order has been successfully updated! This page will be refreshed soon.";	
		echo "<meta http-equiv='refresh' content='2'>";
	} else {
		$error_message = "Failed to update order. Please try again later. This page will be refreshed soon.";
	}
}

?>