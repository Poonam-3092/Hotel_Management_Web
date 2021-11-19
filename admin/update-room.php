<?php include('partials/menu.php'); ?>

<?php
    //check whether the id is set or not
    if(isset($_GET['id']))
    {
        //get the id and all other details
        //echo "getting the data";
        $id=$_GET['id'];

        //sql query to get the selected room
        $sql2="SELECT * FROM tbl_room WHERE id=$id";

        //Execute the query
        $res2 = mysqli_query($conn , $sql2);

        //get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //get the individual values of selected food
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else{
         //redirect to manage category
         header('location:'.SITEURL.'admin/manage-room.php');
    }

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Room </h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
        <tr>
            <td>Title:</td>
            <td>
                <input type="text" name="title" value="<?php echo $title; ?>">
            </td>
        </tr>

        <tr>
            <td>Description: </td>
            <td>
                <textarea name="description"  cols="30" rows="5" ><?php echo $description; ?></textarea>
            </td>
        </tr>

        <tr>
            <td>Price: </td>
            <td>
                <input type="number" name="price" value="<?php echo $price; ?>">
            </td>
        </tr>

        

        <tr>
            <td>Current Image:</td>
            <td>
            <?php
                if($current_image == "")
                {
                    //image not available
                    echo "<div class='error'>Image not available.</div>";
                }
                else{
                    //image available
                    ?>
                    <img src=" <?php echo SITEURL; ?>image/room/<?php echo $current_image; ?>" width="150px" >
                    <?php
                }
            ?>
            </td>
        </tr>

        <tr>
            <td>Select New Image:</td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>

        <tr>
            <td>Category:</td>
            <td>
                <select name="category">
                    <?php
                        //querry to get active categories
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                        //execute the query
                        $res = mysqli_query($conn, $sql);
                        //count rows
                        $count = mysqli_num_rows($res);

                        //check whether category available or not
                        if($count>0){
                            //category available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $category_title = $row['title'];
                                $category_id = $row['id'];

                                echo "<option value='$category_id'>$category_title</option>";
                            }
                        }
                        else{
                            //category not available
                            //echo "<option value='0'>Category Not available.</option>";
                            ?>
                            <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                            <?php
                        }
                    ?>
                    
                </select>
            </td>
        </tr>

        <tr>
            <td>Featured:</td>
            <td>
                <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
            </td>
        </tr>

        <tr>
            <td>Active:</td>
            <td>
                <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
            </td>
        </tr>

        <tr>
            <td>
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>"> 
             
            <input type="submit" name="submit" value="update Category" class="btn-secondary">

            </td>
        </tr>



        </table>
    
        </form>
        <?php
            if(isset($_POST['submit']))
            {
                //echo "button clicked";
                //1.get all the values from form to update
                $id=$_POST['id'];
                $title=$_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $current_image=$_POST['current_image'];
                $category=$_POST['category'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];

                //2.upload the new image if selected
                //check whether image is selected or not
                if(isset($_FILES['image']['name'])){
                    //upload button clicked
                    $image_name = $_FILES['image']['name']; //new image name

                    //check whether the image is available or not
                    if($image_name!= ""){
                        //image is available
                        //A.uploading new image
                        //rename the image
                        $ext = end(explode('.',$image_name));//get extension of image
                        //rename image
                        $image_name = "Room-Name_".rand(0000,9999).'.'.$ext;//renamed image e.g food_category_834.jpg 
                        
                        //get the source and destination path
                        $src_path = $_FILES['image']['tmp_name'];//source path

                        $dest_path="../images/room/".$image_name;//destination path

                        //finally upload the image
                        $upload = move_uploaded_file($src_path, $dest_path);

                        //ccheck whether image is uploaded or not
                        if($upload == false){
                            //set mesage
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload image.</div>";
                            //redirect to add category page
                            header('location:'.SITEURL.'admin/manage-room.php');
                            //stop the process
                            die();
                        }

                        //3.Remove the image if new image is uploaded and current image exists
                        //B.remove current image if available
                        if($current_image!=""){
                            //current image is avaiable
                            //remove the image
                            $remove_path = "../images/room/".$current_image;

                            $remove= unlink($remove_path);

                            //check whether the image is removed or not
                            if($remove==false){
                                //failed to remove image
                                $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image.</div>";
                                //redirect to add category page
                                header('location:'.SITEURL.'admin/manage-room.php');
                                die();//stop the process

                            }
                        }
                    }
                    else{
                        $image_name = $current_image;//default image when image is not selected
                    }

                }
                else{
                    $image_name = $current_image;//default image when button is not category
                }
                
                //4.update the food in database
                $sql3 = "UPDATE tbl_room SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name='$image_name',
                    category_id='$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id =$id
                ";

                //execute query
                $res3 = mysqli_query($conn, $sql3);

                //check whether the query executed successfully or not
                if($res3 == true){
                    //query executed and room updated
                    $_SESSION['update']= "<div class= 'success'>room updated successfully.</div>";
                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-room.php');
                }
                else{
                    //failed to update category
                    $_SESSION['update']= "<div class= 'error'>Failed to update room.</div>";
                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-room.php');
                }
                //redirect to manage category with session message
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>