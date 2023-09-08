 <?php
include '../Admin/partial/menu.php';
?>

<div class="main-content">
    <div class="wrapper">
        
        <h1> Add Admin</h1>
        <br><br>
        <form action="" method="POST">
            
            <table class="tbl-30">
                <tr>
                <td> Full Name:</td>
                
                <td>
                    <input type="text" name="full_name" placeholder="Enter Name">
                </td>
                
                </tr>
                
                 <tr>
                <td> USerName: </td>
                <td><input type="text" name="Username" placeholder="Enter UserName"></td>
                </tr>
                
                 <tr>
                <td> Password: </td>
                <td><input type="password" name="password" placeholder="Enter Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>      
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
include '../Admin/partial/footer.php';
?>

<?php
//procesws the value r form and save it 

// Check wether the submit button is clicked


if (isset($_POST['submit'])){
    
    //Button clicked
    //echo "Button clicked"
    
    

//Get Data from  Form
    $full_name=$_POST['full_name'];
    $username=$_POST['Username'];
    $password= ($_POST['password']);//password encryption with md5
    
   //SQL Query to save the DAta into Database
    
    $sql="INSERT INTO tbl_admin SET
Full_Name='$full_name',
    UserName='$username',
    Password='$password'
             ";
    
    
    //Execute Query And saveData in Database
   $res= mysqli_query($conn, $sql) or die(mysqli_error());   
    
    //4 check whether the ( query is excuted) data is inserted or not and display appropiate message
   
    if ($res==true){
        //DAta Inserted
        //echo 'Data Inserted';
        //create a session variable to Display Message
        $_SESSION['add']="Admin Added Sucessfully";
        
        //Redirect Page
        header('location:'.SITEURL.'Admin/manage-admin.php');
    }
    else{
        //Failed to Insert Data
        //echo 'Failed to Insert Data';
        
        //create a session variable to Display Message
        $_SESSION['add']="Admin Added Failed";
        
        //Redirect Page
        header("location:".SITEURL.'Admin/add-admin.php');
    }
    
}
        ?>
