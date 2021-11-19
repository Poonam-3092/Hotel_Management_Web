<?php
    //include constants file
    include('../config/constants.php');
    //echo "delete page";
    //check whether the id and image_name is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        //get the value and delete
        //echo "get value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file is availablle "
        if($image_name == ""){
            //image is available so remove it
            $path = "../image/category/".$image_name;
            //remove the image
            $remove =unlink($path);
            //if failed to remove image then add an error msg and stop the process
            if($remove==false){
                //set the session message
                $_SESSION['remove']= "<div class='error'>Failed to remove category Image.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            }
        }
        //delete data from database
        //sql query to delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether data is deleted from database or not
        if($res==true){
            //set success message and redirect
            $_SESSION['delete']= "<div class='success'>category deleted successfully.</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            //set fail message and redirect
            $_SESSION['delete']= "<div class='error'>failed to delete category </div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        //rediect to manage category page with message
    }
    else{
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>