<?php
include '../Admin/partial/menu.php';
?>

<!---- Main Content Section Starts---->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Order</h1>
                <br/><br/></br>
                 
                <?php  
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                ?>
                </br></br>
                <!--- Button to Add Admin-->
                <a href="#" class="btn-primary">Admin Order</a>
                
 <br/> <br/><br/>
                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Food</th>
                      <th>Price</th>
                      <th>Qty</th>
                      <th>Total</th>    
                      <th>Order Date</th>    
                      <th>Status</th>    
                      <th>Customer_Name</th>
                      <th>Contact</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th>Actions</th>    
                    </tr>
                    
                    <?php
                    //Get all the orders from Database
                    $sql="SELECT * FROM tbl_order ORDER BY id DESC";//Display latest Order first
                    
                    //Execute the Query
                    $res= mysqli_query($conn, $sql);
                    
                    //Count the Rows
                    $count= mysqli_num_rows($res);
                    $sn=1; //create a serial number number and its initial value to 1
                    if($count>0){
                        
                        //Order Available
                        while($row= mysqli_fetch_assoc($res)){
                            $id=$row['id'];
                            $food=$row['food'];
                            $price=$row['price'];
                            $qty=$row['qty'];
                            $total=$row['total'];
                            $order_date=$row['order_date'];
                            $status=$row['status'];
                            $customer_name=$row['customer_name'];
                            $customer_contact=$row['customer_contact'];
                            $customer_email=$row['customer_email'];
                            $customer_address=$row['customer_address'];
                        
                            
                            ?>
                    
                    <tr>
                        <td><?php echo $sn++;?></td>
                        <td><?php echo $food;?></td>
                        <td><?php echo $price;?></td>
                        <td><?php echo $qty;?></td>
                        <td><?php echo $total;?></td>
                        <td><?php echo $order_date;?></td>
                        
                        
                        
                        <td>
                            
                            <?php
                            //Ordered on Delivery,Delievered,cancelled
                            if($status=="Ordered"){
                                echo "<label>$status</lable>";
                                
                            }elseif ($status=="On Delivery") {
                                echo "<lable style='color:orange;'>$status</lable>";
                            }
                            elseif ($status=="Delivered") {
                                echo "<lable style='color:green;'>$status</lable>";
                        }
                        elseif ($status=="Cancelled") {
                            echo "<label style='color:blue'>$status</lable>";
                    }
                                
                            
                            ?>
                        </td>
                        <td><?php echo $customer_name;?></td>
                        <td><?php echo $customer_contact;?></td>
                        <td><?php echo $customer_email;?></td>
                        <td><?php echo $customer_address;?></td>
                     
                        <td>
                            <a href="<?php echo SITEURL ?>Admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
 else {
     //order not available
     echo "<div class='error'>Orders not Available.</div>";
 }
                    ?>
                    
                    
                    
                    
                </table>

            </div>
        </div>

<?php
include '../Admin/partial/footer.php';
?>