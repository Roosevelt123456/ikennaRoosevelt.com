<?php
//include connection
include '../config/constant.php';
//echo 'Delete';
//check whether the id and image_name is set or not
if(isset($_GET['id']) AND isset($_GET['image_name'])){
    
    //Get the value aand delete

   // echo "get values and delete";
    
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
       
    //remove the physical image file is available 
    if($image_name!=""){
        
        //image is Available. so remove
        //$path=";../images/category/".$image_name;
        $path="../images/category/".$image_name;
        //Remove the image
      $remove= unlink($path);
        
        //if failed to remove image add an error message and stop the process
        if ($remove==false){
            //set the SEssion Message
            $_SESSION['remove']="<div class='error'>Failed to Remove Category Image.</div>";
            
            //Redirect to Message category page
            header('location:'.SITEURL.'Admin/manage-category.php');
            //stop the process
            die();
        }
    }
    //Delete Data from Database
    //SQL Query to Delete from Database
    $sql="DELETE FROM tbl_category WHERE id=$id";
    
    //Execute the Query
    $res= mysqli_query($conn, $sql);
    
    //check whether the data is deleted from database or not
    if ($res==true){
        
        //set session message and redirect
        $_SESSION['delete']="<div class='success'> Deleted Successfuly.</div>";
       
        
        //Redirect the Message Category
        header('location:'.SITEURL.'Admin/manage-category.php');
        
    }
 else {
      
     //SET fail Message and Redirect
     //set session message and redirect
        $_SESSION['delete']="<div class='error'>Failed To Deleted category.</div>";
       
        
        //Redirect the Message Category
        header('location:'.SITEURL.'Admin/manage-category.php');
        
    }
}
 else {
    
     //redirect to manage category page
     header('location:'.SITEURL.'Admin/manage-category.php');
}
 
?>
