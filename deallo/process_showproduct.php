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
                   $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img, rating FROM products WHERE deleted = FALSE ORDER BY rating ASC");


                }else if($_GET["sort"] == "ratinghighlow"){

                    $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img, rating FROM products WHERE deleted = FALSE ORDER BY rating DESC");

                }
            }else{
                    $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products WHERE deleted = FALSE ");

            }

            if(!empty($_POST["filter"])){
                if(empty($_POST["minPrice"])){
                    $error_message = "minimum price empty";
                }else if(empty($_POST["maxPrice"])){
                    $error_message = "maximum price empty";
                }else if(empty($_POST["minPrice"]) && empty($_POST["maxPrice"])){
                    $error_message = "Price filter empty";
                }

                if(!empty($_POST["minPrice"]) && !empty($_POST["maxPrice"])){
                    $minPrice = $_POST["minPrice"];
                    $maxPrice = $_POST["maxPrice"];
                    if(isset($_POST["filterfreeShipping"])){
                         $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products WHERE shipping_fee = 0 AND price BETWEEN '$minPrice' AND '$maxPrice'");
                    }else{

                    }
                }   
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
        
        function redirect($url)
        {
            if (!headers_sent())
            {    
                header('Location: '.$url);
                exit;
                }
            else
                {  
                echo '<script type="text/javascript">';
                echo 'window.location.href="'.$url.'";';
                echo '</script>';
                echo '<noscript>';
                echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
                echo '</noscript>'; exit;
            }
        }
?>
       
?>