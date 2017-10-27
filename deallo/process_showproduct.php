<?php 
	require_once("dbcontroller.php");
	$db_handle = new DBController();
    //Check product category of the product clicked by the user in header aka navigation bar
    
        $category = $_GET["category"];
        if($category == "all"){
            if(isset($_GET["sort"])){
                if($_GET["sort"] == "pricelowhigh"){
                    $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products WHERE deleted = FALSE ORDER BY price ASC");

                }else if($_GET["sort"] == "pricehighlow"){

                    $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products WHERE deleted = FALSE ORDER BY price DESC");
                }else if($_GET["sort"] == "ratinglowhigh"){
                   $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img, rating FROM products WHERE deleted = FALSE ORDER BY  rating ASC");


                }else if($_GET["sort"] == "ratinghighlow"){

                    $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img, rating FROM products WHERE deleted = FALSE ORDER BY  rating DESC");

                }
            }else{
                    $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products WHERE deleted = FALSE ");

            }


        } else{
            
            if($_GET["sort"] = "pricelowhigh"){
                $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products WHERE category=:category AND deleted = FALSE ORDER BY price ASC");
            }else if($_GET["sort"] == "pricehighlow"){
                $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products WHERE category=:category AND deleted = FALSE ORDER BY price DESC");
            }else if($_GET["sort"] == "ratinglowhigh"){
                $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img, rating FROM products WHERE category=:category AND deleted = FALSE ORDER BY rating ASC");
            }else if($_GET["sort"] == "ratinghighlow"){
                $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img, rating FROM products WHERE category=:category AND deleted = FALSE ORDER BY rating DESC");
            }else{
                $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products WHERE category=:category AND deleted = FALSE");
            }
            
        }
        $query->bindParam(":category", $category);
        $query->execute();
        $results = $query->fetchAll();
        
        
       
?>