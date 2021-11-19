<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Booking </h1>
        <br><br>

        <?php
            //check whether id is set or not
            if(isset($_GET['id']))
            {
                //get the booking details
                $id = $_GET['id'];

                //get all the other details based on this id
                //sql query to get the booking detaiks
                $sql = "SELECT * FROM tbl_booking WHERE id=$id";
                //execute query
                $res = mysqli_query($conn, $sql);
                //count rows
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //detail available
                    $row = mysqli_fetch_assoc($res);

                    $room= $row['room'];
                    $price= $row['price'];
                    $no_rooms= $row['no_rooms'];
                    $no_days= $row['no_days'];
                    $status= $row['status'];
                    $cust_name= $row['cust_name'];
                    $cust_contact= $row['cust_contact'];
                    $cust_email= $row['cust_email'];
                    $cust_address= $row['cust_address'];
                }
                else{
                    //detail not available
                    //redirect to manage order
                    header('location:'.SITEURL.'admin/manage-booking.php');
                }
            }
            else{
                //redirect to manage order page
                header('location:'.SITEURL.'admin/manage-booking.php');
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Room Title:</td>
                    <td>
                        <b><?php echo $room;?></b>
                    </td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <b>$<?php echo $price;?></b>
                    </td>
                </tr>
                <tr>
                    <td>No. of Rooms:</td>
                    <td>
                        <input type="number" name="no_rooms" value="<?php echo $no_rooms;?>">
                    </td>
                </tr>

                <tr>
                    <td>Duration of stay in days:</td>
                    <td>
                        <input type="number" name="no_days" value="<?php echo $no_days;?>">
                    </td>
                </tr>

                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status" >
                            <option <?php if($status=="Booked"){echo "selected";} ?> value="Booked">Booked</option>
                            <option <?php if($status=="On Booking"){echo "selected";} ?> value="On Booking">On Booking</option>
                            <option <?php if($status=="Check Out"){echo "selected";} ?> value="Check Out">Check Out</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="cust_name" value="<?php echo $cust_name;?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="cust_contact" value="<?php echo $cust_contact;?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="text" name="cust_email" value="<?php echo $cust_email;?>">
                    </td>
                </tr> 

                <tr>
                    <td>Customer Address:</td>
                    <td>
                        <textarea name="cust_address"  cols="30" rows="5"> <?php echo $cust_address;?></textarea>
                    </td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="price" value="<?php echo $price;?>">  
                        <input type="submit" name="submit" value="Update Booking" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            //check whether update button is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                //get all values from form
                $id=$_POST['id'];
                $price=$_POST['price'];
                $no_rooms=$_POST['no_rooms'];
                $no_days=$_POST['no_days'];
                $total = $price*$no_rooms*$no_days;
                $status=$_POST['status'];
                $cust_name=$_POST['cust_name'];
                $cust_contact=$_POST['cust_contact'];
                $cust_email=$_POST['cust_email'];
                $cust_address=$_POST['cust_address'];

                //update the values
                $sql2 = "UPDATE tbl_booking SET
                no_rooms=$no_rooms,
                no_days=$no_days,
                total=$total,
                status= '$status',
                cust_name = '$cust_name',
                cust_contact = '$cust_contact',
                cust_email = '$cust_email',
                cust_address = '$cust_address'
                WHERE id=$id;
                
                ";

                //execute query
                $res2 = mysqli_query($conn, $sql2);
                //redirect to manage bookinds with message
                //check whether the query executed successfully or not
                if($res2 == true){
                    // updated
                    $_SESSION['update']= "<div class= 'success'>Booking updated successfully.</div>";
                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-booking.php');
                }
                else{
                    //failed to updated
                    $_SESSION['update']= "<div class= 'error'>Failed to update bookings.</div>";
                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-booking.php');
                }
                
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>