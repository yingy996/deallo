<?php
    
    $success_message = "";
    $error_message = "";

    if(!empty($_POST["productSubmit"])){
            /* Product Category validation */
        if(empty($_POST["productCategory"])){
            $error_message = "Product Category cannot be empty";
        }
       
       /* Product Name validation */
        if(empty($_POST["productName"])){
            $error_message = "Product Name cannnot be empty";
        }
       
       /* Product Description validation */
        if(empty($_POST["productDescription"])){
            $error_message = "Product Description cannot be empty";
        }
       
       /* Product Price validation */
        if(empty($_POST["productPrice"])){
            $error_message = "Product Price cannot be empty";
        }
       
       /* Shipping Price validation */
        if(empty($_POST["productShippingPrice"])){
            $error_message = "Shipping Price cannot be empty";
        }
       
       /* Shipping Agent validation */
        if(empty($_POST["shpgAgent"])){
            $error_message = "Please select at least one preferred shipping agent";
        }   

       if(isset($_FILES['img-input']) && (!isset($error_message))){

          $checkBox = implode(',',$_POST['shpgAgent']);
          $errors= array();
          $file_name = $_FILES['img-input']['name'];
          $file_size =$_FILES['img-input']['size'];
          $file_tmp =$_FILES['img-input']['tmp_name'];
          $file_type=$_FILES['img-input']['type'];
          $tmp=explode('.',$_FILES['img-input']['name']);
          $file_ext=strtolower(end($tmp));

          $expensions= array("jpeg","jpg","png");

          if(in_array($file_ext,$expensions)=== false){
             $errors[]="extension not allowed, please choose a JPEG or PNG file.";
          }

          if($file_size > 2097152){
             $errors[]='File size must be less than 2 MB';
          }

          if(empty($errors)==true){
             move_uploaded_file($file_tmp,"productImages/".$file_name);
             require_once("dbcontroller.php");
             $db_handle = new DBController();
             $query = "INSERT INTO products (id, image, product_name, product_description, product_price, shipping_price, shipping_agent, seller_information) VALUES (NULL,'" . $file_name . "', '" . $_POST["productName"] . "', '" . $_POST["productDescription"] . "', '" . $_POST["productPrice"] . "', '" . $_POST["productShippingPrice"] . "', '" . $checkBox . "', '" . "U HUEHUEHEUHEUHEUHEUHUE" . "')";
            $result = $db_handle->insertQuery($query);


              if(!empty($result)) {
                $error_message = "";
                $success_message = "You have succesfully added your product!";	
                unset($_POST);
            } else {
                $error_message = "Problem in adding product. Try Again!";	
            }
          }

       }
    }
?>