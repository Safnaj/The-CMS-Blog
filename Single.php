<?php require_once("database/DBConnection.php"); ?>
<?php require_once ("Sessions.php"); ?>
<?php require_once ("Functions.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        global $DBConnect;  //Database Connection
        $PostIdFromURL = $_GET["id"];
        $Query = "SELECT * FROM posts WHERE id='$PostIdFromURL' ORDER BY datetime DESC ";
        $Execute = mysqli_query($DBConnect,$Query);
        while ($DataRows = mysqli_fetch_array($Execute)) {
            $Title = $DataRows["title"];
        }
    ?>
    <meta charset="UTF-8">
    <title><?php echo htmlentities($Title); ?></title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/BlogStyle.css">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark">
    <div class="navbar-brand" href="Blog.php">
        <img class="logo" src="images/head.png" width="130px" height="50px">
    </div>
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Categories</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>
        <form action="Single.php" class="navbar-form navbar-right">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search" name="Search">
            </div>
            <button class="btn btn-default" name="SearchButton">Go</button>
        </form>
    </div>
</nav>
<!--Main Area 0f Blog-->
<div class="container">
    <div class="blog-header">
        <h1>Complete Responsive Blog</h1>
        <p class="lead">The Complete Blog in PHP with Admin Panel</p>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <?php
            global $DBConnect;  //Database Connection
            if(isset($_GET["SearchButton"])){
                $Search = $_GET["Search"];
                $Query = "SELECT * FROM posts WHERE datetime LIKE '%$Search%' OR
                                    title LIKE '%$Search%' OR category LIKE '%$Search%' OR 
                                    post LIKE '%$Search%'";
            }
            else{
                $PostIdFromURL = $_GET["id"];
                $Query = "SELECT * FROM posts WHERE id='$PostIdFromURL' ORDER BY datetime DESC ";
            }

            $Execute = mysqli_query($DBConnect,$Query);

            while ($DataRows = mysqli_fetch_array($Execute)){
                $PostID = $DataRows["id"];
                $DateTime = $DataRows["datetime"];
                $Title = $DataRows["title"];
                $Category = $DataRows["category"];
                $Author = $DataRows["author"];
                $Image = $DataRows["image"];
                $Post = $DataRows["post"];
                ?>
                <div class="blogpost thumbnail">
                    <img class="img-responsive img-rounded" src="uploads/<?php echo $Image;?>">
                    <div class="caption">
                        <h1 id="heading"><?php echo htmlentities($Title); ?></h1>
                        <p class="description">Category : <?php echo htmlentities($Category);?> Published on
                            <?php echo htmlentities($DateTime);?></p>
                        <p class="post">
                            <?php echo $Post; ?>
                        </p>
                    </div>
                </div>
            <?php }?>
        </div>
        <!--Sidebar-->
        <div class="col-sm-offset-1 col-sm-3">
            <h2>Test</h2>
            <p>fadfabdf abfhdbfhabf dabf hbadsfhba fb dshfbah fbah sdfbh asdfbah sfba sflbasdf abdf
                fadbfadbfadbfka dfsbahdfbhdsbf afbsakd fbsfk asdfiwheo cn dscowhoeoi fnsjd bfawoewh</p>
        </div>
        <!--Sidebar-->
    </div>
</div>
<!--Main Area 0f Blog-->
<!--Footer-->
<div id="Footer">
    <p>Developed By Ahamed Safnaj | &copy2019 -- All Right Reserved</p>
</div>
<!--Footer-->
</body>
</html>