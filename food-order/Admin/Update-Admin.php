<?php
include ('partial/menu.php');
?>
<div class="main-contet">
    
    <div class="wrapper">
        <h1>Update Admin</h1>
        
        <br><br>
        
        
        <?php 
        
          # code...
        
        //1.get the ID of the Selected Admin
        $id=$_GET['id'];
        
        //2.Create SQL Qery to GEt The Details
        $sql="SELECT * FROM tbl_admin WHERE 'id'=$id";
        
        //Execute the query
        $res= mysqli_query($conn, $sql);
       
        //check wether the query is executed or not
         if($res==true){
            
            //check wether the data is available or not
            $count= mysqli_num_rows($res);
            if($count==1){
                //Get the details
                //echo "Admin Available";
                 $rows= mysqli_fetch_assoc($res);
                $full_name=$rows['Full_Name'];
                $username=$rows['UserName'];
            }
            else{
                //Redirect to mnage admin Page
                header('laction:'.SITEURL.'admin/manage_-admin.php');
            }
        }
        
 
        ?>
        
        
        <form action="" method="POST">
            
            <table class="tbl-30">
                <tr>
                    <td>full Name:</td>
                     <td>
                         <input type="text" name="full_name" value="<?php echo $full_name;?>">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username;?>">
                    </td>
                </tr>
                    
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                    
                </tr>
            </table>
        </form>
        
    </div>
</div>
       <?php 
       //check whether the Submit button is clicked or not
       
       if(isset($_POST['submit'])){
           
          // echo 'Sumbited ';
           
           //Get all values from form to update
            $id=$_POST['id'];
            $full_name=$_POST['full_name'];
            $username=$_POST['username'];
           
           //create sqli query to update admin
            $sql="UPDATE tbl_admin SET
                  Full_Name='$full_name',
                  UserName='$username'
                  WHERE id='$id'
                  ";
                    
            
            //Execute the Query
            $res= mysqli_query($conn, $sql);
            
            //Check wherher query is executed successfully or not
            if($res==true){
                //Query Executed and Admin updated
$_SESSION['update']="<div class='Success'> Admin Upate Successfully.</div>";

//Redirect to manage Admin Page
header('location:'.SITEURL.'Admin/manage-admin.php');
        }
 else {
     
     //failed to update Admin
     $_SESSION['update']="<div class='error'> Failed to UpDate Admin.</div>";

//Redirect to manage Admin Page
header('location:'.SITEURL.'Admin/manage-admin.php');
 }
       }
       ?>
      
       
<?php
include 'partial/footer.php';
?>