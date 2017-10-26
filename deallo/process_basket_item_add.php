<?php
require_once("dbcontroller.php");

//$currentUser= "";
/*
if (isset($_SESSION["user_login"])) {
    $db_handle = new DBController();
    //$currentUser= $_SESSION["user_login"];
    $query = $db_handle->getConn()->prepare("SELECT id, username FROM user_account WHERE username = '".$_SESSION["user_login"]."'");
    $query->execute();
    $getUsername = $query->fetchAll();
    $row = $getUsername[0];
    $login_user = $row["id"];
    echo $_SESSION["user_login"]." ".$login_user." ";
}*/

$success_message = "";
$error_message = "";
$result = "";

if (!empty($add_prodId) && !empty($login_user)) {
    $db_handle = new DBController();

    $query = $db_handle->getConn()->prepare("SELECT id, name, description, category, price, shipping_fee, shipping_agents, seller_id, created, modified, img FROM products WHERE id = '$add_prodId'");

    $query->execute();
    $result = $query->fetchAll();

    if (!empty($result)) {
        $row = $result[0];
 
        $_id = generateID(6);
        $_product_id = $row["id"];
        //$_name = $row["name"];
        //$_description = $row["description"];
        //$_category = $row["category"];
        //$_price = $row["price"];
        //$_shipping_fee = $row["shipping_fee"];
        //$_shipping_agents = $row["shipping_agents"];
        //$_seller_id = $row["seller_id"];
        $_buyer_username = $_SESSION["user_login"];
        $_date_added = date("Y-m-d");
        //$_img = $row["img"];

        //retrieve image files
        $dbImages = explode("_,_", $row["img"]);
        $dbCurrentImg = $row["img"]; //used to add new images

        // Check if record already exist
        $check = $db_handle->getConn()->prepare("SELECT * FROM basket WHERE product_id = '$add_prodId'");
        $check->execute();
        $existed = $check->fetchAll();

        if (empty($existed)) {
            $query = $db_handle->getConn()->prepare("INSERT INTO basket(id, product_id, quantity, buyer_username, date_added) VALUES ('$_id', '$_product_id', '1', '$_buyer_username', '$_date_added')");

            $query->execute();
            //$success_message .= "Added product item";
            
        } else {
            // If record already existed update the quantity to be +1
            $query = $db_handle->getConn()->prepare("SELECT quantity FROM basket WHERE product_id = '$add_prodId'");

            $query->execute();
            $retrieve = $query->fetchAll();

            $getQuantity = $retrieve[0];
            $currentQuantity = $getQuantity["quantity"];
            $currentQuantity = $currentQuantity + 1;

            $updateQuantity = $db_handle->getConn()->prepare("UPDATE basket SET quantity = '$currentQuantity' WHERE product_id = '$add_prodId'");
            $updateQuantity->execute();
            
            $success_message .= "Updated product quantity";
        }
    } 

    $check = $db_handle->getConn()->prepare("SELECT * FROM basket WHERE product_id = '$add_prodId'");
    $check->execute();
    $result = $check->fetchAll();

    if (!empty($result)) {
        $success_message = "successfully added item to basket";
    } else {
        $error_message = "failed to add item to basket";
    }

}

function generateID($length) {
    $random = '';
    for ($i = 0; $i < $length; $i++) {
        $random .= chr(rand(ord('0'), ord('9')));
    }
    return $random;
}
?>