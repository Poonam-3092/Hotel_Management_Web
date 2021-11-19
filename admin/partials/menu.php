<?php
 include('../config/constants.php'); 
 include('login-check.php');

 ?>
<?php
//Authorization = Access control
//check whether the user is logged in or not
?>
<html>
    <head>
        <Title>Dreamland Hotel - Home page</Title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <!-- menu section start -->
        <div class="menu text-center">
            <div class="wrapper"> 
                <ul>
                    
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-room.php">Room</a></li>
                    <li><a href="manage-booking.php">Booking</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>

            </div>
           
        </div>
        <!-- menu section end -->