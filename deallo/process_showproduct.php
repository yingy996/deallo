<?php 
	require_once("dbcontroller.php");
	
	$query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products");

	$query->execute();
	$results = $query->fetchAll();

	$currentCol = 0;
	if(count($results) > 0) {
		echo "<table id='product-table'>";
		
		foreach($results as $row) {
			if ($currentCol == 3) {
				echo "<tr>";
			}
			
			echo "<td></td>";
			
			if ($currentCol == 3) {
				echo "</tr>";
				$currentCol = 0;
			} else {
				$currentCol++;
			}
		}
		
        echo "</table>";
	}
	
?>