<?php
//include constants.php file here
include ('../config/constant.php');
// 1. get ID of Admin to be deleted
if (isset($_GET['id'])) {
  # code...

/* @var $_GET type */
//echo $id= $_GET['id'];
 $id= $_GET['id'];
//2.create sql query to delete Admin
$sql="DELETE FROM tbl_admin WHERE id=$id";

//Execute the Query
$res= mysqli_query($conn, $sql);

//check wether the query execute sucessfully or not
if($res==true)
{
    //Query Executed sucessfully and Admin Deleted
    //echo "Admin Deleted";
    //Create Seesion variable to display message
    $_SESSION['delete']="<div class='success'>Admin Deleted Successfully.</div>";
    
    //REdirect to Manage Admin PAge
    header('location:'.SITEURL.'Admin/manage-admin.php');
}
 else {
     //failed to delete Admin
    //echo "failed to Delete Admin";   
     $_SESSION['delete']="<div class='error'>Failed to Delete Admin. try Agin Later.</div>";
     
  header('location:'.SITEURL.'Admin/manage-admin.php');

}
//3.Redirect to Manage Admin Page with Message

 }