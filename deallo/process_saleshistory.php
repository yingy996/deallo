<?php 
	$success_message = "";
	$error_message = "";
	
	require_once("dbcontroller.php");
	$db_handle = new DBController();
	require_once("dbcontroller.php");
	
	$db_handle = new DBController();
    $query = $db_handle->getConn()->prepare("SELECT order_details.order_id, order_details.customer_id, order_details.order_date, order_details.status, order_details.status_date, order_details.order_price FROM order_details WHERE order_details.seller_id = :username AND (order_details.status <> 'Canceled' AND order_details.status <> 'Not Paid') ORDER BY order_details.status_date DESC");
	$query->bindParam(":username", $login_user);

    $query->execute();
    $orderResult = $query->fetchAll();

    //Query to get monthly sales of user
    $monthlysalesquery = $db_handle->getConn()->prepare("SELECT YEAR(order_date) as SalesYear, MONTH(order_date) as SalesMonth, SUM(order_price) as TotalSales FROM order_details WHERE seller_id = :username AND order_date > DATE_SUB(now(), INTERVAL 12 MONTH) AND (status <> 'Canceled' AND status <> 'Not Paid') GROUP BY YEAR(order_date), MONTH(order_date) ORDER BY YEAR(order_date), MONTH(order_date) DESC");
    $monthlysalesquery->bindParam(":username", $login_user);
	
    $monthlysalesquery->execute();
    $monthlysalesqueryResult = $monthlysalesquery->fetchAll();

    
    $SalesYear = [];
    $SalesMonth = [];
    $TotalSales = [];
    $HighestSale = 0;
    $x = 0;
    //Get Each Row into array for graph display
    foreach($monthlysalesqueryResult as $row){
        
        $SalesYear[$x] = $row["SalesYear"];
        $SalesMonth[$x] = $row["SalesMonth"];
        $TotalSales[$x] = $row["TotalSales"];
        
        //Check for the month with the highest total sales
        if($HighestSale < $TotalSales[$x]){
            $HighestSale = $HighestSale + $TotalSales[$x];
            $HighestSaleMonth = $SalesMonth[$x];
        }
        
        $x = $x +1;
    }

	$lastMonth = count($SalesMonth)-1;

    
?>