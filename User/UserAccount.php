<?php
    include('../functions.php');
    if(!isset($_SESSION['UserNumber'])) header('location: ../index.php');
    $user = getUserInfo($_SESSION['UserNumber']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--CSS Styles-->
    <link rel="stylesheet" href="../CSS/SHomeStyle.css" />
    <title>ShuttleBus Plus</title>
    <style>
        
    </style>
  </head>
  <nav class="navbar">
    <!-- LOGO -->
    <!-- Check if user is logged in, if they are the logo redirects to home page. If they are not send them back to the landing page.-->
    <div class="logo"><a href="<?php if (isset($_SESSION['UserNumber'])) echo './UserHome.php'; else echo '../index.php';?>" style="color:white;">ShuttleBus</a></div>
    <!-- NAVIGATION MENU -->
    <ul class="nav-links">
      <!-- USING CHECKBOX HACK -->
      <input type="checkbox" id="checkbox_toggle" />
      <label for="checkbox_toggle" class="hamburger">&#9776;</label>
      <!-- NAVIGATION MENUS -->
      <div class="menu">
        <li><a href="./announcements.php"><img src="./Images/AnnouncementIcon.png" alt="Announcements" style="width:30%"><p>Announcements</p></a></li>
        <li><a href="./UserMaintenanceRequest.php"><img src="./Images/MaintenanceIcon.png" alt="Maintenance" style="width:40%"><p>Maintenance</p></a></li>
        <li><a href="./UserHome.php"><img src="./Images/HomeIcon.png" alt="Home" style="width:80%"><p>Home</p></a></li>
        <li><a href="../logout.php"><img src="./Images/LogoutIcon.png" alt="Logout" style="width:65%"><p>Logout</p></a></li>
      </div>
    </ul>
  </nav>
  <body>
    <div class="container1">
        <h1 style="color: #FFF; margin-top:150px; font-size: 5rem;">Account Info</h1>
        <br>
    </div>
    
    <div class="warning">
        <p>Please note that if you want to save changes, please fill out all fields and make sure that it is acccurate. Enter password to confirm changes.</p>
    </div>
    
    <?php echo display_error(); ?><br>
    <?php if (isset($_SESSION['savedChanges'])){ ?><div class="success"><?php echo $_SESSION['savedChanges'];?></div> <?php } ?>
    
    <div style="text-align:center;">
        <form style="border: none;" method="POST" action="./UserAccount.php">

            <label for="fname"><b>First Name</b></label>
            <input type="text" placeholder="Enter First Name" name="fname" id="fname" value="<?php echo $user['FirstName']; ?>" required>
            
            <label for="lname"><b>Last Name</b></label>
            <input type="text" placeholder="Enter Last Name" name="lname" id="lname" value="<?php echo $user['LastName']; ?>" required>
            
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" id="email" value="<?php echo $user['email']; ?>" pattern="[a-zA-Z0-9._%+-]+@montclair.edu$" required>
            
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" id="username" value="<?php echo $user['UserName']; ?>"required>
            
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" required>
            
            <hr>
            <button type="submit" class="submitButton" name="save-changes-bttn">Save Changes</button>
        </form>
    </div>
  </body>
</html>
