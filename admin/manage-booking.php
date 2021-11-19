<?php include('partials/menu.php'); ?>

<div class="main-content">
    
    <div class="wrapper">
        <h1>Manage Booking</h1>

        <br /><br />
        <?php
                if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                }
        ?>
        <br /><br />

                        <!-- button to add admin -->
                        

                        
                        <table class="tbl-full">
                        
                                <tr>
                                        <th>S.N.</th>
                                        <th>Room</th>
                                        <th>Price</th>
                                        <th>No.rooms</th>
                                        <th>Duration</th>
                                        <th>Total</th>
                                        <th>Checkin Date</th>
                                        <th>Checkout Date</th>
                                        <th>Status</th>
                                        <th>Customer Name</th>
                                        <th>Contact</th>
                                        <!-- <th>Email</th> -->
                                        <!-- <th>Address</th> -->
                                        <th>Actions</th>
                                </tr>
                               
                                <tr><br></tr>
                                <?php
                                        //get all the bookings from database
                                        $sql = "SELECT * FROM tbl_booking ORDER BY id DESC "; //display the latest bookings first
                                        //execute query
                                        $res = mysqli_query($conn, $sql);
                                        //count the rows
                                        $count= mysqli_num_rows($res);

                                        $sn =1; //create a serial number and set its initial value as 1

                                        if($count>0)
                                        {
                                                //booking available
                                                while($row = mysqli_fetch_assoc($res))
                                                {
                                                        //get all the other details
                                                        $id = $row['id'];
                                                        $room = $row['room'];
                                                        $price = $row['price'];
                                                        $no_rooms = $row['no_rooms'];
                                                        $no_days = $row['no_days'];
                                                        $price = $row['price'];
                                                        $checkin_date = $row['checkin_date'];
                                                        $checkout_date = $row['checkout_date'];
                                                        $status = $row['status'];
                                                        $cust_name = $row['cust_name'];
                                                        $cust_contact = $row['cust_contact'];
                                                        // $cust_email = $row['cust_email'];
                                                        // $cust_address = $row['cust_address'];

                                                        ?>
                                                                <tr>
                                                        
                                                                        <td><?php echo $sn++; ?></td>
                                                                        <td><?php echo $room; ?></td>
                                                                        <td><?php echo $price; ?></td>
                                                                        <td><?php echo $no_rooms; ?></td>
                                                                        <td><?php echo $no_days; ?></td>
                                                                        <td><?php echo $price; ?></td>
                                                                        <td><?php echo $checkin_date; ?></td>
                                                                        <td><?php echo $checkout_date; ?></td>

                                                                        <td>
                                                                                <?php
                                                                                        //booked , on bookinf, checked out ,cancelled
                                                                                        if($status=="Booked"){
                                                                                                echo "<label style='color:green';>$status</label>";
                                                                                        }
                                                                                        elseif($status=="On Booking"){
                                                                                                echo "<label style='color:purple;'>$status</label>";
                                                                                        }
                                                                                        elseif($status=="Check Out"){
                                                                                                echo "<label style='color:blue;'>$status</label>";
                                                                                        }
                                                                                        elseif($status=="Cancelled"){
                                                                                                echo "<label style='color:red;'>$status</label>";
                                                                                        }
                                                                                ?>
                                                                        </td>
                                                                        
                                                                        <td><?php echo $cust_name; ?></td>
                                                                        <td><?php echo $cust_contact; ?></td>

                                                                        
                                                                        <td>
                                                                                <a href="<?php echo SITEURL; ?>admin/update-booking.php?id=<?php echo $id; ?>" class="btn-secondary">Update Booking</a>
                                                                                <!-- <a href="#" class="btn-danger">Delete Booking</a> -->
                                                                        </td>
                                                                </tr>
                                                        <?php
                                                }
                                        }
                                        else{
                                                //booking not available
                                                echo "<tr><td colspan='12' class='error'>Orders Not Available</td></tr>";
                                        
                                        }
                                ?>
                
                                

                                

                               

                                
                        </table>
    </div>

</div>


<?php include('partials/footer.php'); ?>