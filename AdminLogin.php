<?php include('./functions.php')?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--CSS Styles-->
    <link rel="stylesheet" href="./CSS/SLoginStyles.css" />
    <title>ShuttBus | Admin Login</title>
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
        button[name="admin_login_btn"] {
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

        button[name="admin_login_btn"]:hover {
            background-color: #cc0000;
        }
    </style>
  <body>
    <div class="container1">
        <p class="title">Admin Login</p>
        <?php echo display_error(); ?>
        <br>
	<form method="post" action="AdminLogin.php">

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="registerbtn" name="admin_login_btn">Login</button>
		</div>
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
	</form>
    </div>
  </body>
</html>