<?php

        //LATER CAN GET SESSION EMAIL OR SUMFING
        //$login_user = "woohoo";
        
        require_once("dbcontroller.php");
		$db_handle = new DBController();
		 $query = $db_handle->getConn()->prepare("SELECT * FROM user_account WHERE username = :username");
        $query->bindParam(":username", $login_user);
		$query->execute();
        $result = $query->fetchAll();
		if(!empty($result)) {
			$error_message = "";
			$success_message = "";
			unset($_POST);
		} else {
			$error_message = "Problem in retrieving user data! Please come back later";	
		}
	

?>
