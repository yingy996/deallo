<?php
    include("dbcontroller.php");    
    $errorMsg = "";
    $resultMsg = "";

    if(isset($_POST["username"]) && isset($_POST["password"])){
        try{
            $db_handle = new DBController();
            /* Get number of rows where user input username matches with those in database */
            $query = $db_handle->getConn()->prepare("SELECT id FROM user_account WHERE username = :username");
            
            $query->bindParam(":username", $username);
            
            $username = sanitizeInput($_POST["username"]);
            $query->execute();
            $result = $query->fetchAll();
            $total = count($result);
            
            
            
            
            
            
            if($total > 0) {
                /* Get the password hash of the username inputed by user */
                $query2 = $db_handle->getConn()->prepare("Select password FROM user_account WHERE username = :username");

                $query2->bindParam(":username", $username);

                $query2->execute();
                $result2 = $query2->fetchColumn();
                
                //plain text user input password
                $password = $_POST["password"];
                
                //takes plain text password and hashed string password from database user_account table as arguments, log in if matches
                if(password_verify($password, $result2)){
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }

                    $_SESSION["user_login"] = $username;

                    header("refresh:3; url=index.php");
                    $resultMsg = "Login successfully! You will be redirected soon.";
                } else {
                    $errorMsg = "Invalid password. Please try again!";
                }
                
            } else {
                $errorMsg = "Invalid username. Please try again!";
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