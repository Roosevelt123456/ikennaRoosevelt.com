<?php

//Authorization-Access Control
//Check Whether the user is logged in or not

if(!isset($_SESSION['user']))//If user session is not set
    
    {
    //user is not logged is 
    //Redirect to login Page with message
    $_SESSION['no-login-message']="<div class='error text-center'>Please login to access Admin Panel.</div>";
    //Redirect to login Page
    
    header('location:'.SITEURL.'Admin/login.php');
}

?>