<?php
require_once("dbcontroller.php");

$db_handle = new DBController();
$error_message = "";

// Retrieving product from database using product id
$query = $db_handle->getConn()->prepare("SELECT * FROM products WHERE id = :productId");
$query->bindParam(":productId", $productId);

// insert product id here
$productId = "WQY947";
$query->execute();
$result = $query->fetchAll();

if(empty($result)) {
    $error_message = "Problem in retrieving product data! Please try again later.";

} else {
    //Get the values of the product info to display it in the input fields
    $row = $result[0];
    $success_message = $row["category"];

    //get shipping agents to check respective checkbox
    $defaultAgents = array("poslaju", "abx", "gdex", "fedex", "ctlink");
    $shpgAgents = explode(",", $row["shipping_agents"]);
    $isOtherAgent = false;
    $otherAgent = "";
    foreach ($shpgAgents as $agent) {
        if (!in_array($agent, $defaultAgents)) {
            $isOtherAgent = true;
            $otherAgent = $agent;
            break;
        }
    }

    //retrieve image files
    $dbImages = explode("_,_", $row["img"]);
    $dbCurrentImg = $row["img"]; //used to add new images
}
/*
if (!empty($result[0])) {
    $query = $db_handle->getConn()->prepare("UPDATE products SET name = :productName , description = :productDesc, category = :productCategory, price = :productPrice, shipping_fee = :shippingFee, shipping_agents = :shippingAgents, seller_id = :sellerId, modified = :modified, img = :image WHERE id = :id");

    $query->bindParam(":id", $productId);
    $query->bindParam(":productName", $productName);
    $query->bindParam(":productDesc", $productDesc);
    $query->bindParam(":productCategory", $productCategory);
    $query->bindParam(":productPrice", $productPrice);
    $query->bindParam(":shippingFee", $shippingFee);
    $query->bindParam(":shippingAgents", $shippingAgents);
    $query->bindParam(":sellerId", $login_user);
    $query->bindParam(":modified", $modified);
    $query->bindParam(":image", $imageNames);

    $productName = sanitizeInput($_POST["productName"]);
    $productDesc = sanitizeInput($_POST["productDescription"]);
    $productCategory = $_POST["productCategory"];
    $productPrice = sanitizeInput($_POST["productPrice"]);
    $shippingFee = $_POST["productShippingPrice"];
    $modified = date("Y-m-d");
    if ($imageFileNames != "") {
        $imageNames = $dbCurrentImg . "_,_" . $imageFileNames;
    } else {
        $imageNames = $dbCurrentImg;
    }

    $query->execute();
}*/
?>