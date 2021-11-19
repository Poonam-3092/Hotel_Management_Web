<?php include('partials-front/menu.php'); ?>

    
     <!-- travel search section start here -->
     <section class= "room-search text-center">
        <div class="container">
           <form action="<?php echo SITEURL;?>room-search.php" method="POST">
               <input type ="search"  name ="search" placeholder="Search for hotel rooms">
               <input type="submit" name="submit" value="search" class="btn btn-primary">
              </form>
          
        </div>
    </section>
    <!--travel search section ends here -->




        <!--Trip plans section start here -->
    <section class= "Hotel-Rooms">
        <div class="container">
          <h2 class="text-center">Top Selling Rooms</h2>
          <?php
            //getting rooms from database that are active and featured
            //sql query
            $sql = "SELECT * FROM tbl_room WHERE active='Yes' ";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count rows to check whether the category is available or not
            $count = mysqli_num_rows($res);

            //check whether food available or not
            if($count>0)
                    {
                        //Rooms available
                        while($row = mysqli_fetch_assoc($res))
                        {
                            //get the values like id , title, image_name,price,description
                            $id =$row ['id'];
                            $title =$row ['title'];
                            $price =$row ['price'];
                            $description =$row ['description'];
                            $image_name =$row ['image_name'];

                            ?>
                            <div class="Hotel-Rooms-box">
                                <div class="Hotel-Rooms-img">
                                    <?php
                                        //check whether image is avilable or not
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
                                    <h5><?php echo $title; ?></h5>
                                    <p class="Room-price"><?php echo $price; ?></p>
                                    <p class="Room-detail">
                                        <?php echo $description; ?> 
                                    </p>
                                    <br>
                                    <a href="<?php echo SITEURL;?>booking.php?room_id=<?php echo $id; ?>" class="btn btn-primary">Book Now </a>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    else{
                        //Rooms not available
                        echo "<div class='error'>Room not found.</div>";
                    }

            ?>

          <!-- <div class="Hotel-Rooms-box">

            <div class="Hotel-Rooms-img">
              <img src="images/deluxeroom.jpg" alt="Deluxe Or Standard Room" class="img-responsive img-curve">
            </div>

            <div class="Hotel-Rooms-desc">
                <h4>Deluxe Or Standard Room</h4>
                <p class="Room-price">$100</p>
                <p class="Room-detail">
                    Standard features like a King bed, safe,<br>
                Bathroom with rain <br>shower,Tea coffee maker,<br>
                Work desk, Small sofa .
                </p>
                <br>

                <a href="booking.html" class="btn btn-primary">Book Now</a>
            </div>
          </div> -->

        
              
              <div class="clearfix"></div>
              
          </div>

        </div>
   </section>
   <!--trip plan section ends here -->

   <?php include('partials-front/footer.php'); ?>
