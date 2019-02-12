<?php require_once("database/DBConnection.php"); ?>
<?php require_once ("Sessions.php"); ?>
<?php require_once ("Functions.php"); ?>

<?php
/**
 * Author Safnaj on 1/14/2019
 * Project Giant CMS
 **/
if(isset($_POST['Submit'])){
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

    if(empty($Username)||empty($Password)){
        $_SESSION["ErrorMessage"] = "Please Fill All The Fileds..!";
        RedirectTo("Login.php"); //From Function Class
    }
    else{
        $UserFound = Login($Username,$Password);
        if($UserFound){
            $_SESSION["Username"] = $UserFound["username"];     //Fetching Username from User
            $_SESSION["SuccessMessage"] = "Welcome {$_SESSION["Username"]}..!";
            RedirectTo("Dashboard.php");
        }
        else{
            $_SESSION["ErrorMessage"] = "Incorrect Username or Password..!";
            RedirectTo("Login.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap/css/AdminStyle.css">
    <style>
        body{
            background-color: white;
        }
        #Footer{
            color: #000000;
        }
        h2{
            text-align:center;
        }
        .login{
            background-color: #f8f9fa!important;
            padding-left: 15px;
            padding-right: 15px;
            padding-bottom: 15px;
            box-shadow: 2px 4px 8px 2px rgba(0, 0, 0, 0.2), 1px 6px 20px 1px rgba(0, 0, 0, 0.19);
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">

        <div class="col-sm-offset-4 col-sm-4">

            <br><br><br><br>
            <h2>Admin Login</h2>
            <?php
            echo Message();
            echo SuccessMessage();
            ?>
            <br>
            <div class="login">
            <br>
            <div>
                <form method="post" action="Login.php" >
                    <fieldset>
                        <div class="form-group">
                            <label for="categoryname"><span class="FieldInfo">Username:</span></label>
                            <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>
                                <input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="categoryname"><span class="FieldInfo">Password:</span></label>
                            <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </span>
                                <input class="form-control" type="password" name="Password" id="Password" placeholder="Password">
                            </div>
                        </div>
                        <input class="btn btn-primary btn-block" type="submit" name="Submit" value="Login">
                    </fieldset>
                </form>
            </div>
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
