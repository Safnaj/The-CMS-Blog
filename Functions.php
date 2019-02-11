<?php
/**
 * Author Safnaj on 1/8/2019
 * Project Giant CMS
 **/

function RedirectTo($NewLocation){
    header("Location:".$NewLocation);
    exit;
}

function Login($Username, $Password){
    global $DBConnect;
    $Query = "SELECT * FROM admins WHERE username='$Username' AND password='$Password'";
    $Execute = mysqli_query($DBConnect,$Query);
    if($Admin = mysqli_fetch_assoc($Execute)){
        return $Admin;
    }else{
        return null;
    }
}
?>