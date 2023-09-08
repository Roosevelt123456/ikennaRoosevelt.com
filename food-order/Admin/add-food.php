55<?php
include './partial/menu.php';
?>
<div class="main-content">
    <div class="wrapper">
        
        <h1>Add Food</h1>
        <br><br>
        
        <?php  
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            
            <table class="tbl-30">
                
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="title">  
                    </td>
                </tr>
                <td>Description</td>
                <td>
                    <textarea name="description" cols="30" rows="5" placeholder="Description of the food."></textarea>
                    
                </td>
                <tr>
                    <td></td>
                </tr>
                
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                
                <tr>
                    <td>Selected Image: </td>
                    <td>
                        <input type="file" name="image">
                      
                    </td>
                </tr>
                
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category">
                            
                        <?php 
                        //create PHP Code to display category from Database
                        //1.Create SQL to get all active Categories from database
                        $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                        
                        //Executing Query
                        $res= mysqli_query($conn, $sql);
                        
                        //count Rows to check whether we have categories or not
                        $count= mysqli_num_rows($res);
                        
                        //If count is greater than Zero, we have Categories else we have categories
                        if($count>0){
                            //we have categories
                            while ($row= mysqli_fetch_assoc($res)){
                               
                                //Get the details of categories
                                $id=$row['id'];
                                $title=$row['title'];
                                
                                ?>
                            
                            <option value="<?php echo $id; ?>"> <?php echo  $title; ?> </option>
                           
 <?php
                            }
                        }
 else {
     //We do not have cate
     
     ?>
     <option value="0">No Category Found</option> 
                            
     <?php
     
 }
 //2. Display on Dropdown
                        ?>
                            
                            
                            
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>    
                </tr>
                  
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">  
                </tr>
            </table>      
        </form>
        
<?php  
//Chechk whether the button is checked or not
if(isset($_POST['submit'])){

//Add the Food in Database
   // echo 'clicked';
    
$title=$_POST['title'];
$description=$_POST['description'];
$price=$_POST['price'];
$category=$_POST['category'];

//check whether button for featured and active are checked or not
if($_POST['featured'])
    {
    $featured=$_POST['featured'];
            
    
}
 else {
    $featured="No";
}
if(isset($_POST['active'])){
    $active=$_POST['active'];
}
 else {
    $active="No"; //Setting default Value
}
//1.Get the Data from Form

//2.Upload the Image If Selected
//Check whether the Select Image is Clicked or not and Upload the image if the Image is Selected
if(isset($_FILES['image']['name'])){
    
    //Get the Details of the Selected image
    $image_name=$_FILES['image']['name'];
    
    //Check whether the image is selecte or not and upload image only if selected
    if($image_name!=""){
       
     //Image is Selected
     //Get the extension of selected image(jpg,png,gif,etc)
        $ext= end(explode('.',$image_name));
        
        //create new Name for image
        $image_name="Food-Name-".rand(0000, 9999).".".$ext;//New Image Name may be "Food-Name-345.jgp"


//B.Upload the Image
//Get the src path and Destination path
  
        
//source path is the current location of the image
$src=$_FILES['image']['tmp_name'];
        

//Destination path for  the image to be uploaded        
  $dst="../images/food/".$image_name; 
  
  // finally upload the food Image
  $upload= move_uploaded_file($src, $dst);
  
  //check whether image uploaded or not
  if($upload==false){
   //failed   to upload the image
     //Redirect to Add Food with Error Message
      $_SESSION['upload']="<div class='error'>Failed to Upload Image.</div>";
      header('location:'.SITEURL.'Admin/add-food.php');
      //Stop the Process
      die();
  }
    }
            
 
    
}
 else {
   $image_name="" ;//seting Default value s blank
}

//3.Insert Into database    

//Create a SQL Query to save or Add Food
// for numerical we do not need to pass value insde quotes " but for string value it is compulsory to add quotes"
$sql2="INSERT INTO tbl_food SET
    title='$title',
     description='$description',        
     price='$price',
     image_name='$image_name',
     category_id='$category',
         featured='$featured',
             active='$active'
        ";
//4.Redirect with message to manage food page

//Execute the query
$res2= mysqli_query($conn, $sql2);

//4. Redirect with message to manage food page
//check whether data inserted or not
if($res2==true){
    
    //Data insered successfully
    $_SESSION['add']="<div class='success'>Food Added Sucessfully.</div>";
    header('location:'.SITEURL.'Admin/manage-food.php');
    
    
}
 else {
   
     //failed to insert Data
     $_SESSION['add']="<div class='success'>Failed Added Food.</div>";
    header('location:'.SITEURL.'Admin/manage-food.php');
    
}
    }

?>
        
    </div> 
   
</div>



<?php include '../Admin/partial/footer.php'; ?>