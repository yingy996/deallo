<?php
    include("dbcontroller.php");    
    $errorMsg = "";
    $resultMsg = "";

    if(isset($_POST["username"]) && isset($_POST["password"])){
        try{
            $db_handle = new DBController();
            $query = $db_handle->getConn()->prepare("SELECT id FROM user_account WHERE username = :username and password = :password");
            $query->bindParam(":username", $username);
            $query->bindParam(":password", $password);
            
            $username = sanitizeInput($_POST["username"]);
            $password = md5(sanitizeInput($_POST["password"]));
            
            $query->execute();
            $result = $query->fetchAll();
            
            $total = count($result);
            if($total > 0) {
                session_start();
                $_SESSION["user_login"] = $username;
                $test = $_SESSION["user_login"];
                
                header("refresh:2; url=index.html");
                $resultMsg = "Login successfully! You will be redirected soon. $test";
                
            } else {
                $errorMsg = "Invalid username or password. Please try again!";
            }
            
        } catch (PDOException $e) {
            $resultMsg = "Error: " . $e->getMessage();
        }
        
        /*$username = $db_handle->quote($_POST["username"]);
        $password = $db_handle->quote($_POST["password"]);
        $errorMsg = "";
        
        $query = "SELECT id FROM user_account WHERE username = '$username' and password = '$password'";
        
        $result = $db_handle->execQuery($query); 
        $rowCount = $result->num_rows;
        
        //user account successfully found
        if ($rowCount > 0) {
            session_register("username");
            $_SESSION["login_user"] = $username;
            
            header("location: index.php");
        } else {
            $errorMsg = "Your username or password is invalid. Please try again.";
        }*/
    }

    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }
?>