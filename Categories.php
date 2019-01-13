<?php require_once("database/DBConnection.php"); ?>
<?php require_once ("Sessions.php"); ?>
<?php require_once ("Functions.php"); ?>

<?php
    if(isset($_POST['Submit'])){
        $Category=$_POST['Category'];
        $CurrentTime = time();
        $DateTime = strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
        $DateTime;
        $Admin = "Safnaj";
        if($Category==""){
            $_SESSION["ErrorMessage"] = "Please Fill All The Fileds..!";
            RedirectTo("Categories.php"); //From Function Class
        }
        elseif(strlen($Category)>99){
            $_SESSION["ErrorMessage"] = "Too Long Name for Catefory";
            RedirectTo("Categories.php"); //From Function Class
        }
        else{
            global $DBConnect;
            $Query = "INSERT INTO category(datetime,name,author)VALUES('$DateTime','$Category','$Admin')";
            $Execute = mysqli_query($DBConnect,$Query);
            if($Execute){
                $_SESSION["SuccessMessage"] = "Category Added Successfully..!";
                RedirectTo("Categories.php"); //From Function Class
            }else{
                $_SESSION["ErrorMessage"] = "Something Went Wrong..!";
                RedirectTo("Categories.php"); //From Function Class
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories</title>
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
                    <a class="nav-link active" href="Categories.php">
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
            <h2>Manage Categories</h2>
            <div>
                <?php
                    echo Message();
                    echo SuccessMessage();
                ?>
            </div>
            <br>
            <div>
                <form method="post" action="Categories.php" >
                    <fieldset>
                        <div class="form-group">
                            <label for="categoryname"><span class="FieldInfo">Name:</span></label>
                            <input class="form-control" type="text" name="Category" id="Category" placeholder="Name">
                        </div>
                        <input class="btn btn-primary btn-block" type="submit" name="Submit" value="Add New Category">
                    </fieldset>
                </form>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>ID Number</th>
                        <th>Date&Time</th>
                        <th>Category Name</th>
                        <th>Author</th>
                    </tr>
                    <?php
                        global $DBConnect;
                        $ViewQuery = "SELECT * FROM category ORDER BY datetime desc";
                        $Execute = mysqli_query($DBConnect,$ViewQuery);
                        $srNo=0;
                        while($DataRows = mysqli_fetch_array($Execute)){
                            $id = $DataRows["id"];
                            $DateTime = $DataRows["datetime"];
                            $Name = $DataRows["name"];
                            $Author = $DataRows["author"];
                            $srNo++;
                    ?>
                    <tr>
                        <td><?php echo $srNo; ?></td>
                        <td><?php echo $DateTime; ?></td>
                        <td><?php echo $Name; ?></td>
                        <td><?php echo $Author; ?></td>
                    </tr>
                    <?php }?> <!--End of While Loop-->
                </table>
            </div>
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
