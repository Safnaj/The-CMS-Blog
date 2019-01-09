<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/BlogStyle.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark">
        <div class="navbar-brand" href="Blog.php">
            <img src="images/head.png" width="130px" height="50px">
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
                <h2>Test</h2>
                <p>fadfabdf abfhdbfhabf dabf hbadsfhba fb dshfbah fbah sdfbh asdfbah sfba sflbasdf abdf
                fadbfadbfadbfka dfsbahdfbhdsbf afbsakd fbsfk asdfiwheo cn dscowhoeoi fnsjd bfawoewh</p>
            </div>
            <div class="col-sm-offset-1 col-sm-3">
                <h2>Test</h2>
                <p>fadfabdf abfhdbfhabf dabf hbadsfhba fb dshfbah fbah sdfbh asdfbah sfba sflbasdf abdf
                    fadbfadbfadbfka dfsbahdfbhdsbf afbsakd fbsfk asdfiwheo cn dscowhoeoi fnsjd bfawoewh</p>
            </div>
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