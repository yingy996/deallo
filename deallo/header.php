<?php 
    include("session.php");

    //Display the navigation bar
    echo 
        '<nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <!--3 bar icon-->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-to-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="index.php"><em>Deallo Craft House</em></a>
                </div>

                <div class="collapse navbar-collapse" id="navbar-to-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="productcategory.php">Products <span class="caret"></span></a>
                            <ul class="dropdown-menu">
								<li><a href="productcategory.php?category=all">All</a></li>
                                <li><a href="productcategory.php?category=jewelry">Jewelry</a></li>
                                <li><a href="productcategory.php?category=clothesNaccessories">Clothing &amp; accessories</a></li>
                                <li><a href="productcategory.php?category=roomDecor">Room decoration</a></li>
                                <li><a href="productcategory.php?category=weddingAccessories">Wedding accessories</a></li>
                                <li><a href="productcategory.php?category=vintageArts">Vintage arts</a></li>
                                <li><a href="productcategory.php?category=toy">Toys</a></li>
                                <li><a href="productcategory.php?category=craftSupplies">Craft supplies</a></li>

                                <li><a href="productcategory.php?category=etc">Others</a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="btn disabled hidden-xs">|</a></li>';
                
                
                    //Display user account if user logged in
                    if (!isset($_SESSION["user_login"])){
                        echo '<li><a href="login.php">Login</a></li>';
                        echo '<li><a href="register.php">Sign up</a></li>';
                    } else {
                        
                        echo '<li class="hidden-sm hidden-md hidden-lg hidden-xl"><a href="shoppingcart.php"><span class="glyphicon glyphicon-shopping-cart"></span><span> Shopping cart</span></a></li>';
                        
                        echo '<li class="hidden-xs"><a href="shoppingcart.php" class="btn-lg"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>';
                        
                        //echo '<li><a href="viewuseraccount.php"><span class="glyphicon glyphicon-user"></span><span> '. $login_user.'</span></a></li>';
                        
						echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="viewuseraccount.php"><span class="glyphicon glyphicon-user"></span><span> '. $login_user.'</span></a>
                            <ul class="dropdown-menu">
								<li><a href="viewuseraccount.php"> My Profile</a></li>
								<li class="divider"></li>
								<li class="dropdown-header">Sell</li>
                                <li><a href="myproducts.php">My Products</a></li>
								<li><a href="customerorders.php">My Sales Orders</a></li>
								<li><a href="saleshistory.php">Sales History</a></li>
								<li class="divider"></li>
								<li class="dropdown-header">Buy</li>
                                <li><a href="mypurchases.php">My Purchases</a></li>
								<li><a href="shoppingcart.php">Shopping Cart</a></li>
                            </ul>
                        </li>';
                        
                        echo '<li class="hidden-sm hidden-md hidden-lg hidden-xl"><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span><span> Logout</span></a></li>';
                        
                        echo '<li class="hidden-xs"><a href="logout.php" class="btn-lg"><span class="glyphicon glyphicon-log-out"></span></a></li>';
                    }    
                
            echo '</ul>
                </div>
            </div>
        </nav>';
?>