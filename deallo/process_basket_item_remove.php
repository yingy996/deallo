<?php
require_once("dbcontroller.php");
require_once("header.php");

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

    $query = $db_handle->getConn()->prepare("SELECT product_id FROM basket WHERE product_id = '$remove_prodId' AND buyer_username = '$login_user'");
    
    $query->execute();
    $result = $query->fetchAll();
    
    if (!empty($result)) {
        $query = $db_handle->getConn()->prepare("DELETE FROM basket WHERE product_id = '$remove_prodId' AND buyer_username = '$login_user'");
        
        $query->execute();
        $success_message = "Product removed";
    }
    
    if (strpos($url, 'shoppingcart.php')) {
        header("Location: shoppingcart.php?success=$success_message");
        
    } elseif (strpos($url, 'checkoutdetails.php')) {
        header("Location: checkoutdetails.php?success=$success_message");
        
    }
    
}

?>