<?php

//include constants.php file here
include('../config/constants.php');

//1.get the id of admin to be deleted
$id = $_GET['id'];
//2.create sql query  to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//execute the query
$res = mysqli_query($conn, $sql);

//check whether the query executed successfully or not
if($res==true)
{
    //query executed successfully and admin deleted
    //echo "Admin deleted";
    //create session variable to display message
    $_SESSION['delete'] = "<div class= 'success'>Admin deleted Successfully.</div>";
    //Redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else{
    //failed to delete admin
    //echo "failed to delete admin";

    $_SESSION['delete'] = "<div class= 'success'>Failed to delete admin. try again later.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}
//3.redirect to manage admin page with message (success or error)
?>