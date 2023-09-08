<?php 

include ('../config/constant.php');

include ('login-check.php');
?>




<html>
    
    <head>
        <title>Food Order Website - HomePage</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        
        <!----menu section starts--->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="../Admin/index.php">Home</a></li>
                    <li><a href="../Admin/manage-admin.php">Admin</a></li>
                    <li><a href="../Admin/manage-category.php">Category</a></li>
                    <li><a href="../Admin/manage-food.php">Food</a></li>
                    <li><a href="../Admin/manage-order.php">Order</a></li>
                    <li><a href="logout.php">Logout</a></li>



                </ul>
            </div>
        </div>