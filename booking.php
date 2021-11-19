<?php
ob_start();
?>
<?php include('partials-front/menu.php'); ?>>

    <?php
        //check whether room id is set or not
        if(isset($_GET['room_id']))
        {
            //get the room id and details of the selected room
            $room_id = $_GET['room_id'];

            //get the details of the selected room
            $sql ="SELECT * FROM tbl_room WHERE id=$room_id";

            //execute the query
            $res = mysqli_query($conn, $sql);

            //count the rows
            $count = mysqli_num_rows($res);
            //check whether the data is available or not
            if($count==1)
            {
                //we have data
                //get the data from database
                $row = mysqli_fetch_assoc($res);
                $title =$row ['title'];
                $price =$row ['price'];
                $image_name =$row ['image_name'];
            }
            else{
                //room not available
                //redirect to home page
                header('location:'.SITEURL);
            }
        }
        else{
            //redirect to homepage
            header('location:'.SITEURL);
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="room1-search" >
        <div class="container" >
            
            <h2 class="text-center">Fill this form to confirm your Booking.</h2>

            <form action="" method="POST" class="booking" >
                <fieldset>
                    <legend>Selected Room</legend>

                    <div class="Hotel-Rooms-img">
                        <?php
                            //check whether image name is avilable or not
                            if($image_name=="")
                            {
                                //image not avilable display message
                                echo "<div class='error'>image not avilable</div>"; 
                            }
                            else{
                                //image avilable
                                ?>                            
                                <img src="<?php echo SITEURL; ?>images/room/<?php echo $image_name; ?>" alt="Deluxe Or Standard Room" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                        
                    </div>
    
                    <div class="Hotel-Rooms-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="room" value="<?php echo $title; ?>">

                        <p class="Room-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                       <div class="booking-label">No.of rooms</div>
                        <input type="number" name="no_rooms" class="input-responsive" value="1" required>

                        <div class="booking-label">Duration of Stay in days</div>
                        <input type="number" name="no_days" class="input-responsive" value="1" required>

                        
                        
                    </div>
 
                </fieldset>

                
                
                <fieldset>
                    <legend>Booking Details</legend>
                    <div class="booking-label">Full Name</div>
                    <input type="text" name="cust_name" placeholder="E.g. poonam bhilare" class="input-responsive" required>

                    <div class="booking-label">Phone Number</div>
                    <input type="tel" name="cust_contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="booking-label">Email</div>
                    <input type="email" name="cust_email" placeholder="E.g. hi@poonam.com" class="input-responsive" required>

                    <div class="booking-label">Address</div>
                    <textarea name="cust_address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <div class="booking-label">Check-in-date</div>
                    <!-- <textarea type="datetime-local" name="checkin_date" placeholder="E.g. 30 oct 2021" class="input-responsive" required></textarea> -->
                    <input type="date" name="checkin_date" placeholder="E.g. 30 oct 2021" class="input-responsive">
                    
                    <div class="booking-label">Check-out-date</div>
                    <!-- <textarea type="datetime-local" name="checkout_date" placeholder="E.g. 31 oct 2021" class="input-responsive" required></textarea> -->
                    <input type="date" name="checkout_date" placeholder="E.g. 31 oct 2021" class="input-responsive">
                    
                    <input type="submit" name="submit" value="Confirm Booking" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                //check whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //get all the details from the form

                    $room = $_POST['room'];
                    $price = $_POST['price'];
                    $no_rooms = $_POST['no_rooms'];
                    $no_days = $_POST['no_days'];
                    $total = $price * $no_rooms * $no_days;//total=price x qty
                    //$checkin_date = date("Y-m-d h:i:s");//check in date
                   // $checkout_date = date("Y-m-d h:i:s");//check out date
                    $checkin_date = $_POST['checkin_date'];
                    $checkout_date = $_POST['checkout_date'];
                    $status = "booked"; //booked , on booking, cancelled
                    $cust_name = $_POST['cust_name'];
                    $cust_contact = $_POST['cust_contact'];
                    $cust_email = $_POST['cust_email'];
                    $cust_address = $_POST['cust_address'];

                    //save the order in database
                    //create sql to save the data
                    $sql2 = "INSERT INTO tbl_booking SET
                        room = '$room',
                        price = $price,
                        no_rooms = $no_rooms,
                        no_days = $no_days,
                        total = $total,
                        checkin_date = '$checkin_date',
                        checkout_date = '$checkout_date',
                        status = '$status',
                        cust_name = '$cust_name',
                        cust_contact = '$cust_contact',
                        cust_email = '$cust_email',
                        cust_address = '$cust_address'

                    ";
                    //echo $sql2; die();
                    //$sql2; die();

                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    //check whether query executed succesfully or not
                    if($res2 == true)
                    {
                        //query executed and order saved
                        $_SESSION['booking'] = "<div class='success text-center'><b>ROOM BOOKED SUCCESSFULLY</b></div>";
                        header('location:'.SITEURL);
                        
                    }
                    else{
                        //failed to save order
                        $_SESSION['booking'] = "<div class='error text-center'>Failed to Book Your Room.</div>";
                        header('location:'.SITEURL);
                        ob_end_flush();
                    }
                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    

   

    
    <?php include('partials-front/footer.php'); ?>