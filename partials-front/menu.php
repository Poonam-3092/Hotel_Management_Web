<?php include('config/constants.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- important to make website responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dreamland Hotel</title>

    <!-- link our css file -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- navbar section start here -->
    <section class= "navbar">
        <div class="container">
            <div class="logo">
                <img src="images/DreamlanddHotel.png" alt="Hotel logo" width="100%">
            </div>
            <div class="menu text-right">
               <ul>
                   <li>
                       <a href="<?php echo SITEURL; ?>">Home</a>
                   </li>
                <li>
                    <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>rooms.php">Rooms</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>about.php">About</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/login.php">Admin Login</a>
                </li>


               </ul>
            </div>
            <div class="clearfix"></div>
       

        </div>

       
       

    </section>
    <!-- navbar section ends here -->