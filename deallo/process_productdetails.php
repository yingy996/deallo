<?php
	require_once("dbcontroller.php");

    //boolean to check if user rated or not
    $rated = false;

    $rating = 0.0;

    //Check product id of the product clicked by the user in productcategory.php
    if(isset($_GET["productID"])){
        $productId = $_GET["productID"];
    }



    $db_handle = new DBController();

    //Retrieving current product info from database
    $query = $db_handle->getConn()->prepare("SELECT name, description, category, price, shipping_fee, shipping_agents, seller_id, img FROM products WHERE id = :productId");
	$query->bindParam(":productId", $productId);
	//$productId = "PEO747";
	$query->execute();
	$result = $query->fetchAll();
    $productname = $result[0]["name"];

    //Retrieve seller information
    $retrievesellerquery = $db_handle->getConn()->prepare("SELECT * FROM user_account WHERE username = :seller_id");
    $retrievesellerquery->bindParam("seller_id", $result[0]["seller_id"]);
    $retrievesellerquery->execute();
    $sellerresult = $retrievesellerquery->fetchAll();
        

    //check if product exists
	if(empty($result)) {
		$error_message = "Problem in retrieving product data! Please try again later.";
	} else {
        //retrieve image files
		$dbImages = explode("_,_", $result[0]["img"]);
        
        //slice away the first element of the image array for use in the subimages for loop
		$dbImagesSliced = array_slice($dbImages, 1);
        
        //if rating column is not empty, get average
            $query2 = $db_handle->getConn()->prepare("SELECT CAST(AVG(rating.rating_value) AS DECIMAL(10,1)) AS rating_average FROM products INNER JOIN rating ON rating.product_id=products.id AND products.id = :productID");
            $query2->bindParam(":productID", $productId);
            $query2->execute();
            $result2 = $query2->fetchAll();
            
        
            
            //insert average rating into product rating column
            if($result2[0][0] != ""){
                
                $averageRating = $result2[0]["rating_average"];
                $queryInsertAverageRating = $db_handle->getConn()->prepare("UPDATE products SET rating = :rating WHERE id = :productID");
                $queryInsertAverageRating->bindParam(":rating", $averageRating);
                $queryInsertAverageRating->bindParam(":productID", $productId);
                $insertAverageQueryResult = $queryInsertAverageRating->execute();
            }
            
            
            if($result2[0][0] == "" ){ //means product has no rating
                if(!empty($_POST["ratingbutton"])){ //if rate button is pressed 
                    if(isset($_POST["rating"])){ // if rating already selected when rate button pressed
                        
                        //Insert into rating table
                        $rating = $_POST["rating"];
                        $ratingquery = $db_handle->getConn()->prepare("INSERT INTO rating (product_id, rater_username, rating_value) VALUES (:productId, :rater_username, :rating_value)");
                        $ratingquery->bindParam(":productId", $productId);
                        $ratingquery->bindParam(":rater_username", $login_user);
                        $ratingquery->bindParam(":rating_value", $rating);
                        $insertqueryresult = $ratingquery->execute();
                        

                        if($insertqueryresult = true){
                        $success_message = "You have successfully rated this product!";
                        echo "<meta http-equiv='refresh' content='0'>";
                        $rated = true;
                            
                        }else{
                            $error_message = "Failed to submit your rating.";
                        }
                    }else{
                        $error_message = "You have not selected a rating!";
                    }
                }
            }else{ //product already has rating
                
                
                //Check if user has rated before
                $checkUserRatedBefore = $db_handle->getConn()->prepare("SELECT * FROM rating  WHERE rater_username = :rater_username AND product_id = :productID");
                $checkUserRatedBefore->bindParam(":rater_username", $login_user);
                $checkUserRatedBefore->bindParam(":productID", $productId);
                $checkUserRatedBefore->execute();
                $userRateHistory = $checkUserRatedBefore->fetchAll();
                
                //if user rated before 
                if(count($userRateHistory) > 0){
                    $rating = $result2[0][0];
                    $rated = true; 
                    
                    
                }else{
                    $rated = false;
                    if(!empty($_POST["ratingbutton"])){
                        if(isset($_POST["rating"])){
                            $rating = $_POST["rating"];
                            $ratingquery = $db_handle->getConn()->prepare("INSERT INTO rating (product_id, rater_username, rating_value) VALUES (:productId, :rater_username, :rating_value)");
                            $ratingquery->bindParam(":productId", $productId);
                            $ratingquery->bindParam(":rater_username", $login_user);
                            $ratingquery->bindParam(":rating_value", $rating);
                            $insertqueryresult = $ratingquery->execute();
                            
                            
                            if($insertqueryresult = true){
                                $success_message = "You have successfully rated this product!";
                                echo "<meta http-equiv='refresh' content='0'>";
                                $rated = true;
                            }else{
                                $error_message = "Failed to submit your rating.";
                            }
                            
                        }else{
                        $error_message = "You have not selected a rating!";
                        }
                    }
                }
            }  
    }
?>