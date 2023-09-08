
<?php
include '../Admin/partial/menu.php';
?>


        <!---- Main Content Section Starts---->
        <div class="main-content">
            <div class="wrapper">
                <h1>DASHBOARD</h1>
                <br><br>
                
                 <?php 
           if(isset($_SESSION['login'])){
               
               echo $_SESSION['login'];
               unset($_SESSION['login']);
           }
           ?>
                <br><br>
                <div class="col-4 text-center">
                    <?php
                    //sql Query
                    $sql="SELECT * FROM tbl_category";
                    //Excute query
                    $res= mysqli_query($conn, $sql);
                    
                    //Count rows
                    $count= mysqli_num_rows($res);
                          
                    ?>
                    <h1><?php echo $count; ?></h1>
                    <br/>
                    Categories
                </div>
                
                 <div class="col-4 text-center">
                     
                     <?php
                    //sql Query
                    $sql2="SELECT * FROM tbl_food";
                    //Exute_quer
                    $res2= mysqli_query($conn, $sql2);
                    
                    //Count rows
                    $count= mysqli_num_rows($res2);
                          
                    ?>
                     <h1><?php echo $count; ?></h1>
                    <br/>
                    Foods
                </div>
                
                
                 <div class="col-4 text-center">
                      <?php
                    //sql Query
                    $sql3="SELECT * FROM tbl_order";
                    //Excute query
                    $res3= mysqli_query($conn, $sql3);
                    
                    //Count rows
                    $count= mysqli_num_rows($res3);
                          
                    ?>
                     
                   <h1><?php echo $count; ?></h1>
                    <br/>
                    Total Orders
                </div>
                 <div class="col-4 text-center">
                     
                      <?php
                    //create Sql query to get toal revenue generated
                      //Aggregate function in SQL
                    $sql4="SELECT SUM(total) AS Total FROM tbl_order Where status='Delivered'";
                    //Excute the query
                    $res4= mysqli_query($conn, $sql4);
                    
                    //get the Value
                    $row4= mysqli_fetch_assoc($res4);
                    
                    //Get the Total Revenue
                    $total_revenue=$row4['Total'];
                          
                    
                          
                    ?>
                     <h1><?php echo $total_revenue; ?></h1>
                    <br/>
                    Revenue Generated
                </div>
                <div class="clearfix">
                    
                </div>
        </div>
        </div>
        <?php
        include '../Admin/partial/footer.php';
          ?>  
