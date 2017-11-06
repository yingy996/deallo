<!DOCTYPE html>
<html data-ng-app="">
    <head>
        <title>Deallo Craft House</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initialscale=1.0"/>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/stylesheet.css" rel="stylesheet" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
        <style>
            body {
                background-image: url("images/.jpeg");
                background-color: whitesmoke;
                background-size: cover; 
            }
            
            body>div.container {
                background-color: white;
            }
            
            .category>table {
                width: 100%;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <!-- Navigation Bar -->
        <?php 
        include("header.php");
        ?>

        <!-- Body content -->
        <div class="container">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">

                    <div class="item active">
                        <img src="images/banner.jpg" alt="Los Angeles" style="width:100%; max-height: 250px !important;">
                        <div class="carousel-caption">
                            <h3> </h3>
                            <p> </p>
                        </div>
                    </div>

                    <div class="item">
                        <img src="images/calculator.jpeg" alt="Chicago" style="width:100%; max-height: 250px !important;">
                        <div class="carousel-caption">
                            <h3> </h3>
                            <p> </p>
                        </div>
                    </div>

                    <div class="item">
                        <img src="images/banner2.jpeg" alt="New York" style="width:100%; max-height: 250px !important;">
                        <div class="carousel-caption">
                            <h3> </h3>
                            <p> </p>
                        </div>
                    </div>

                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            
            <div class='category'>
                <h2>Item category</h2>
                
                <table>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>8</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <?php 
        include("footer.php");
        ?>
        <!-- jQuery – required for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js"></script>
        <!-- All Bootstrap plug-ins file -->
        <script src="js/bootstrap.min.js"></script>
        <!--Basic AngularJS-->
        <script src="js/angular.min.js"></script>
    </body>
</html>