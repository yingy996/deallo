<?php
require_once("dbcontroller.php");

$url = "";
$remove_prodId = "";
$success_message = "";
$error_message = "";
$result = "";

if (!empty($_POST['remove_prodID'])) {
    $remove_prodId = $_POST['remove_prodID'];
    $url = $_POST['url'];
    echo $_POST['remove_prodID'].$_POST['url'];
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
    
    if ($url == "/deallo/deallo/shoppingcart.php") {
        header("Location: shoppingcart.php");
    } elseif ($url == "/deallo/deallo/checkoutdetails.php") {
        header("Location: checkoutdetails.php");
    }
    
}
?>