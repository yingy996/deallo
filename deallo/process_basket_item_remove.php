<?php
require_once("dbcontroller.php");

$remove_prodId = "";
$success_message = "";
$error_message = "";
$result = "";

if (!empty($_POST['remove_prodID'])) {
    $remove_prodId = $_POST['remove_prodID'];
    echo $_POST['remove_prodID'];
}

if (!empty($remove_prodId)) {
    $db_handle = new DBController();

    $query = $db_handle->getConn()->prepare("SELECT product_id FROM basket WHERE product_id = '$remove_prodId'");
    
    $query->execute();
    $result = $query->fetchAll();
    
    if (!empty($result)) {
        $query = $db_handle->getConn()->prepare("DELETE FROM basket WHERE product_id = '$remove_prodId'");
        
        $query->execute();
    }
    
    header("Location: shoppingcart.php");
}
?>