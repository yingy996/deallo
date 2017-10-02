<?php 
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

                    <a class="navbar-brand" href="#">Money Saver</a>
                </div>

                <div class="collapse navbar-collapse" id="navbar-to-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Products <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Burger</a></li>
                                <li><a href="#">Appetizer</a></li>
                                <li><a href="#">Dessert</a></li>
                                <li><a href="#">Drink</a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="btn disabled hidden-xs">|</a></li>
                        <li><a href="#">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>';
?>