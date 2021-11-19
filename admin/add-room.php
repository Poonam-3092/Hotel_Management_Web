<?php include('partials/menu.php'); ?>

<div class ="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Room title">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description"  cols="30" rows="5" placeholder="Description of room"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                        <?php
                        //create php code to display categories from database
                        //1.create sql to get all active categories from database
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                        //executing query
                        $res = mysqli_query($conn, $sql);

                        //count rows to check whether we have categories or not
                        $count = mysqli_num_rows($res);

                        //if count is greater than zero ,we have categories else we donot have categories
                        if($count>0){
                            //we have categories
                            while($row=mysqli_fetch_assoc($res)){
                                //get the details of category 
                                $id = $row['id'];
                                $title = $row['title'];

                                ?>

                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                <?php
                            }
                        }
                        else{
                            //we do not have category
                            ?>
                            <option value="0">No Category Found</option>
                            <?php
                        }

                        //2.display on drop down
                        ?>
                            <!-- <option value="1">bar</option>
                            <option value="2">garden</option> -->

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes" >Yes
                        <input type="radio" name="featured" value="No" >No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes" >Yes
                        <input type="radio" name="active" value="No" >No
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Room" class="btn-secondary">

                    </td>
                </tr>
            </table>
        </form>

        <?php
        //check whether the button is clicked or not
        if(isset($_POST['submit']))
        {
            //add the room in database
            //echo "clicked";

            //1.get data from  form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //check whether radio button for featured and active are clicked or not
            if(isset($_POST['featured']))
            {
              $featured = $_POST['featured']  ;
            }
            else{
                $featured = "No"; //setting the default value
            }

            if(isset($_POST['active']))
            {
              $active = $_POST['active']  ;
            }
            else{
                $active = "No"; //setting the default value
            }



            //2.upload the image if selected
            //check whether the select image is clicked or not and upload thr image only if the image is selected
            if (isset($_FILES['image']['name']))
            {
                //get the details of the selected image
                $image_name = $_FILES['image']['name'];

                //check whether the image is selected or not and upload image only if selected
                if($image_name!=""){
                    //image is selected
                    //A. Rename the image
                    //get the extension of selected image (jpg,png,gif,etc.)"poonam-jk.jpg" poonam-jk jpg
                
                    $ext = end(explode('.', $image_name));

                    //create new name for image
                    $image_name = "Room-Name-".rand(0000,9999).".".$ext;//new image name may be "Room-Name-568.jpg"

                    //B.upload the image
                    //get the source path and destination path

                    //source path is the current location of the image
                    $src=$_FILES['image']['tmp_name'];

                    //destination path for the image to be uploaded
                    $dst="../images/room/".$image_name;

                    //finally upload the room image
                    $upload = move_uploaded_file($src, $dst);

                    //check whether image uploaded or not
                    if($upload==false){
                        //failed to upload the image 
                        //redirect to add room page with error message
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                        header('location:'.SITEURL.'admin/add-room.php');
                        //stop the process
                        die();
                    }
                }
            }
            else{
                $image_name = ""; //setting default value as blank
            }

            //3.insert into database
            //create a sql query to save or add room
            //for numerical we do not need to pass value quotes '' but the string value it is compulsory to add quotes''
            $sql2 = "INSERT INTO tbl_room SET
                title ='$title',
                description ='$description',
                price = $price,
                image_name ='$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'

            ";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            //check whether data inserted or not 
            //4.redirect with message to manage food page

            if($res2 == true){
                //data inserted successfully
                $_SESSION['add'] = "<div class='success'>room Added Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-room.php');
            }
            else{
                //failed to insert data
                $_SESSION['add'] = "<div class='error'>failed to add room.</div>";
                header('location:'.SITEURL.'admin/manage-room.php');
            }

            
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>