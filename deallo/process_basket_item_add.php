<?php
require_once("dbcontroller.php");

$success_message = "";
$error_message = "";
$result = "";

if (!empty($add_prodId)) {
    $db_handle = new DBController();

    $query = $db_handle->getConn()->prepare("SELECT id, name, description, category, price, shipping_fee, shipping_agents, seller_id, created, modified, img FROM products WHERE id = '$add_prodId'");

    $query->execute();
    $result = $query->fetchAll();

    if (!empty($result)) {
        $row = $result[0];

        $_id = $row["id"];
        $_name = $row["name"];
        $_description = $row["description"];
        $_category = $row["category"];
        $_price = $row["price"];
        $_shipping_fee = $row["shipping_fee"];
        $_shipping_agents = $row["shipping_agents"];
        $_seller_id = $row["seller_id"];
        $_date_added = date("Y-m-d");
        $_img = $row["img"];

        //retrieve image files
        $dbImages = explode("_,_", $row["img"]);
        $dbCurrentImg = $row["img"]; //used to add new images

        // Check if record already exist
        $check = $db_handle->getConn()->prepare("SELECT * FROM basket WHERE id = '$add_prodId'");
        $check->execute();
        $existed = $check->fetchAll();

        if (empty($existed)) {
            $query = $db_handle->getConn()->prepare("INSERT INTO basket(id, name, description, category, price, quantity, shipping_fee, shipping_agents, seller_id, data_added, img) 
            VALUES ('$_id', '$_name', '$_description', '$_category', '$_price', '1', '$_shipping_fee', '$_shipping_agents', '$_seller_id', '$_date_added', '$_img')");

            $query->execute();
        } else {
            // If record already existed update the quantity to be +1
            $query = $db_handle->getConn()->prepare("SELECT quantity FROM basket WHERE id = '$add_prodId'");

            $query->execute();
            $retrieve = $query->fetchAll();
            
            $getQuantity = $retrieve[0];
            $currentQuantity = $getQuantity["quantity"];
            $currentQuantity = $currentQuantity + 1;
            
            $updateQuantity = $db_handle->getConn()->prepare("UPDATE basket SET quantity = '$currentQuantity' WHERE id = '$add_prodId'");
            $updateQuantity->execute();
        }
    } 

    $check = $db_handle->getConn()->prepare("SELECT * FROM basket WHERE id = '$add_prodId'");
    $check->execute();
    $result = $check->fetchAll();

    if (!empty($result)) {
        echo "successfully added item to basket";
    } else {
        echo "failed to add item to basket";
    }

} else {
    $error_message = "Error: Product ID not found.";
}

?>