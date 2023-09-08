<?php
//start Session
session_start();

//create constant  to store here
define('SITEURL', 'http://localhost/food-order/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-order');

 $conn= mysqli_connect(LOCALHOST, DB_USERNAME,DB_PASSWORD,DB_NAME)or die(mysqli_connect_error());//Database Connection;
    $db_select= mysqli_select_db($conn, DB_NAME)or die(mysqli_select_db_error());//selecting database
