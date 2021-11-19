<?php include('partials-front/menu.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Categories</h2>

            <?php
                //display all the categories that are active
                //sql query
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);

                //check whether the categories are avilable or not
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
                        <a href="<?php echo SITEURL;?>category-rooms.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                                <?php
                                    //check whether image is avilable or not
                                    if($image_name=="")
                                    {
                                        //image not avilable display message
                                        echo "<div class='error'>image not found</div>"; 
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
                    echo "<div class='error'>Category not found.</div>";
                }
            ?>

            <!-- <a href="category-foods.html">
            <div class="box-3 float-container">
                <img src="images/parking2.jpg" alt="parking" class="hm img-curve">

                <h3 class="float-text text-white">parking</h3>
            </div>
            </a> -->

            

           

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>
