<?php require_once ("Sessions.php"); ?>
<?php require_once ("Functions.php"); ?>
<?php
/**
 * Author Safnaj on 2/12/2019
 * Project Giant CMS
 **/

$_SESSION["Username"] = null;
session_destroy();
RedirectTo("Login.php")


?>