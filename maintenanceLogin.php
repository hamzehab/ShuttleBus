<?php include('./functions.php')?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--CSS Styles-->
    <link rel="stylesheet" href="./CSS/SLoginStyles.css" />
    <title>ShuttBus | Maintenance Login</title>
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
      button[name="main_login_btn"] {
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

            button[name="main_login_btn"]:hover {
                background-color: #cc0000;
            }
  </style>

  <body>
    <div class="container1">
        <p class="title">Maintenance Login</p>
        <?php echo display_error(); ?>
        <br>
        <form method="post" action="maintenanceLogin.php">
            
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="Musername" placeholder="Enter Username">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="Mpassword" placeholder="Enter Password">
		</div>
		<div class="input-group">
			<button type="submit" class="registerbtn" name="main_login_btn">Login</button>
		</div>
	</form>
    </div>
  </body>
</html>