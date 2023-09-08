
<?php 
include ('../config/constant.php');
?>
<html>
    <head>
        <title>LOgin -food order system</title>
        <link rel="stylesheet" href="../css/admin.css">     
   </head>
   
   <body>
       <div class="login">
           <h2 class="text-center">Login</h2>
           <br><br>
           
           <?php 
           if(isset($_SESSION['login'])){
               
               echo $_SESSION['login'];
               unset($_SESSION['login']);
           }
           if(isset($_SESSION['no-login-message'])){
              
               echo $_SESSION['no-login-message'];
               unset($_SESSION['no-login-message']);
           }
           ?>
           <br><br>
           <!--     Login Form start Here    -->
           <form action="" method="POST" class="text-center">
               
               Usernmae:
               <input type="text" name="username" placeholder="Enter username">
               <br><br> 
               Password:
               <input type="password" name="password" placeholder="Enter password">
               <br><br>
               <input type="submit" name="submit" value="login" class="btn-primary">   
           </form>  
           <!--     Login Form Ends Here    -->
           
           <p class="text-center">Created By -<a href="roose.com">Roose Ikenna</a></p>
       </div>
       
   </body>
   
</html>

<?php   
//check whether the submit button is click or not
if(isset($_POST['submit'])){
    
    //process for Login
    //GEt the Data from the Login Form
   echo $username= ($_POST['username']);
   echo $password= ($_POST['password']);
    
    //2.Sql to check whether the user with username and password exists or not
   $sql="SELECT * FROM tbl_admin WHERE UserName='$username' AND Password='$password'";
   
   //3.Execute the query
   $res= mysqli_query($conn, $sql);
   
   //count rows to check whether the user exists or not
   $count= mysqli_num_rows($res);
   
   if($count==1){
       
       //user Available and login Success
       $_SESSION['login']="<div class='success'>login successful.</div>";
      
       
       $_SESSION['user']=$username;//To check whether user is login or not and logout will unset it
        

//redirect to  Home Page/Dashboard
       header('location:'.SITEURL.'Admin/');
   }
 else {
       //User not Available and login fall
     $_SESSION['login']="<div class='error text-center'>Username or password did not match.</div>";
      
       //redirect to  Home Page/Dashboard
       header('location:'.SITEURL.'Admin/login.php');
   }
}
?>