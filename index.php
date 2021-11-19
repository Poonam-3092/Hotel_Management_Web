<?php include('partials-front/menu.php'); ?>

    <!-- ROOM sEARCH Section Starts Here -->
    <section class="room-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL;?>room-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Room..">
                <input type="submit" name="submit" value="Search"class="btn btn-primary">
            </form>
        
    </div>

         
    </section>
    <!-- ROOM sEARCH Section Ends Here -->

    <?php
    if(isset($_SESSION['booking']))
    {
        echo $_SESSION['booking'];
        unset ($_SESSION['booking']);
    }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Categories</h2>

            <?php
                //create sql query to display categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 6";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //categories available
                    while($row = mysqli_fetch_assoc($res))
                    {
                        //get the values like id , title, image_name
                        $id =$row ['id'];
                        $title =$row ['title'];
                        $image_name =$row ['image_name'];

                        ?>
                        <a href="<?php echo SITEURL;?>category-rooms.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    //check whether image is avilable or not
                                    if($image_name=="")
                                    {
                                        //display message
                                        echo "<div class='error'>image not avilable</div>"; 
                                    }
                                    else{
                                        //image avilable
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="parking" class="hm img-curve">

                                        <?php
                                    }

                                ?>
                                
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                
                            </div>
                        </a>
                        <?php
                    }
                }
                else{
                    //categories not available
                    echo "<div class='error'>Category not added.</div>";
                }
            ?>

            

        
            <div class="clearfix"></div>
    </div>


    </section>
    <!-- Categories Section Ends Here -->

    <!-- hotel facilities Section Starts Here -->
    <section class="Hotel-Rooms">
        <div class="container">
        <h3 class="text-center">Top Selling Rooms</h3>

        <?php
        //getting food from database that are active and featured
        //sql query
        $sql2 = "SELECT * FROM tbl_room WHERE active='Yes' AND featured='Yes' LIMIT 6";
        //execute the query
        $res2 = mysqli_query($conn, $sql2);
        //count rows to check whether the category is available or not
        $count2 = mysqli_num_rows($res2);

        //check whether food available or not
        if($count2>0)
                {
                    //Rooms available
                    while($row = mysqli_fetch_assoc($res2))
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
                    echo "<div class='error'>Rooms not available.</div>";
                }

        ?>

        

            

        
            <div class="clearfix"></div>

        
    </div>
    <p class="text-center">
        <a href="<?php echo SITEURL;?>rooms.php">Explore All HOTEL-ROOMS</a>
    </p>
    
    
    </section>
    <!-- hotel facilities Section Ends Here -->

    


    <?php include('partials-front/footer.php'); ?>

    