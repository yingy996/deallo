<?php
require_once("dbcontroller.php");

$db_handle = new DBController();
$query = $db_handle->getConn()->prepare("SELECT 
b.id, b.product_id, b.quantity, b.date_added, 
prod.name, prod.price, prod.shipping_fee, prod.seller_id, prod.img
FROM basket b
LEFT JOIN products prod on b.product_id = prod.id
WHERE b.buyer_username = '".$login_user."'");

$query->execute();
$results = $query->fetchAll();

?>