<?php
	require_once("dbcontroller.php");

	$success_message = "";
    $error_message = "";

	$db_handle = new DBController();
	$query = $db_handle->getConn()->prepare("SELECT * FROM products WHERE id = :productId");
	$query->bindParam(":productId", $productId);
	$productId = "NLA557";
	$query->execute();
	$result = $query->fetchAll();

	//check if product exists
	if(empty($result)) {
		$error_message = "Problem in retrieving product data! Please try again later.";
	} else {
		$row = $result[0];
		$success_message = $row["category"];
		
		$defaultAgents = array("poslaju", "abx", "gdex", "fedex", "ctlink");
		$shpgAgents = explode(",", $row["shipping_agents"]);
		$isOtherAgent = false;
		//$otherAgent = "";
		foreach ($shpgAgents as $agent) {
			if (!in_array($agent, $defaultAgents)) {
				$isOtherAgent = true;
				$otherAgent = $agent;
				break;
			}
		}
	}

?>