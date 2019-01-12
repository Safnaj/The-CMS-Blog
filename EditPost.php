<?php require_once("database/DBConnection.php"); ?>
<?php require_once ("Sessions.php"); ?>
<?php require_once ("Functions.php"); ?>

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

    if(empty($Title)){
        $_SESSION["ErrorMessage"] = "Title Can't Be Empty..!";
        RedirectTo("EditPost.php");
    }
    elseif(strlen($Title)<2){
        $_SESSION["ErrorMessage"] = "Title Should Be at-least 2 Characters..!";
        RedirectTo("EditPost.php");
    }
    elseif(empty($Post)){
        $_SESSION["ErrorMessage"] = "Post Can't Be Empty";
        RedirectTo("EditPost.php");
    }
    else{

        $PostIdParameter = $_GET['Edit'];
        global $DBConnect;
        $Query = "UPDATE posts SET datetime='$DateTime',title='$Title',category='$Category',author='$Admin',image='$Image',post='$Post'
                  WHERE id='$PostIdParameter'";
        $Execute = mysqli_query($DBConnect,$Query);

        move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);

        if($Execute){
            $_SESSION["SuccessMessage"] = "Post Updated Successfully..!";
            RedirectTo("Posts.php");
        }else{
            $_SESSION["ErrorMessage"] = "Something Went Wrong..!";
            RedirectTo("Posts.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/AdminStyle.css">
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
                    <a class="nav-link" href="#">
                        <span class="glyphicon glyphicon-user"></span>&nbspManage Admins</a></i>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
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
            <h2>Edit Post</h2>
            <div>
                <?php
                echo Message();
                echo SuccessMessage();
                ?>
            </div>
            <?php
                $PostIdParameter = $_GET['Edit'];
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
                <form method="post" action="EditPost.php?Edit=<?php echo $PostIdParameter?>" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="title"><span class="FieldInfo">Title:</span></label>
                            <input value="<?php echo $TitleUpdate ;?>" class="form-control" type="text" name="Title" id="Title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label><span class="FieldInfo">Existing Category : </span></label>
                            <?php echo $CategoryUpdate ;?>
                        </div>
                        <div class="form-group">
                            <label for="category"><span class="FieldInfo">New Category:</span></label>
                            <select class="form-control" id="Category" name="Category">
                                <!--Fetching Category-->
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
                                <!--Fetching Category-->
                            </select>
                        </div>
                        <div class="form-group">
                            <label><span class="FieldInfo">Existing Image : </span></label>
                            <img src="uploads/<?php echo $ImageUpdate;?>" width="130px" height="50px" ?>
                        </div>
                        <div class="form-group">
                            <label for="image"><span class="FieldInfo">Choose New Image:</span></label>
                            <input type="File" class="form-control" name="Image" id="Image">
                        </div>
                        <div class="form-group">
                            <label for="post"><span class="FieldInfo">Post:</span></label>
                            <textarea class="form-control" name="Post" id="Post"><?php echo $PostUpdate;?></textarea>
                        </div>
                        <input class="btn btn-primary btn-block" type="submit" name="Submit" value="Update Post">
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
