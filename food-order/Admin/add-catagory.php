<?php
include './partial/menu.php';
?>
<div class="main-content">
    <div class="wrapper">
        
        <h1>Add Category</h1>
        <br><br>
        
        <?php 
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        
        
        <!-- Add Category form Starts-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td>
           <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    
                    <td>Featured</td>
                    <td>
  <input type="radio" name="featured" value="yes">Yes
  <input type="radio" name="featured" value="No">No
 
                    </td>
                </tr>
                
                <tr>
                    
                    <td>Active</td>
                    <td>
  <input type="radio" name="active" value="yes">Yes
  <input type="radio" name="active" value="No">No
 
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>    
                </tr>
                
            </table>
            
        </form>
        
        <!-- Add Category form Ends-->

        <?php 
        //Check whether the submit Button is checked or not
        
        if(isset($_POST['submit'])){
           // echo 'clicked';
            //1.Get the values From category form
            $title=$_POST['title'];
            
            //for radio input, we need to check whether the botton is selected or not
             if(isset($_POST['featured'])){

//Get the Value From Form  
                 $featured=$_POST['featured'];
             }
             else{
                 //Set the Default values
                 $featured="No";
             }
             
             if (isset($_POST['active'])){
                 
                 $active=$_POST['active'];
                 
             }
 else {
     $active="No";
 }
 //check whether the Image is Selected or not and set The values for Image name Accordingly
// print_r($_FILES['image']);
 //die();//Break the Code here
 
 
 if(isset($_FILES['image']['name'])){
     //upload the image
     //To upload image we need image name, source path destination path
     $image_name=$_FILES['image']['name'];
     
     //upload the Image only if image is selected
     if($image_name!=""){
    
          
 
     
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
    header('location:'.SITEURL.'Admin/add-catagory.php');
   //stop the process
    die();
}   
}

 }
 else {
    //Don't upload Image and set the image_name as blank 
 $image_name="";
 }
  
  
 
  
  
 //2. create SQL Query to insert Category late Databases
 $sql="INSERT INTO tbl_category SET
     title='$title',
     image_name='$image_name',
     featured='$featured',
     active='$active'
     ";
 //3. Execute the Query and Save in Database
 $res=mysqli_query($conn,$sql);
 
 //4. check whether the query executed or not and data added or not
  if($res==true){
      
      //Query Executed and Category Added
  $_SESSION['add']="<div class='success'>Category Added Successfully.</div>";
//Redirect to Manage Category page
        header('location:'.SITEURL.'Admin/manage-category.php');
  }  
 else {
    
     //failed to Add Category
      $_SESSION['add']="<div class='error'>failed to Add Category.</div>";
//Redirect to manage category Page
        header('location:'.SITEURL.'Admin/add-catagory.php');
  }
        }
            
        
        ?>
        
    </div>
</div>



<?php
include './partial/footer.php';
?>



