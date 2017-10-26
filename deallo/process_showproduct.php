<?php 
	require_once("dbcontroller.php");
	$db_handle = new DBController();
    //Check product category of the product clicked by the user in header aka navigation bar
    if(isset($_GET["category"])){
        $category = $_GET["category"];
        
        if($_GET["sort"] = "pricelowhigh"){
            $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products WHERE category='$category' ORDER BY price ASC");
        }else if($_GET["sort"] = "pricehighlow"){
            $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products WHERE category='$category' ORDER BY price DESC");
        }else if($_GET["sort"] = "ratinglowhigh"){
            $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products WHERE category='$category' ORDER BY rating ASC");
        }else if($_GET["sort"] = "ratinghighlow"){
            $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products WHERE category='$category' ORDER BY rating DESC");
        }else{
            $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products WHERE category='$category'");
        }
        
        $query->execute();
        $results = $query->fetchAll();
        
    }else{
        if($_GET["sort"] = "lowhigh"){
            $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products ORDER BY price ASC");
        }else if($_GET["sort"] = "highlow"){
            $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products ORDER BY price DESC");
        }else if($_GET["sort"] = "ratinglowhigh"){
            $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products ORDER BY rating ASC");
        }else if($_GET["sort"] = "ratinghighlow"){
            $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM productsORDER BY rating DESC");
        }else{
            $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products");
        }
        

        
    }
    $query->execute();
    $results = $query->fetchAll();
?>