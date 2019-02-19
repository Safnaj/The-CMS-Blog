<?php require_once("database/DBConnection.php"); ?>
<?php require_once ("Sessions.php"); ?>
<?php require_once ("Functions.php"); ?>
<!--
 Author Safnaj on 1/14/2019
 Project Giant CMS
-->
<?php
//Comments Area
if(isset($_POST['Submit'])){
    $Name=$_POST['Name'];
    $Email=$_POST['Email'];
    $Comments=$_POST['Comments'];
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
    $DateTime;
    $PostID = $_GET["id"];
    $Admin = $_SESSION["Username"];
    if(empty($Name)||empty($Email)||empty($Comments)) {
        $_SESSION["ErrorMessage"] = "Please Fill All The Fileds..!";
    }
    elseif(strlen($Comments)>200){
        $_SESSION["ErrorMessage"] = "Only 500 Characters are Allowed in Comments..!";
    }
    else{
        global $DBConnect;
        $PostIdFromURL = $_GET['id'];
        $Query = "INSERT INTO comments(datetime,name,email,comment,approvedBy,status,post_id)
                  VALUES('$DateTime','$Name','$Email','$Comments','pending','OFF','$PostIdFromURL')";
        $Execute = mysqli_query($DBConnect,$Query);
        if($Execute){
            $_SESSION["SuccessMessage"] = "Comment Submitted Successfully..!";
            RedirectTo("Single.php?id={$PostID}");
        }else{
            $_SESSION["ErrorMessage"] = "Something Went Wrong..!";
            RedirectTo("Single.php?id={$PostID}");
        }
    }
}
?>

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
            <div>
                <?php
                echo Message();
                echo SuccessMessage();
                ?>
            </div>
            <!--Search Function-->
            <?php
            global $DBConnect;  //Database Connection
            if(isset($_GET["SearchButton"])){
                $Search = $_GET["Search"];
                //Query for the Search Option
                $Query = "SELECT * FROM posts WHERE datetime LIKE '%$Search%' OR
                                    title LIKE '%$Search%' OR category LIKE '%$Search%' OR 
                                    post LIKE '%$Search%'";
            }
            else{
                //Query as Default
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
            <br>
            <!--comments-->
            <h4>Comments</h4>
                <?php
                    global $DBConnect;
                    $PostIdFromURL = $_GET["id"];
                    $CommentsQuery = "SELECT * FROM comments WHERE post_id='$PostIdFromURL' AND status='ON'";
                    $Execute = mysqli_query($DBConnect,$CommentsQuery);

                    while($DataRows = mysqli_fetch_array($Execute)){
                        $CommentDate = $DataRows["datetime"];
                        $CommenterName = $DataRows["name"];
                        $Comment = $DataRows["comment"];
                ?>
                        <div class="CommentBlock">
                            <img class="pull-left" src="images/avatar.png" width="70px" height="70px">
                            <p class="commenter"><?php echo $CommenterName;?></p>
                            <p><?php echo $CommentDate;?></p>
                            <br>
                            <p><?php echo $Comment;?></p>
                        </div>
                        <br>

                    <?php } ?>

            <div class="comments">
                <h4 align="center">Your Comments Here</h4>
                <form method="post" action="Single.php?id=<?php echo $PostID; ?>" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="title"><span class="FieldInfo">Name:</span></label>
                            <input class="form-control" type="text" name="Name" id="Name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="title"><span class="FieldInfo">Email:</span></label>
                            <input class="form-control" type="text" name="Email" id="Email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="post"><span class="FieldInfo">Comments:</span></label>
                            <textarea class="form-control" name="Comments" id="Comments" placeholder="Your Comments Here">
                            </textarea>
                        </div>
                        <input class="btn btn-primary" type="submit" name="Submit" value="Submit">
                    </fieldset>
                </form>
            </div>
            <br>
            <!--comments-->
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