<?php include('../functions.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--CSS Styles-->
    <title>Admin | User Registration</title>
    <link rel="stylesheet" href="../CSS/SLoginStyles.css" />
    <!--Bootstrap JavaScript link to validate that passwords are matching within the input forms-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Avenir';
            min-height: 100vh;
        }

        .text-center {
            text-align: center;
        }

        #tabs-ctrl {
            display: flex;
            justify-content: center;
        }

        .tab-ctrl {
            background: #dfdfdf;
            border: 1px solid #dedede;
            margin: 1rem;
            padding: .5rem 2rem;
            border-radius: 25px;
            outline: 0;
            transition: all 200ms;
        }

        .ctrl-active {
            background: #333;
            color: #fff;
            transition: all 200ms;
        }

        .tab-content {
            max-width: 600px;
            margin: auto;
            display: none;
            background: #dedede;
            padding: 1rem;
            transition: all 200ms;
        }

        .content-active {
            display: block;
            transition: all 200ms;
        }
    </style>
    </style>
</head>
<nav class="navbar">
    <!-- LOGO -->
    <div class="logo">ShuttleBus</div>
    <!-- NAVIGATION MENU -->
    <ul class="nav-links">
        <!-- USING CHECKBOX HACK -->
        <input type="checkbox" id="checkbox_toggle" />
        <label for="checkbox_toggle" class="hamburger">&#9776;</label>
        <!-- NAVIGATION MENUS -->
        <div class="menu">
            <li><a href="./AdminHome.php">Home</a></li>
            <li><a href="./AdminAddUser.php">Add User</a></li>
            <li><a href="./AdminUserData.php">View Users</a></li>
            <li><a href="./AdminRoutes.php">Manage Routes</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </div>
    </ul>
</nav>

<body>
    <h1 class="text-center">Select the use you want to add</h1>
    <div id="tabs-ctrl">
        <button class="tab-ctrl ctrl-active">User </button>
        <button class="tab-ctrl">Driver</button>
        <button class="tab-ctrl">Maintenance</button>
    </div>
    <!--===========================ADD USER======================================-->
    <div class="tab-content content-active" data-tabContent="tabs">
        <p class="title">User Registration</p>
        <?php echo display_error(); ?>
        <br>
        <form style="border: none;" method="post" action="AdminAddUser.php" oninput='password_2.setCustomValidity(password_2.value != password_1.value ? "Passwords do not match." : "")'>
            <label for="fname"><b>First Name</b></label>
            <input type="text" placeholder="Enter First Name" name="fname" id="fname" required>

            <label for="lname"><b>Last Name</b></label>
            <input type="text" placeholder="Enter Last Name" name="lname" id="lname" required>

            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" id="email" pattern="[a-zA-Z0-9._%+-]+@montclair.edu$" required>

            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" id="username" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" id="password" name="password_1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+]).{8,}" required>
            <div style='margin-bottom: 10px;'>
                <p style="font-weight:bold; font-size:80%">Password Requirements: </p>
                <ul style="font-size:70%" id="password-checklist">
                    <li>Contains uppercase letter</li>
                    <li>Contains lowercase letter</li>
                    <li>Contains a digit</li>
                    <li>Contains a symbol</li>
                </ul>
            </div>

            <script>
                const passwordInput = document.getElementById('password');
                const passwordChecklist = document.getElementById('password-checklist');

                passwordInput.addEventListener('input', function() {
                    const password = passwordInput.value;

                    // Check each individual requirement
                    const lengthCheck = password.length >= 8 ? `<span style="color:green">&#x2714; Minimum 8 characters</span>` : `<span style="color:red">&#x2718; Minimum 8 characters</span>`;
                    const uppercaseCheck = /[A-Z]/.test(password) ? `<span style="color:green">&#x2714; At least one uppercase character</span>` : `<span style="color:red">&#x2718; At least one uppercase character</span>`;
                    const lowercaseCheck = /[a-z]/.test(password) ? `<span style="color:green">&#x2714; At least one lowercase character</span>` : `<span style="color:red">&#x2718; At least one lowercase character</span>`;
                    const specialCharCheck = /[!@#$%^&*()_+]/.test(password) ? `<span style="color:green">&#x2714; At least one special character</span>` : `<span style="color:red">&#x2718; At least one special character</span>`;
                    const digitCheck = /\d/.test(password) ? `<span style="color:green">&#x2714; At least one digit</span>` : `<span style="color:red">&#x2718; At least one digit</span>`;

                    // Update the checklist with the results
                    passwordChecklist.innerHTML = `
                      <li>${lengthCheck}</li>
                      <li>${uppercaseCheck}</li>
                      <li>${lowercaseCheck}</li>
                      <li>${specialCharCheck}</li>
                      <li>${digitCheck}</li>
                    `;
                });
            </script>
            <label for="psw"><b>Confirm Password</b></label>
            <input type="password" placeholder="Confirm Password" name="password_2" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+]).{8,}" required>
            <button type="submit" class="submitButton" name="Auser-register-bttn">Register</button>
        </form>
    </div>




    <!--==========================ADD DRIVER===============================-->
    <div class="tab-content" data-tabContent="star-ratings">
        <p class="title">Driver Registration</p>
        <?php echo display_error(); ?>
        <br />
        <form method="post" action="AdminAddUser.php">
            <label for="username"><b>Username</b></label>
            <input type="text" name="username" value="<?php echo $username; ?>" />

            <label for="email"><b>Email</b></label>
            <input type="text" name="email" value="<?php echo $email; ?>" id="email">

            <label for="psw"><b>Password</b></label>
            <input type="password" name="password_1" id="password" required />

            <label for="psw"><b>Confirm Password</b></label>
            <input type="password" name="password_2" id="password" required />

            <button type="submit" class="registerbtn" name="register_btn">Register</button>
        </form>
    </div>
    <!--==========================ADD MAINTANICE=-===============================-->
    <div class="tab-content" data-tabContent="accordion">
        <p class="title">Maintenance Registration</p>
        <?php echo display_error(); ?>
        <br />
        <form method="post" action="AdminAddUser.php">
            <label for="username"><b>Username</b></label>
            <input type="text" name="username" value="<?php echo $username; ?>" />

            <label for="email"><b>Email</b></label>
            <input type="text" name="email" value="<?php echo $email; ?>" id="email">

            <label for="psw"><b>Password</b></label>
            <input type="password" name="password_1" id="password" required />

            <label for="psw"><b>Confirm Password</b></label>
            <input type="password" name="password_2" id="password" required />

            <button type="submit" class="registerbtn" name="main_register_btn">Register</button>
        </form>
    </div>
    <script>
        function tabCtrl() {
            var ctrls = document.getElementById('tabs-ctrl');

            ctrls.addEventListener('click', function(e) {
                var target = e.target;
                if (target.getAttribute('class') === 'tab-ctrl') {
                    var ctrlsA = document.getElementsByClassName('tab-ctrl');
                    var ctrlArray = Array.prototype.slice.call(ctrlsA);
                    var index = ctrlArray.indexOf(target);
                    var content = document.getElementsByClassName('tab-content');
                    var contentArray = Array.prototype.slice.call(content);

                    for (var i = 0; i < ctrlArray.length; i++) {
                        ctrlArray[i].classList.remove('ctrl-active');
                        contentArray[i].classList.remove('content-active');
                    }
                    target.classList.add('ctrl-active');
                    contentArray[index].classList.add('content-active');
                }
            });
        }

        tabCtrl();
    </script>
</body>

</html>