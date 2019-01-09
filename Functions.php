<?php
/**
 * Author Safnaj on 1/8/2019
 * Project Giant CMS
 **/

function RedirectTo($NewLocation){
    header("Location:".$NewLocation);
    exit;
}
?>