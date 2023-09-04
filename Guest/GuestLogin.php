<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--CSS Styles-->
    <link rel="stylesheet" href="../CSS/SLoginStyles.css" />
    <title>ShuttBus | Guest Login</title>
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
        <p class="title">Guest Login</p>
        <br>
        <?php
            //Check if the guest already submitted for a one time code (checking to see if form was submitted)
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $verificationCode = sprintf("%06d", mt_rand(0, 999999)); //generate a random 6-digit verfication code with digits 0-9
                $email = $_POST['email']; //retrieve the email from the form
                
                $codeExpiration = time() + (2*60); //Set the expiration of the verification code to expire after two minutes
                
                session_start();
                $_SESSION['verificationCode'] = $verificationCode;
                $_SESSION['codeExpiration'] = $codeExpiration;
                
                $subject = "ShuttleBus Guest Login Code";
                $message = "Thank you for using our platform. You must verify your email through identification of a code. Your login code is: $verificationCode";
                $headers = "From: ShuttleBus Guest Login Services <guestservices@ShuttBus.com>";
                
                if (mail($email, $subject, $message, $headers)){
                echo '
                <script>
                    var verificationCode = window.prompt("Please enter the 6-digit code that was sent to your email:", "");
                    if (verificationCode === "'.$verificationCode.'"){
                        //If the inputted code is correct, check to see if it has expired
                        if ('.time().' <=  '.$codeExpiration.'){
                            //if true, that means code is valid and within the time limit
                            alert("Guest Login Successful!");
                            window.location.href = "./GuestHome.php";
                        }
                        else{
                            alert("Login verification code has expired. Please try again");
                        }
                    }
                    else{
                        alert("Invalid verification code. Please try again.");
                    }
                    
                </script>
                ';
                }
                else{
                    echo "There was an error trying to send a verification code to your email. Please try again later.";
                }
            }
        ?>
        <form style="border: none;" method="post">
            <p><b>Note: </b> <em>Any email address can be used, however, only MSU emails work with CPANEL & PHP configurations</em></p>
            <br></br>
            <label for="email"><b>Email Address</b></label>
            <input type="email" placeholder="Enter Email" name="email" id="email" required>
            <hr>
        
            <button type="submit" class="submitButton">Login</button>
            
        </form>
    </div>
  </body>
</html>
