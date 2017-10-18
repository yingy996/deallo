<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_SESSION["user_login"])) {
        $login_user = $_SESSION["user_login"];
    }
    

    /*if(!isset($_SESSION["user_login"])) {
        header("location: login.php");
        exit;
    }*/
?>