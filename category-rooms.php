<?php include('partials-front/menu.php'); ?>

<?php
    //CHECK whether id is passed or not
    if(isset($_GET['category_id']))
    {
        //category id is set and get the id
        $category_id = $_GET['category_id'];
        //get hte category title based on category id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        //execute the qauery
        $res = mysqli_query($conn, $sql);

        //get the value from database
        $row = mysqli_fetch_assoc($res);

        //get the title
        $category_title = $row['title'];
    }
    else{
        //category not passed
        //redorect to home page
        header('location:'.SITEURL);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="room-search text-center">
        <div class="container">
            
            <!-- <form action="">
                <input type="search" name="search" placeholder="Search for Room.." required>
                <input type="submit" name="submit" value="Search"class="btn btn-primary">
            </form> -->

            <h2>Rooms on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="Hotel-Rooms">
        <div class="container">
            <h2 class="text-center">Hotel-Rooms</h2>
            <?php
                //create sql query to get rooms based on selected category
                $sql2 ="SELECT * FROM tbl_room WHERE  category_id=$category_id";
                //execute the query
                $res2 = mysqli_query($conn, $sql2);
                //count rows to check whether the category is available or not
                $count2 = mysqli_num_rows($res2);

                //check whether room is available or not
                if($count2>0){
                    //room available
                    while($row2 = mysqli_fetch_assoc($res2))
                    {
                        $id =$row2 ['id'];
                        $title =$row2 ['title'];
                        $price =$row2 ['price'];
                        $description =$row2 ['description'];
                        $image_name =$row2 ['image_name']; 

                        ?>
                            <div class="Hotel-Rooms-box">
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
                                    <h4><?php echo $title; ?></h4>
                                    <p class="Room-price"><?php echo $price; ?></p>
                                    <p class="Room-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL;?>booking.php?room_id=<?php echo $id; ?>" class="btn btn-primary">Book Now</a>
                                </div>
                            </div>
                        
                        <?php
                    }

                }
                else{
                    //room not available
                    echo "<div class='error'>room not available.</div>";
                }
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>