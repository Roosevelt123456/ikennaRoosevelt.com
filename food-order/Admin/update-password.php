<?php
include( './partial/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1> Change Password</h1>
        <br><br>
        <?php 
        if(isset($_GET['id'])){
            $id=$_GET['id'];
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td> Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="current password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                
                <tr>
                    <td> Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        
                    </td>
                </tr>
            </table>
        </form>
        
        
    </div>
</div>

<?php 

//check whether the submit button is clicked or not
if(isset($_POST['submit'])){
    //echo"clicked";
    //1.Get the Data from Form
   //$id=$_POST['id'];
    $current_password= md5($_POST['current_password']);
    $new_password= md5($_POST['new_password']);
    $confirm_password= md5($_POST['confirm_password']);
    
    //2.check whether user with current id and current password exists or not
    $sql="SELECT * FROM tbl_admin WHERE id=$id AND Password='$current_password'";
    
    //Execute Query
    $res= mysqli_query($conn, $sql);
    
    if($res==true){

//check whether data is available or not
$count= mysqli_num_rows($res);

if ($count==1){
   
    //user exits and password can be changed
    //echo 'found';
    //Check whether the new password and confirm match or not
    if ($new_password==$confirm_password){
        //update the password
       // echo 'password match';
        $sql2="UPDATE tbl_admin SET
            Password='$new_password'
                WHERE id=$id
                ";
        //Execute the Query
        $res2= mysqli_query($conn, $sql2);
        //check whether the query executed or not
        if($res2==true){
//Display Success message 
 //Redirect to Manage Admin Page with Error Message
$_SESSION['change-pwd']="<div class='success'>Password change Successfully.</div>";
//Redirect the user
header('location:'.SITEURL.'Admin/manage-admin.php');
        }
 else {
     
     //Display Error Message
     //Redirect to Manage Admin Page with Error Message
     $_SESSION['change-pwd']="<div class='error'>Failed to change password.</div>";
     //Redirect the user
     header('location:'.SITEURL.'Admin/manage-admin.php');
 }
         
    }
    
 else {
       //Redirect to Manage Admin Page with Error Message
     $_SESSION['pwd-not-match']="<div class='error'>Password Did Not Match.</div>";
     //Redirect the user
     header('location:'.SITEURL.'Admin/manage-admin.php');
    }
} 
 else {
    
     //user Does not exist set message and direct
     $_SESSION['user-not-found']="<div class='error'>User Not found.</div>";
     //Redirect the user
     header('location:'.SITEURL.'Admin/manage-admin.php');
}
    }
    //3. check whether the password and confirmpassword match or not
   
    //4.change password if all is true
 
}


?>


<?php 
include ('./partial/footer.php');
?>
