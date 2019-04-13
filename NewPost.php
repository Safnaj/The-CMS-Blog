<?php require_once("database/DBConnection.php"); ?>
<?php require_once ("Sessions.php"); ?>
<?php require_once ("Functions.php"); ?>
<?php ConfirmLogin() ?>

<?php
if(isset($_POST["Submit"])){

    $Title = $_POST["Title"];
    $Category = $_POST["Category"];
    $Post = $_POST["Post"];
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
    $DateTime;
    $Admin = $_SESSION["Username"];
    $Image = $_FILES["Image"]["name"];
    $Target = "uploads/".basename($_FILES["Image"]["name"]);

    if(empty($Title)){
        $_SESSION["ErrorMessage"] = "Title Can't Be Empty..!";
        RedirectTo("NewPost.php");
    }
    elseif(strlen($Title)<2){
        $_SESSION["ErrorMessage"] = "Title Should Be at-least 2 Characters..!";
        RedirectTo("NewPost.php");
    }
    elseif(empty($Post)){
        $_SESSION["ErrorMessage"] = "Post Can't Be Empty";
        RedirectTo("NewPost.php");
    }
    else{

        global $DBConnect;
        $Query = "INSERT INTO posts(datetime,title,category,author,image,post)
                  VALUES('$DateTime','$Title','$Category','$Admin','$Image','$Post')";
        $Execute = mysqli_query($DBConnect,$Query);

        move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);

        if($Execute){
            $_SESSION["SuccessMessage"] = "Post Published Successfully..!";
            RedirectTo("NewPost.php");
        }else{
            $_SESSION["ErrorMessage"] = "Something Went Wrong..!";
            RedirectTo("NewPost.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Post</title>
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
            <div class="SideBar">
                <h2>Admin Panel</h2>
                <ul id="Side_Menu" class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="Dashboard.php">
                            <span class="glyphicon glyphicon-home"></span>&nbspDashboard</a></i>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="NewPost.php">
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
                        <a class="nav-link" href="Logout.php">
                            <span class="glyphicon glyphicon-off"></span>&nbspLogout</a></i>
                    </li>
                </ul>
            </div>
        </div>
        <!--Sidebar-->

        <div class="col-sm-10">
            <h2>Add New Post</h2>
            <div>
                <?php
                echo Message();
                echo SuccessMessage();
                ?>
            </div>
            <br>
            <div>
                <form method="post" action="NewPost.php" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="title"><span class="FieldInfo">Title:</span></label>
                            <input class="form-control" type="text" name="Title" id="Title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="category"><span class="FieldInfo">Category:</span></label>
                            <select class="form-control" id="Category" name="Category">
                                <?php
                                global $DBConnect;
                                $ViewQuery = "SELECT * FROM category";
                                $Execute = mysqli_query($DBConnect,$ViewQuery);
                                while($DataRows = mysqli_fetch_array($Execute)) {
                                    $id = $DataRows["id"];
                                    $Name = $DataRows["name"];
                                ?>
                                <option><?php echo $Name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image"><span class="FieldInfo">Choose Image:</span></label>
                            <input type="File" class="form-control" name="Image" id="Image">
                        </div>
                        <div class="form-group">
                            <label for="post"><span class="FieldInfo">Post:</span></label>
                            <textarea class="form-control" name="Post" id="Post"></textarea>
                        </div>
                        <input class="btn btn-primary btn-block" type="submit" name="Submit" value="Add New Post">
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
