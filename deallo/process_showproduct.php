<?php 
	require_once("dbcontroller.php");
	$db_handle = new DBController();
    //Check product category of the product clicked by the user in header aka navigation bar
    $orderBy = "";
    $sort = "";
    $filter = "";
    $category = $_GET["category"];
    if($category == "all"){
        if(isset($_GET["sort"])){
            if($_GET["sort"] == "pricelowhigh"){
                $orderBy = " ORDER BY price ASC";
                $sort = "Sorted by price in ascending order";
            }else if($_GET["sort"] == "pricehighlow"){
                $orderBy = " ORDER BY price DESC";
                $sort = "Sorted by price in descending order";
            }else if($_GET["sort"] == "ratinglowhigh"){
                $orderBy = " ORDER BY rating ASC";
                $sort = "Sorted by rating in ascending order";
            }else if($_GET["sort"] == "ratinghighlow"){
                $orderBy = " ORDER BY rating DESC";
                $sort = "Sorted by rating in descending order";
            }
        }else{
            $orderBy = "";
            $sort = "";

        }

        $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products WHERE deleted = FALSE" . $orderBy);

        //price range and shipping fee filter
        if(!empty($_POST["filter"])){
            if(empty($_POST["minPrice"]) && empty($_POST["maxPrice"]) && isset($_POST["filterfreeShipping"])){
                $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img, rating FROM products WHERE deleted = FALSE AND shipping_fee = 0" . $orderBy);
                $filter = " || Free shipping";
            }else if(empty($_POST["minPrice"]) && empty($_POST["maxPrice"])){
                $error_message = "Price filter empty";
            }else if(empty($_POST["minPrice"])){
                $error_message = "minimum price empty";
            }else if(empty($_POST["maxPrice"])){
                $error_message = "maximum price empty";
            }

            if(!empty($_POST["minPrice"]) && !empty($_POST["maxPrice"])){
                $minPrice = $_POST["minPrice"];
                $maxPrice = $_POST["maxPrice"];
                
                if(isset($_POST["filterfreeShipping"])){
                     $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img, rating FROM products WHERE deleted = FALSE AND shipping_fee = 0 AND price BETWEEN '$minPrice' AND '$maxPrice'" . $orderBy);
                     $filter = " || RM" . $minPrice . " to RM" . $maxPrice . " || Free shipping"; 
                }else{
                    $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img, rating FROM products WHERE deleted = FALSE AND price BETWEEN '$minPrice' AND '$maxPrice'" . $orderBy);
                    $filter = " || RM" . $minPrice . " to RM" . $maxPrice; 
                }
            }   
        }


    } else{
        if(isset($_GET["sort"])){
            if($_GET["sort"] == "pricelowhigh"){
                $orderBy = " ORDER BY price ASC";
                $sort = "Sorted by price in ascending order";

            }else if($_GET["sort"] == "pricehighlow"){
                $orderBy = " ORDER BY price DESC";
                $sort = "Sorted by price in descending order";
            }else if($_GET["sort"] == "ratinglowhigh"){
                $orderBy = " ORDER BY rating ASC";
                $sort = "Sorted by rating in ascending order";
            }else if($_GET["sort"] == "ratinghighlow"){
                $orderBy = " ORDER BY rating DESC";
                $sort = "Sorted by rating in descending order";
            }
        }else{
            $orderBy = "";
            $sort = "";
        }

        $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img, rating FROM products WHERE category=:category AND deleted = FALSE" . $orderBy);

        //price range and shipping fee filter
        if(!empty($_POST["filter"])){

            if(empty($_POST["minPrice"]) && empty($_POST["maxPrice"]) && isset($_POST["filterfreeShipping"])){
                $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img, rating FROM products WHERE category=:category AND shipping_fee = 0" . $orderBy);
                $filter = " || Free shipping";
            }else if(empty($_POST["minPrice"]) && empty($_POST["maxPrice"])){
                $error_message = "Price filter empty";
            }else if(empty($_POST["minPrice"])){
                $error_message = "minimum price empty";
            }else if(empty($_POST["maxPrice"])){
                $error_message = "maximum price empty";
            }

            if(!empty($_POST["minPrice"]) && !empty($_POST["maxPrice"])){
                $minPrice = $_POST["minPrice"];
                $maxPrice = $_POST["maxPrice"];
                if(isset($_POST["filterfreeShipping"])){
                     $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img, rating FROM products WHERE (category=:category AND shipping_fee = 0) AND price BETWEEN '$minPrice' AND '$maxPrice'" . $orderBy);
                     $filter = " || RM" . $minPrice . " to RM" . $maxPrice . " || Free shipping"; 
                }else{
                    $query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img, rating FROM products WHERE category=:category AND price BETWEEN '$minPrice' AND '$maxPrice'" . $orderBy);
                    $filter = " || RM" . $minPrice . " to RM" . $maxPrice; 
                }
            }  


        }

    }


    $query->bindParam(":category", $category);
    $query->execute();
    $results = $query->fetchAll();

    if(!empty($results)){
        $success_message = $sort . $filter;
    }


?>
       
