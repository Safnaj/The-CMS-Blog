<?php require_once("database/DBConnection.php"); ?>
<?php require_once ("Sessions.php"); ?>
<?php require_once ("Functions.php"); ?>

<?php
/**
 * Author Safnaj on 2/11/2019
 * Project Giant CMS
 **/
if(isset($_GET["id"])){
    $Id = $_GET["id"];
    global $DBConnect;
    $Query = "DELETE FROM admins WHERE id='$Id'";
    $Execute = mysqli_query($DBConnect,$Query);
    if($Execute){
        $_SESSION["SuccessMessage"]="Admin Deleted Successfully..!";
        RedirectTo("Admins.php");
    }else{
        $_SESSION["ErrorMessage"]="Something Went Wrong..!";
        RedirectTo("Admins.php");
    }
}