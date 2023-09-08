<?php
//Include Constant pgae
include ('../config/constant.php');

//echo'Delete page';

if(isset($_GET['id'])&& isset($_GET['image_name']))// either use '&&' or 'AND'
    {
   //process to Delete
   //echo "process  to delete";
    
    //1.Get ID and Image Name
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    
    //Remove Image i available
    //Check whether the Iamge is available or not and delete only if Available
    if($image_name!=""){
       
        //IT has image and need to remove from folder
        //Get the Image path
        $path="../images/food/".$image_name;
        
        //remove Image file From Folder
        $remove= unlink($path);
        
        //check whether the Image is removed or not
        if($remove==false){
           
            //failed to Remove Image
            $_SESSION['upload']="<div class='error'>Failed to Remove Image File.</div>";
            //Redirect to Manage food
            header('location:'.SITEURL.'Admin/manage-food.php');
            //Stop the Process of Deleting Food
            die();
        }
    }
    //3. Delete Food From Database
    //$sql3="DELETE FROM tbl_food WHERE id=$id";
    $sql4="DELETE FROM tbl_food WHERE id = $id";
    //Execute the Query
    $res= mysqli_query($conn, $sql4);
    
    //Check Whether the query executed or not and the session message respectively
     //4.Redirect to Manage food with Session Message
    if($res==true){
       //food Deleted 
        $_SESSION['delete']="<div class='success'>Food Deleted Successfully.</div>";\
        header('location'.SITEURL.'Admin/manage-food.php'); 
    
        
    }
 else {
    //failed to delete food 
     $_SESSION['delete']="<div class='error'>Failed To Delete Food.</div>";\
        header('location:'.SITEURL.'Admin/manage-food.php'); 
    
    }
   
}
 else {
   //Redirect  to message food page
     //echo "Redirect";
     $_SESSION['unauthorize']="<div class='error'>Unauthorized Access.</div>";
     header('location:'.SITEURL.'Admin/manage-food.php');
     
 }
?>

