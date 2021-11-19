<?php include('partials-front/menu.php'); ?>


     <!-- travel search section start here -->
     <section class= "room-search text-center">
         <div class="container">
            <?php
                //get the search keyword
                //$search = $_POST['search'];
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            ?>
            <h2>Rooms on Your search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
           
         </div>
        

    </section>
     <!--travel search section ends here -->

     

    <!--Trip plans section start here -->
    <section class= "Hotel-Rooms">
        <div class="container">
          <h2 class="text-center">Explore Rooms</h2>
          <?php            
            //sql query to get rooms based on search keyword
            //$serch = room with view';DROP database-name;
            //"SELECT * FROM tbl_room WHERE title like '%room with view%' or description like '%room with view%'";
            $sql = "SELECT * FROM tbl_room WHERE title like '%$search%' or description like '%$search%'";

            //execute the query
            $res = mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);

            //check whether food available or nnot
            if($count >0){
              //room avilable
              while($row= mysqli_fetch_assoc($res))
              {
                //get the details
                $id =$row ['id'];
                $title =$row ['title'];
                $price =$row ['price'];
                $description =$row ['description'];
                $image_name =$row ['image_name'];  
                
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
              echo "<div class='error'>Room not found.</div>";
            }
          ?>
             
              

              
              <div class="clearfix"></div>
              
          </div>

        </div>
   </section>
   <!--trip plan section ends here -->



   <?php include('partials-front/footer.php'); ?>