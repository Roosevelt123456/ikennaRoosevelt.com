<?php
//Include Constants.php for ITURL
include ('../config/constant.php');

//1. Destory the Session
session_destroy();
 
//2. Redirect to Login Page
header('location:'.SITEURL.'Admin/login.php');
?>