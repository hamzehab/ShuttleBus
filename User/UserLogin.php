<?php include('../functions.php')?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--CSS Styles-->
    <link rel="stylesheet" href="../CSS/SLoginStyles.css" />
    <title>ShuttBus | User Login</title>
  </head>
  <nav class="navbar">
    <!-- LOGO -->
    <div class="logo"><a href="../index.php" style='color:white;'>ShuttleBus</a></div>
    <!-- NAVIGATION MENU -->
    <ul class="nav-links">
      <!-- USING CHECKBOX HACK -->
      <input type="checkbox" id="checkbox_toggle" />
      <label for="checkbox_toggle" class="hamburger">&#9776;</label>
    </ul>
  </nav>

  <body>
    <div class="container1">
        <p class="title">User Login</p>
        <!-- If user just registered, print success message and unset session counter in case of refresh page-->
        <!-- Session counter allows message to not constantly be printed on refresh-->
        <?php if (isset($_SESSION['counter'])){ ?><div class="success"><?php echo $_SESSION['success'];?></div> <?php unset($_SESSION['counter']);} ?>
        <?php echo display_error(); ?>
        <br>
        <form style="border: none;" method="post" action="UserLogin.php">
        
            <label for="email"><b>Username/Email</b></label>
            <input type="text" placeholder="Enter Username/Email" name="username" id="email" required>
        
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="psw" required>
            <hr>
        
            <button type="submit" class="submitButton" name="user-login-bttn">Login</button>
            <p>Don't have an account? <a href="./UserRegistration.php">Register Here</a></p>
            
        </form>
    </div>
  </body>
</html>
