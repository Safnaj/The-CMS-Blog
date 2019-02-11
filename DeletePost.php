<?php require_once("database/DBConnection.php"); ?>
<?php require_once ("Sessions.php"); ?>
<?php require_once ("Functions.php"); ?>
<!--
 Author Safnaj on 1/14/2019
 Project Giant CMS
-->
<?php
if(isset($_POST["Submit"])){

    $Title = $_POST["Title"];
    $Category = $_POST["Category"];
    $Post = $_POST["Post"];
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
    $DateTime;
    $Admin = "Safnaj";
    $Image = $_FILES["Image"]["name"];
    $Target = "uploads/".basename($_FILES["Image"]["name"]);


        $DeleteId = $_GET['Delete'];
        global $DBConnect;
        $Query = "DELETE FROM posts WHERE id = '$DeleteId'";
        $Execute = mysqli_query($DBConnect,$Query);

        move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);

        if($Execute){
            $_SESSION["SuccessMessage"] = "Post Deleted Successfully..!";
            RedirectTo("Posts.php");
        }else{
            $_SESSION["ErrorMessage"] = "Something Went Wrong..!";
            RedirectTo("Posts.php");
        }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Post</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap/css/AdminStyle.css">
</head>
<body>
<div class="container-fluid">
    <div class="row">

        <!--Sidebar-->
        <div class="col-sm-2">
            <h2>Admin Panel</h2>
            <ul id="Side_Menu" class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="Dashboard.php">
                        <span class="glyphicon glyphicon-home"></span>&nbspDashboard</a></i>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="NewPost.php">
                        <span class="glyphicon glyphicon-file"></span>&nbspNew Post</a></i>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Posts.php">
                        <span class="glyphicon glyphicon-book"></span>&nbspPosts</a></i>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Categories.php">
                        <span class="glyphicon glyphicon-th-list"></span>&nbspCategories</a></i>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Admins.php">
                        <span class="glyphicon glyphicon-user"></span>&nbspManage Admins</a></i>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Comments.php">
                        <span class="glyphicon glyphicon-comment"></span>&nbspComments</a></i>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Blog.php" target="_blank">
                        <span class="glyphicon glyphicon-equalizer"></span>&nbspView Site</a></i>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="glyphicon glyphicon-off"></span>&nbspLogout</a></i>
                </li>
            </ul>
        </div>
        <!--Sidebar-->

        <div class="col-sm-10">
            <h2>Delete Post</h2>
            <div>
                <?php
                echo Message();
                echo SuccessMessage();
                ?>
            </div>
            <?php
            $PostIdParameter = $_GET['Delete'];
            global $DBConnect;
            $Query = "SELECT * FROM posts WHERE id='$PostIdParameter'";
            $Execute = mysqli_query($DBConnect,$Query);
            while($DataRows = mysqli_fetch_array($Execute)){
                $TitleUpdate = $DataRows["title"];
                $CategoryUpdate = $DataRows["category"];
                $ImageUpdate = $DataRows["image"];
                $PostUpdate = $DataRows["post"];
            }
            ?>
            <br>
            <div>
                <form method="post" action="DeletePost.php?Delete=<?php echo $PostIdParameter?>" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="title"><span class="FieldInfo">Title:</span></label>
                            <input disabled value="<?php echo $TitleUpdate ;?>" class="form-control" type="text" name="Title" id="Title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label><span class="FieldInfo">Existing Category : </span></label>
                            <input disabled value="<?php echo $CategoryUpdate ;?>" class="form-control" type="text" name="Category" id="Category" placeholder="Category">
                        </div>
                        <div class="form-group">
                            <label><span class="FieldInfo">Image : </span></label>
                            <img src="uploads/<?php echo $ImageUpdate;?>" width="130px" height="50px" ?>
                        </div>

                        <div class="form-group">
                            <label for="post"><span class="FieldInfo">Post:</span></label>
                            <textarea disabled class="form-control" name="Post" id="Post"><?php echo $PostUpdate;?></textarea>
                        </div>
                        <input class="btn btn-danger btn-block" type="submit" name="Submit" value="Delete Post">
                    </fieldset>
                </form>
            </div>
            <br>

        </div>
    </div>
    <!--Footer-->
    <div id="Footer">
        <p>Developed By Ahamed Safnaj | &copy2019 -- All Right Reserved</p>
    </div>
    <!--Footer-->
</div>
</body>
</html>
