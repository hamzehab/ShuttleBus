<?php include('../functions.php'); ?>

<DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>Admin | Home</title>
        <link rel="stylesheet" href="./CSS/style.css">
        <link rel="stylesheet" href="./CSS/cardstyle.css">

    </head>

    <body style="background-color: #FFFF; margin-bottom: 0;">
        <div class="header finisher-header" style="width: 100%; height: 500px;">
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
            <!--Status Cards-->
            <section class="container1" style="margin-top: 75px;">
                <!-- For Students -->
                <div class="card">
                    <div class="main-content">
                        <div class="main-title">
                            <h2 class="main-title-text" style="text-align: center;">Total Routes Offered</h2>
                        </div>
                        <div class="main-para">
                            <h1 style="padding: 55px; text-align: center; font-size: 50px;">
                                10<br> <br>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="main-content">
                        <div class="main-title">
                            <h2 class="main-title-text" style="text-align: center;">Total Active Routes</h2>
                        </div>
                        <div class="main-para">
                            <h1 style="padding: 55px; text-align: center; font-size: 50px;">
                                10<br> <br>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="main-content">
                        <div class="main-title">
                            <h2 class="main-title-text" style="text-align: center;">Total Number of Users</h2>
                        </div>
                        <div class="main-para">
                            <h1 style="padding: 55px; text-align: center; font-size: 50px;">
                                10<br> <br>
                            </h1>
                        </div>
                    </div>
                </div>
        </div>

        <script src="finisher-header.es5.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            new FinisherHeader({
                "count": 6,
                "size": {
                    "min": 1100,
                    "max": 1300,
                    "pulse": 1.4
                },
                "speed": {
                    "x": {
                        "min": 0.1,
                        "max": 0.3
                    },
                    "y": {
                        "min": 0.3,
                        "max": 0.3
                    }
                },
                "colors": {
                    "background": "#cc2a29",
                    "particles": [
                        "#6bd6ff",
                        "#ffcb57",
                        "#ff333d"
                    ]
                },
                "blending": "overlay",
                "opacity": {
                    "center": 1,
                    "edge": 0.1
                },
                "shapes": [
                    "c"
                ]
            });
        </script>
        <div class="container">
            <div class="left">
                <section class="container2">
                    <h1 style="text-align: center;">Active Drivers</h1>
                    <?php
                    $query = "SELECT * FROM ActiveBusDrivers";
                    $result = mysqli_query($db, $query);

                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <table class="routes-table">
                            <thead>
                                <tr>
                                    <th>Driver Number</th>
                                    <th>Driver Name</th>
                                    <th>Route Name</th>
                                    <th>Route Start</th>
                                    <th>Current Position</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row["DriverNumber"] . "</td>";
                                    echo "<td>" . $row["DriverFullName"] . "</td>";
                                    echo "<td>" . $row["RouteName"] . "</td>";
                                    echo "<td>" . $row["RouteStartTime"] . "</td>";
                                    echo "<td>" . $row["CurrentPosition"] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php
                    } else {
                        echo "<p class=\"no-routes\">There are no active routes</p>";
                    }
                    ?>
                </section>
            </div>
            <div class="right">
                <h1 style="text-align: center;">Active Wait Times</h1>
                <?php
                $query = "SELECT * FROM ActiveRoutes";
                $result = mysqli_query($db, $query);

                if (mysqli_num_rows($result) > 0) {
                ?>
                    <table class="routes-table">
                        <thead>
                            <tr>
                                <th>Route Name</th>
                                <th>Wait Time in Mins</th>
                                <th>Current Position</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["RouteName"] . "</td>";
                                echo "<td>" . $row["WaitTime"] . "</td>";
                                echo "<td>" . $row["CurrentPosition"] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "<p class=\"no-routes\">There are no active routes</p>";
                }
                ?>

            </div>
        </div>

        <section class="container3">
            <h1 style="text-align: center;">User Messages</h1><br>
            <?php
            // Check if the "Resolved" button was clicked for a message
            if (isset($_POST["resolved"])) {
                $id = $_POST["resolved"];

                // Update the status of the message to "Resolved"
                $query = "UPDATE AdminMessgaes SET status='Resolved' WHERE id='$id'";
                mysqli_query($db, $query);
            }

            // Check if the "Delete" button was clicked for a message
            if (isset($_POST["delete"])) {
                $id = $_POST["delete"];

                // Delete the message from the table
                $query = "DELETE FROM AdminMessgaes WHERE id='$id'";
                mysqli_query($db, $query);
            }

            // Retrieve data from the messages table
            $query = "SELECT * FROM AdminMessgaes";
            $result = mysqli_query($db, $query);

            // Check if there are any rows in the result
            if (mysqli_num_rows($result) > 0) {
                // Start building the HTML table
                echo "<table style='margin: auto; padding-top: 100px;'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Name</th>";
                echo "<th>Email</th>";
                echo "<th>Subject</th>";
                echo "<th>Message</th>";
                echo "<th>Action</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                // Loop through each row in the result and display the data in the HTML table
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["subject"] . "</td>";
                    echo "<td>" . $row["message"] . "</td>";

                    // Add a "Delete" button for all messages
                    echo "<td>";
                    echo "<form method='post'>";
                    echo "<button class='button' type='submit' name='delete' value='" . $row["id"] . "'>Delete</button>";
                    echo "</form>";
                    echo "</td>";

                    echo "</tr>";
                }

                // Finish building the HTML table
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "No messages found.";
            }

            // Close the database connection
            mysqli_close($db);
            ?>

        </section>

        <footer>
            <div class="footer-content">
                <h3>ShuttleBus</h3>
                <p>123 Main St. | Cool City, USA 12345</p>
                <p>Email: info@shuttlebus.com</p>
                <p>Phone: 555-123-4567</p>
            </div>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
            <p>&copy; 2023 ShuttleBus. All rights reserved.</p>
        </footer>
    </body>

    </html>