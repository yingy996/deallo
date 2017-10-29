<?php
require_once("dbcontroller.php");
require_once("header.php");

$prodID = "";
$quantity = "";
$success_message = "";
$error_message = "";
$result = "";

if (!empty($_POST['update_prodID'])) {
    $prodID = $_POST['update_prodID'];
    $quantity = $_POST['quantity'];
    echo $_POST['update_prodID']." ".$_POST['quantity'];
}

if (!empty($prodID)) {
    $db_handle = new DBController();

    $query = $db_handle->getConn()->prepare("SELECT product_id FROM basket WHERE product_id = '$prodID' AND buyer_username = '$login_user'");

    $query->execute();
    $result = $query->fetchAll();

    if (!empty($result) && $quantity >= 1) {
        $query = $db_handle->getConn()->prepare("UPDATE basket SET quantity= '$quantity' WHERE product_id = '$prodID' AND buyer_username = '$login_user'");

        $query->execute();
        $success_message = "Updated product quantity";

        header("Location: shoppingcart.php?success=$success_message");

    } elseif ($quantity < 1) {
        $error_message = "Quantity must be at least 1";
        header("Location: shoppingcart.php?err=$error_message");
        
    } else {
        $error_message = "Failed to update product quantity";
        header("Location: shoppingcart.php?err=$error_message");
        
    }

}

?>