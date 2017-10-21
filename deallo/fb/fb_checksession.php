<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 0);
error_reporting(-1);
function ShutdownHandler()
{
    if(@is_array($error = @error_get_last()))
    {
        return(@call_user_func_array('ErrorHandler', $error));
    };
    return(TRUE);
};
register_shutdown_function('ShutdownHandler');
function ErrorHandler($type, $message, $file, $line)
{
    $_ERRORS = Array(
        0x0001 => 'E_ERROR',
        0x0002 => 'E_WARNING',
        0x0004 => 'E_PARSE',
        0x0008 => 'E_NOTICE',
        0x0010 => 'E_CORE_ERROR',
        0x0020 => 'E_CORE_WARNING',
        0x0040 => 'E_COMPILE_ERROR',
        0x0080 => 'E_COMPILE_WARNING',
        0x0100 => 'E_USER_ERROR',
        0x0200 => 'E_USER_WARNING',
        0x0400 => 'E_USER_NOTICE',
        0x0800 => 'E_STRICT',
        0x1000 => 'E_RECOVERABLE_ERROR',
        0x2000 => 'E_DEPRECATED',
        0x4000 => 'E_USER_DEPRECATED'
    );
    if(!@is_string($name = @array_search($type, @array_flip($_ERRORS))))
    {
        $name = 'E_UNKNOWN';
    };
    return(print(@sprintf("%s Error in file \xBB%s\xAB at line %d: %s\n", $name, @basename($file), $line, $message)));
};
$old_error_handler = set_error_handler("ErrorHandler");
?>

<?php
session_start();
require_once __DIR__ . '/src/Facebook/autoload.php';


//echo '<h3>Getting Access Token information</h3>';
if (isset($_SESSION['fb_access_token'])) {
    //echo '$_SESSION[fb_access_token] ==>' .$_SESSION['fb_access_token'];

    $fb = new Facebook\Facebook(['app_id' => '296435147524384','app_secret' => '01a6b28080ff646e9c43cbe3f9ee83d1','default_graph_version' => 'v2.4',]);

    try {  // Returns a `Facebook\FacebookResponse` object
        $response = $fb->get('/me?fields=id,name,email,first_name,last_name', $_SESSION['fb_access_token']);
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

    $user = $response->getGraphUser();
    /*?><br><?php*/
    //echo 'Name: ' . $user['name'];
    //echo '<br/>Email: ' . $user['email'];
    //echo '<br/>id: ' . $user['id'];
    //echo '<br/>first name: ' . $user['first_name'];
    //echo '<br/>last name: ' . $user['last_name'];


    /*?><br><?php */
}  else {
    echo "Dont know about session"; 
    header("refresh:3; url=../index.php");
    exit();
}

$script = '';

if(!empty($user['name']) && !empty($user['email'])) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include ("fb_process_register.php");

    require_once("../dbcontroller.php");

    $db_handle = new DBController();
    //check if username exits
    $user_email = $user['email'];
    $query = $db_handle->getConn()->prepare("SELECT username FROM user_account WHERE email =  '$user_email'" );

    $query->execute();
    $result = $query->fetchAll();
    $login_user = $result[0]["username"];

    $_SESSION["user_login"] = $login_user;

    header("refresh:3; url=../index.php"); 

    $login_message = "You will be redirected to the homepage shortly.";

} else {
    $login_message = "Falied to login. An error has occurred. Please try again later.";
}
?>

<!DOCTYPE html>
<html data-ng-app="app">
    <head>
        <title>Money Saver</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initialscale=1.0"/>
        <!-- Bootstrap -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" />
        <link href="../css/stylesheet.css" rel="stylesheet" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
        <style>
            .inactiveLink {
                pointer-events: none;
                cursor: default;
            }
        </style>
    </head>
    <body id="loginpg"> <!--full page background img -->
        <div class=inactiveLink><?php 
            include("../header.php");
            ?></div>

        <!-- Navigation Bar -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-4 col-xs-offset-4">
                    <form id="login" >
                        <p>
                            <?php 
                            if (isset($login_user)) {
                                echo "<h2>Login successful!</h2><br/>";
                            }
                            echo $login_message . $script; 
                            ?>
                        </p>
                    </form>

                </div>

            </div>
        </div>

        <!-- Footer -->
        <div class="inactiveLink">
            <?php 
            include("../footer.php");
            ?>
        </div>

        <!-- jQuery – required for Bootstrap's JavaScript plugins) -->
        <script src="../js/jquery.min.js"></script>
        <!-- All Bootstrap plug-ins file -->
        <script src="../js/bootstrap.min.js"></script>
        <!--Basic AngularJS-->
    </body>
</html>