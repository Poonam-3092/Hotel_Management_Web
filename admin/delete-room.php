<?php

    //include constants file
    include('../config/constants.php');

    //echo "delete food page";
    if(isset($_GET['id']) && isset($_GET['image_name']))//either use && or AND
    {
        //process to delete
        //echo "process to delete";

        //1.get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2.remove the image if available
        //remove the physical image file is availablle "
        if($image_name != ""){
            //it has image and need to remove from folder
            //get the image path
            $path = "../image/room/".$image_name;

            //remove the image from folder
            $remove =unlink($path);

            //check whether the image is removed or not
            if($remove!=false){
                //failed to remove image
                $_SESSION['upload']= "<div class='error'>Failed to remove Image file.</div>";
                //redirect to manage room page
                header('location:'.SITEURL.'admin/manage-room.php');
                //stop the process of deleting room
                die();
            }
        }

        //3.delete food from database
        $sql = "DELETE FROM tbl_room WHERE id=$id";
        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query is executed or not and set the session message respectively
        //4.redirect to manage food with session message
        if($res==true){
            //room deleted
            $_SESSION['delete']= "<div class='success'>Room deleted successfully.</div>";
            //redirect to manage room
            header('location:'.SITEURL.'admin/manage-room.php');
        }
        else{
            //failed to delete room
            $_SESSION['delete']= "<div class='error'>failed to delete room </div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-room.php');
        }

        
    }
    else{
        //redirect to manage room page
        //echo "redirect";
        $_SESSION['unauthorize']= "<div class='error'>Unauthorized access.</div>";
        header('location:'.SITEURL.'admin/manage-room.php');
    }
?>