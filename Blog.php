<?php require_once("database/DBConnection.php"); ?>
<?php require_once ("Sessions.php"); ?>
<?php require_once ("Functions.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap/css/BlogStyle.css">
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
            <form action="Blog.php" class="navbar-form navbar-right">
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
                    //Query when Search Button Activated
                    $Query = "SELECT * FROM posts WHERE datetime LIKE '%$Search%' OR
                                    title LIKE '%$Search%' OR category LIKE '%$Search%' OR 
                                    post LIKE '%$Search%'";
                }
                //Query when pagination is Active. Ex : Blog.php?Page=1
                elseif (isset($_GET["Page"])){
                    $Page = $_GET["Page"];

                    if($Page==0 || $Page < 1){
                        $ShowPostFrom = 0;
                    }
                    else
                    $ShowPostFrom = ($Page*5)-5;    //Pagination Algorithm
                    $Query = "SELECT * FROM posts ORDER BY datetime DESC LIMIT $ShowPostFrom,5";

                }
                else{
                    //Default Query
                    $Query = "SELECT * FROM posts ORDER BY datetime DESC LIMIT 0,5";
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
                           <?php
                               if(strlen($Post)>250){
                                   $Post = substr($Post,0,250).'...';
                               }
                           echo $Post; ?>
                       </p>
                   </div>
                   <a href="Single.php?id=<?php echo $PostID;?>"><span class="btn btn-info">Read More &rsaquo;</span> </a>
               </div>
                <?php }?>

                <nav>
                    <ul class="pagination pull-left pagination-lg">

                <?php
                    global $DBConnect;
                    $QueryPagination = "SELECT COUNT(*) FROM posts";
                    $ExecutePagination = mysqli_query($DBConnect,$QueryPagination);
                    $DataRowsPagination = mysqli_fetch_array($ExecutePagination);
                    $TotalPosts = array_shift($DataRowsPagination);

                    $PostPagination = $TotalPosts/5;
                    $PostPagination = ceil($PostPagination);

                    for ($i=1; $i<=$PostPagination; $i++){
                    if ($i=$Page){
                ?>
                        <li class="active"><a href="Blog.php?Page=<?php echo $i?>"><?php echo $i ?></a></li>
                <?php
                    }else{
                        ?>
                        <li><a href="Blog.php?Page=<?php echo $i?>"><?php echo $i ?></a></li>
                        <?php
                        }
                    }
                ?>
                    </ul>
                </nav>
            </div>
            <!--Sidebar-->
            <div class="col-sm-offset-1 col-sm-3">
                <h2>Test</h2>
                <p>fadfabdf abfhdbfhabf dabf hbadsfhba fb dshfbah fbah sdfbh asdfbah sfba sflbasdf abdf
                    fadbfadbfadbfka dfsbahdfbhdsbf afbsakd fbsfk asdfiwheo cn dscowhoeoi fnsjd bfawoewh
                </p>
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