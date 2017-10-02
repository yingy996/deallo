<?php
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
            $error_message = "Please at least one preferred shipping agent";
        }   

   if(isset($_FILES['image']) && (!isset($error_message))){
       
      $checkBox = implode(',',$_POST['shpgAgent']);
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"productImages/".$file_name);
         require_once("dbcontroller.php");
         $db_handle = new DBController();
         $query = "INSERT INTO products (id, image, product_name, product_description, product_price, shipping_price, shipping_agent, seller_information) VALUES (NULL,'" . $_POST[$file_name] . "', '" . $_POST["productName"] . "', '" . $_POST["productDescription"] . "', '" . $_POST["productPrice"] . "', '" . $_POST["productShippingPrice"] . "', '" . $_POST["shpgAgent"] . "', '" . $_POST["u...HUEHUEHUEHUEHUEHUEHUEHUEHUE"] . "')";
         $result = $db_handle->insertQuery($query); 
         echo "Success";
      }else{
         print_r($errors);
      }
   }
?>
