<?php include('partials/menu.php'); ?>

<div class="main-content">
    
    <div class="wrapper">
        <h1>Manage Room</h1>

        <br /><br />

                        <!-- button to add admin -->
                        <a href="<?php echo SITEURL; ?>admin/add-room.php" class="btn-primary">Add room</a>

                        <br /><br /><br />

                        <?php
                                if(isset($_SESSION['add']))
                                {
                                    echo $_SESSION['add'];
                                    unset($_SESSION['add']);
                                }
                                if(isset($_SESSION['delete']))
                                {
                                    echo $_SESSION['delete'];
                                    unset($_SESSION['delete']);
                                }
                                if(isset($_SESSION['upload']))
                                {
                                    echo $_SESSION['upload'];
                                    unset($_SESSION['upload']);
                                }
                                if(isset($_SESSION['unauthorize']))
                                {
                                    echo $_SESSION['unauthorize'];
                                    unset($_SESSION['unauthorize']);
                                }
                                if(isset($_SESSION['update']))
                                {
                                    echo $_SESSION['update'];
                                    unset($_SESSION['update']);
                                }
                        ?>
                        <table class="tbl-full">
                                <tr>
                                        <th>S.N</th>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Featured</th>
                                        <th>Active</th>
                                        <th>Actions</th>
                                </tr>

                                <?php
                                //create a sql query to get all the rooms
                                        $sql = "SELECT * FROM tbl_room";

                                        //execute the query
                                        $res = mysqli_query($conn, $sql);

                                        //count rows to check whether we have rooms or not
                                        $count = mysqli_num_rows($res);

                                        //create serial number variables and set default value as 1
                                        $sn=1;

                                        if($count>0){
                                                //we have food in database
                                                //get the food from database and display
                                                while($row=mysqli_fetch_assoc($res)){
                                                        //get the values from individual coloumns
                                                        $id = $row['id'];
                                                        $title = $row['title'];
                                                        $price = $row['price'];
                                                        $image_name = $row['image_name'];
                                                        $featured = $row['featured'];
                                                        $active = $row['active'];

                                                        ?>
                                                        <tr>
                                                                <td><?php echo $sn++; ?></td>
                                                                <td><?php echo $title; ?></td>
                                                                <td>$<?php echo $price; ?></td>
                                                                <td>
                                                                       <?php
                                                                                //check whether we have image or not
                                                                                if($image_name==""){
                                                                                        //we do not have image,display error msg
                                                                                        echo "<div class='error'>Image not added.</div>";
                                                                                }
                                                                                else{
                                                                                        //we have image ,display image
                                                                                        ?>
                                                                                        <img src="<?php echo SITEURL; ?>images/room/<?php echo $image_name; ?>" width="100px">
                                                                                        <?php
                                                                                }
                                                                       ?>
                                                                </td>
                                                                <td><?php echo $featured; ?></td>
                                                                <td><?php echo $active; ?></td>
                                                                <td>
                                                                        <a href="<?php echo SITEURL; ?>admin/update-room.php?id=<?php echo $id; ?>" class="btn-secondary">Update Room</a>
                                                                        <a href="<?php echo SITEURL; ?>admin/delete-room.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Room</a>
                                                                </td>
                                                        </tr>
                                                        <?php
                                                }
                                        }
                                        else{
                                                //food not added in database
                                                echo "<tr> <td colspan='7'class='error'>Room not added yet. </td></tr>";
                                        }
                                ?>
                
                                

                                
                                

                                
                        </table>
    </div>

</div>

<?php include('partials/footer.php'); ?>