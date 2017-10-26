<?php 
	require_once("dbcontroller.php");
	
	$db_handle = new DBController();
	$query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products WHERE seller_id = :username");

	$query->bindParam(":username", $login_user);
	$query->execute();
	$results = $query->fetchAll();
	
?>