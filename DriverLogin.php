<?php include('./functions.php')?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--CSS Styles-->
    <link rel="stylesheet" href="./CSS/SLoginStyles.css" />
    <title>ShuttBus | Driver Login</title>
  </head>
  <nav class="navbar">
    <!-- LOGO -->
    <div class="logo"><a href="./index.php" style='color:white;'>ShuttleBus</a></div>
    <!-- NAVIGATION MENU -->
    <ul class="nav-links">
      <!-- USING CHECKBOX HACK -->
      <input type="checkbox" id="checkbox_toggle" />
      <label for="checkbox_toggle" class="hamburger">&#9776;</label>
    </ul>
  </nav>
    <style>
        button[name="login_btn"] {
            background-color: #ff4d4d;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[name="login_btn"]:hover {
            background-color: #cc0000;
        }
    </style>
  <body>
    <div class="container1">
        <p class="title">Driver Login</p>
        <?php echo display_error(); ?>
        <br>
        <!--<form style="border: none;" method="post" action="DriverLogin.php">-->
        
        <!--    <label><b>Username/Email</b></label>-->
        <!--    <input type="text" placeholder="Username" name="username" required>-->
        
        <!--    <label ><b>Password</b></label>-->
        <!--    <input type="password" placeholder="Enter Password" name="password" required>-->
        <!--    <hr>-->
        
        <!--    <button type="submit" class="registerbtn" name="login-bttn">Login</button>-->
        <!--</form>-->
        <form method="post" action="DriverLogin.php">
            
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" placeholder="Enter Username">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password" placeholder="Enter Password">
		</div>
		<div class="input-group">
			<button type="submit" class="registerbtn" name="login_btn">Login</button>
		</div>
	</form>
    </div>
  </body>
</html>