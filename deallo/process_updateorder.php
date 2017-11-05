<?php
require_once("dbcontroller.php");
require_once("header.php");

$orderID = "";
$update_status = "";
$update_trackingnum = "";
//$quantity = "";
$success_message = "";
$error_message = "";
$result = "";

if (!empty($_POST['orderID']) && !empty($_POST['orderID']) && !empty($_POST['trackingnum'])) {
    $orderID = $_POST['orderID'];
    $update_status = $_POST['status'];
    $update_trackingnum = $_POST['trackingnum'];
    //$quantity = $_POST['quantity'];
    echo $_POST['orderID'];
}

if (empty($_POST['status'])) {
    $error_message = "Failed to update Order Status. Order Status is invalid.";
    header("Location: manageorder.php?err=$error_message");
}

if (empty($_POST['trackingnum'])) {
    $error_message = "Failed to update Tracking Number. Tracking Number is invalid.";
    header("Location: manageorder.php?err=$error_message");
}

if (!empty($orderID) && $error_message == "") {
    $db_handle = new DBController();

    $query = $db_handle->getConn()->prepare("SELECT * FROM order_details WHERE order_id = '$orderID' AND customer_id = '$login_user'");

    $query->execute();
    $result = $query->fetchAll();

    if (!empty($result)) {
        $query = $db_handle->getConn()->prepare("UPDATE basket SET status = '$update_status', tracking_number = '$update_trackingnum' WHERE order_id = '$orderID' AND buyer_username = '$login_user'");

        $query->execute();
        $success_message = "Updated Order ID: $orderID";

        header("Location: manageorder.php?orderID=$orderID&success=$success_message");

    } else {
        $error_message = "Failed to update order";
        header("Location: manageorder.php?orderID=$orderID&err=$error_message");

    }

} else {
    $error_message = "Error: Order ID cannot be found!";
    header("Location: manageorder.php?err=$error_message");

}

?>