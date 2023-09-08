<?php include './partial/menu.php'; ?>

<?php 
//check whether id is set or not
if(isset($_GET['id']))
{
    
    //Get all the details
    $id=$_GET['id'];
    
    //SQL Query to Get the Selected Food
    $sql2="SELECT * FROM tbl_food WHERE id=$id";
    
  //Execute the query
    $res2= mysqli_query($conn, $sql2);
    
    //Get the value  based on query executed
    $row2= mysqli_fetch_assoc($res2);
      
    //Get the individual Values of Selected Food
    $title=$row2['title'];
    $description=$row2['description'];
    $price=$row2['price'];
    $current_image=$row2['image_name'];
    $current_category=$row2['category_id'];
    $featured=$row2['featured'];
    $active=$row2['active'];
}
 else {
    
     //redirect to Manage Food
     header('location:'.SITEURL.'Admin/manage-food.php');
}

?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        
        <form action="" method="POST" enctype="multipart/form-data">
           
            <table class="tbl-30">
                <tr>
                    
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;  ?>" >
                        
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description;?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>Price: </td>
                    <td>      
  <input type="number" name="price" value="<?php echo $price; ?>" >
                    </td> 
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        
                        <?php
                       if($current_image==""){
                           
                           //Image not Available
                           echo "<div class='error'>Image not Available.</div>";
                     
                           }
 else {
     //image Available
     ?>
     <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100">     
                        <?php
 }
                           
                       
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            
                <?php 
                //Query to Get Active categories
                $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                
                //Execute the Query
                $res= mysqli_query($conn, $sql);
                
                //count Rows
                $count= mysqli_num_rows($res);
                
                //Check whether Category available or not
                if($count>0){
                    //Category Available
                    while ($row= mysqli_fetch_assoc($res)){
                        
                    $category_title=$row['title'];
                    $category_id=$row['id'];
                    //echo "<option value='$category_id'>$category_title</option>";
                     ?>
<option <?php if($current_category==$category_id){echo "selected" ;} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>    
                            <?php 
                    }
                }
                else{
                    //category not Available
                    echo "<option value='0'>Category Not Available.</option>";
                }
                ?>            
                            
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td>featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){ echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){ echo "checked";} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){ echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                       
                        <input <?php if($active=="No"){ echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                
                <tr>
                    <td>
<input type="hidden" name="id" value="<?php echo $id; ?>"> 
<input type="hidden" name="current_image" value="<?php echo $current_image ?>">
<input type="submit" name="submit" value="update food" class="btn-secondary"> 
                               
                    </td>
                </tr>
            </table>
            
        </form>
        
        <?php 
        if(isset($_POST['submit'])){
            
            //echo 'Button clicked';
            
            //1.Get all the details from the form
            $id=$_POST['id'];
            $title=$_POST['title'];
            $description=$_POST['description'];
            $price=$_POST['price'];
            $current_image=$_POST['current_image'];
            $category=$_POST['category'];
            
            $featured=$_POST['featured'];
            $active=$_POST['active'];
            
            //2. Upload the image if selected
            
            //Check whether upload button is clicked or not
            if(isset($_FILES['image']['name'])){
                
                //upload Button clicked
                $image_name=$_FILES['image']['name'];// New Image Name
                   
                //Check whether the file is available or not
                if($image_name!=""){
                  
                    //Image is Available
                    //A.Uploading the Image
                    //Rename the Iamge
                 $ext= end(explode('.', $image_name));//Gets the extension of the image
                 
                 $image_name="Food-Name".rand(0000, 9999).".".$ext;//This will be renamed image
                 
                 //Get the Source path and Destination path
                 $src_path=$_FILES['image']['tmp_name'];//source path
                 
                 $dest_path="../images/food/".$image_name;//Destination path
                 
                 //Upload the Image 
                 $upload= move_uploaded_file($src_path, $dest_path);
                 
                 //check whether the image is uploaded or not
                 if($upload==false){
                    //failed to upload
                     $_SESSION['upload']="<div class='error'>Failed to upload Now Image.</div>";
                     //Redirect to Message Food
                     header('location:'.SITEURL.'Admin/manage-food.php');
                     //Stop the Process
                     die();
                 }
                  //3.Remove the Image i New image is Uploaded and current image exist

                 //B. Remove Current Image If Available
                 if($current_image!=""){
                     //Current Image Is Available
                     //Remove the Image
                     $remove_path="../images/food/".$current_image;
                     
                     $remove= unlink($remove_path);
                     
                     //Check Whether the Image is removed or not
                     if ($remove==false){
                         //failed to remove current image
                         $_SESSION['remove-failed']="<div class='error'>failed to remove curent image.</div>";
                         //Redirect to manage Food
                         header('location:'.SITEURL.'Admin/manage-food.php');
                         //stop the process
                         die();
                     }
                 }
                 
                }
 else {
          $image_name=$current_image;

 }
            }
 else {
     $image_name=$current_image;
  header('location:'.SITEURL.'Admin/manage-food.php');

 }
        
 
 //4. Update the Food in database
 $sql3="UPDATE tbl_food SET
        title='$title',
        description='$description',
            price=$price,
            image_name='$image_name',
               category_id='$category',
            featured='$featured',
            active='$active'
                WHERE id=$id
                
";
 //Execute the SQL QUERY
 $res3= mysqli_query($conn, $sql3);
 
 //Check whether the query is executed or not
 if($res3==true){
     
     //Query Executed and Food Updated
     $_SESSION['update']="<div class='success'>Food Updated Successfully.</div>";
     header('location:'.SITEURL.'Admin/manage-food.php');
 
     
 }
 
 else {
    $_SESSION['update']="<div class='success'>Failed Update Food.</div>";
     header('location:'.SITEURL.'Admin/manage-food.php');
  
 }
 
 }
        ?>
        
    </div>
    
</div>