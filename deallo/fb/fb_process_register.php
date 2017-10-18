<?php
$error = false;


/* Check if Facebook succesfully retrieve first_name */
if(empty($user['first_name'])){
    $error = true;
}

/* Check if Facebook succesfully retrieve last_name */
if(empty($user['last_name'])){
    $error = true;
}

/* Check if Facebook succesfully retrieve email */
if(empty($user['email'])){
    $error = true;
}

if($error !== true) {
    require_once("../dbcontroller.php");
    $db_handle = new DBController();

    /* Check if an account with similar email existed in database */
    $query = "SELECT * FROM user_account WHERE email = '" . $user['email'] . "'";
    $dupli = $db_handle->runQuery($query);

    if(empty($dupli)) {

        $query = "INSERT INTO user_account (id, email, first_name, last_name, username, password, phone_number, address, country, state, city, postcode) VALUES
		(NULL,'" . $user['email'] . "', '" . $user['first_name'] . "', '" . $user['last_name'] . "', '" . NULL . "', '" . md5($user['id']) . "', '" . NULL . "', '" . NULL . "', '" . NULL . "', '" . NULL . "', '" . NULL . "', '" . NULL . "')";
        $result = $db_handle->insertQuery($query);

        if(!empty($result)) {
            echo "
            <script>
                    alert('Facebook registration successful!');
            </script>
            ";
        } else {
            echo "
            <script>
                    alert('Error occured during registration.');
            </script>
            ";
        }
    }
}

?>