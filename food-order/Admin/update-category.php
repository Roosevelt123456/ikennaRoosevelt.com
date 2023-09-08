<?php
include './partial/menu.php';
?>

<div class="main-content">
    <div class=" wrapper">
        <h1>Update Category</h1>
       
        <br><br>
        
        <?php 
        //check whether the id is set or not
        if(isset($_GET['id'])){
            
           //Get the ID and all other details
           //echo 'welcome';
            $id=$_GET['id'];
            //Create SQL Query to get all other details
            $sql="SELECT * FROM tbl_category WHERE id=$id";
            
            //Execute the Query
            $res= mysqli_query($conn, $sql);
             
            //count the rows to check whether the id is valid or not
            $count= mysqli_num_rows($res);
            
            if($count==1){
                
                //Get all the data
                $row= mysqli_fetch_assoc($res);
                $title=$row['title'];
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];
            }
 else { 
     
     //Redirect to manage category with session message
     $_SESSION['no-category-found']="<div class='error'>category not Found.</div>";
     header('location:'.SITEURL.'Admin/manage-category.php');
 }     
        }
 else {
     //Redirect to Manage Category
     header('location:'.SITEURL.'Admin/manage-category.php');
     
 }
           
        ?>
        
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Current Imagen</td>
                    <td>
                        <?php  
                        if($current_image!=""){
                            
                             //Display the image
                            ?>
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100">                         
                        <?php
                        }
                         else {
                                    //Display the image
                      echo "<div class='error'>image not Added.</div>";
                                      }
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                
                <tr>
                    <td>Featured</td>
                    <td>
                        <input <?php if($featured=="Yes"){ echo "checked";}?> type="radio" name="featured" value="Yes">Yes
   
                        <input <?php if($featured=="No"){ echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                
                <tr>
                    <td>Active</td>
                    <td>
                        <input <?php if($active=="Yes"){ echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){ echo "checked"; }?> type="radio" name="active" value="No">No  
                    </td>
                </tr>
                
                <tr>
                    <td>
<input type="hidden" name="current_image" value="<?php echo $current_image; ?>"> 
<input type="hidden" name="id" value="<?php echo $id; ?>">
   <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                        
                    </td>
                </tr>
            </table>
        </form>
         
        <?php   
if (isset($_POST['submit'])){
    //echo 'welcome';
    //1. Get all the values from user form
    $id=$_POST['id'];
    $title=$_POST['title'];
    $featured=$_POST['featured'];
    $current_image=$_POST['current_image'];
    $active=$_POST['active'];
    
    //2. Update new image if selected
    //check whether the image is selected or not
   if(isset($_FILES['image']['name'])){
       
       //Get the Image Details
       $image_name=$_FILES['image']['name'];
   
   //check whethe the image is available or not
   if($image_name !=""){
    //Image Available 
       //A.Upload the New Image
       
       //Auto Rename our Images
     //Get the Extension of our Image (jpg,png,gif,etc) e.g "specialfood1.jpg"
       $ext= end(explode('.', $image_name));

     
     //renmae the image
     $image_name="food_category_".rand(000, 999).'.'.$ext;
  
     
 $source_path=$_FILES['image']['tmp_name'];
 
$desination_path="../images/category/".$image_name;

//Finnally Upload the Image
$upload= move_uploaded_file($source_path, $desination_path);
 //check whether the image is uploaded or not

//and if the image is not uploaded then we will stop the process and redirect with error message
if($upload==false){
    
    //set message
    $_SESSION['upload']="<div class='error'>failed to upload image.</div>";
    //Redirect to Add Category Page
    header('location:'.SITEURL.'Admin/manage-category.php');
   //stop the process
    die();
}    
       
       //B.Remove the Current Image. if available
if($current_image!=""){
 $remove_path="../images/category/".$current_image;

$remove= unlink($remove_path);

//Check whether the image is removed or not
//if ailed to remove then display message and stop process
if($remove==false){
    
    //ailed to remove image
    $_SESSION['failed-remove']="<div class='error'>Failed to Remove Current Image.</div>";
    header('location:'.SITEURL.'Admin/manage-category.php');
    die();//stop the process   
}

}   

}
 else {
           $image_name=$current_image;
 
   }
   }
 else {
    
     $image_name=$current_image;
   }
   
    //3.update the database
    $sql2="UPDATE tbl_category SET 
        title='$title',
            image_name='$image_name',
        featured='$featured',
         active='$active'
             WHERE id=$id;
        ";
    
    //Execute the Query
    $res2= mysqli_query($conn, $sql2);
    
    //4.Redirect to message category with message
   if($res2==true){
       
       //category updated
       $_SESSION['update']="<div class='success'>Category Updated Successfully.</div>";
       header('location:'.SITEURL.'Admin/manage-category.php');
       
   }
 else {
     //ailed to update category
       $_SESSION['update']="<div class='success'>Category Updated Successfully.</div>";
       header('location:'.SITEURL.'Admin/manage-category.php');
       
   }
}
        
        ?>
        
    </div>
</div>


<?php  
include './partial/footer.php';
?>