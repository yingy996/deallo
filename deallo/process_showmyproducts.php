<?php 
	require_once("dbcontroller.php");
	
	$db_handle = new DBController();
	$query = $db_handle->getConn()->prepare("SELECT id, name, category, price, seller_id, img FROM products WHERE seller_id = :username AND deleted = FALSE");

	$query->bindParam(":username", $login_user);
	$query->execute();
	$results = $query->fetchAll();
	
    if(isset($_GET["productID"])){
        $removeProductID = $_GET["productID"];
        //set deleted = true in products table
        $query2 = $db_handle->getConn()->prepare("UPDATE products SET deleted = TRUE WHERE id = :productID");
        $query2->bindParam(":productID", $removeProductID);
        $result2 = $query2->execute();
        
        //set deleted = true in corresponding rating table
        $query3 = $db_handle->getConn()->prepare("Update rating SET deleted = TRUE  WHERE product_id = :productID");
        $query3->bindParam(":productID", $removeProductID);
        $result3 = $query3->execute();

        
        if($result2 == true){
            $success_message = "Succesfully removed product.";
            redirect("myproducts.php");
        } else{
            $error_message = "Product Removal failure";
        }
    }

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