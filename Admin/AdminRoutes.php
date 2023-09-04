<?php include('../functions.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Routes</title>
    <!-- CSS Styles -->
    <link rel="stylesheet" href="./CSS/AdminManageRoutes.css" />
    <style>
        /* Typography */
        body {
            font-family: "Roboto", sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #222;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }

        h2 {
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
        }

        h3 {
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        /* Buttons */
        button[name="A-Add-Route"] {
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

        button[name="A-Add-Route"]:hover {
            background-color: #cc0000;
        }
        button[name="update"] {
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

        button[name="update"]:hover {
            background-color: #cc0000;
        }
        button[name="delete"] {
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

        button[name="delete"]:hover {
            background-color: #cc0000;
        }
        button[name="edit"] {
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

        button[name="edit"]:hover {
            background-color: #cc0000;
        }
        button[name="add-route-btn"] {
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

        button[name="add-route-btn"]:hover {
            background-color: #cc0000;
        }

        /* Gradient button */
        .button-gradient {
            background-color: #1a73e8;
            background-image: linear-gradient(90deg, #1a73e8, #5c8bff);
        }

        .button-gradient:hover {
            background-color: #0052cc;
            background-image: none;
        }

        /* Rounded button */
        .button-rounded {
            border-radius: 2rem;
            padding: 0.75rem 2rem;
        }

        /* Shadow button */
        .button-shadow {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }


        /* Notifications */
        .notification {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0.25rem;
        }

        .notification.success {
            background-color: #2ECC40;
            color: #fff;
        }

        /* Containers */
        .container1,
        .container2 {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            background-color: #fff;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
            border-radius: 0.25rem;
        }

        .container1 {
            margin-top: 2rem;
        }

        /* Table */
        .routes-table {
            width: 100%;
            margin-top: 2rem;
            border-collapse: collapse;
        }

        .routes-table th {
            font-weight: 700;
            text-align: left;
            padding: 0.75rem;
            border-bottom: 0.125rem solid #ddd;
        }

        .routes-table td {
            padding: 0.75rem;
            border-bottom: 0.0625rem solid #ddd;
        }

        /* Responsive */
        @media (max-width: 768px) {

            .container1,
            .container2 {
                padding: 1rem;
            }

            .routes-table th,
            .routes-table td {
                padding: 0.5rem;
            }
        }
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
    <section class="container2">
        <div class="content">
            <h2>Current Routes Provided</h2>
            <p class="subtitle">This is a chart of all current routes provided.</p>
            <button id="add-route-btn" name="add-route-btn">Add Route</button>

            <div id="add-route-popup" style="display: none;">
                <form method='post' action='AdminRoutes.php'>
                    <label for="route-name-input">Route Name:</label>
                    <input type="text" id="route-name-input" name="route-name">

                    <label for="stops-input">Stops:</label>
                    <textarea id="stops-input" name="stops"></textarea>

                    <label for="schedule-input">Schedule:</label>
                    <input type="text" id="schedule-input" name="schedule">

                    <button type="submit" name="A-Add-Route">Save Route</button>
                </form>

            </div>
            <?php
            $connection = mysqli_connect('localhost', 'wynmane1_admin', 'Edtv10052002!', 'wynmane1_shuttlebus');

            // Check connection
            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Check connection
            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }
            // Check if form was submitted
            if (isset($_POST["A-Add-Route"])) {
                // Get form data
                $RouteName = $_POST["route-name"];
                $Stops = $_POST["stops"];
                $Schedule = $_POST["schedule"];

                // Escape special characters to prevent SQL injection
                $RouteName = mysqli_real_escape_string($connection, $RouteName);
                $Stops = mysqli_real_escape_string($connection, $Stops);
                $Schedule = mysqli_real_escape_string($connection, $Schedule);

                // Insert data into BusRoutes table
                $sql = "INSERT INTO BusRoutes (RouteName, Stops, Schedule) VALUES ('$RouteName', '$Stops', '$Schedule')";

                if (mysqli_query($connection, $sql)) {
                    echo "Route added successfully.";
                } else {
                    echo "Error adding route: " . mysqli_error($connection);
                }

                // Close MySQL database connection
                mysqli_close($connection);
            }
            ?>
            <script>
                const addRouteBtn = document.getElementById("add-route-btn");
                const addRoutePopup = document.getElementById("add-route-popup");

                addRouteBtn.addEventListener("click", () => {
                    addRoutePopup.style.display = "block";
                });
            </script>

            <table class="routes-table">

                <tbody>
                    <?php
                    // Check if the delete button was clicked
                    if (isset($_POST["delete"])) {
                        // Get the RouteID from the form data
                        $id = $_POST["id"];

                        // SQL query to delete the row with the corresponding RouteID
                        $query = "DELETE FROM BusRoutes WHERE RouteID='$id'";
                        mysqli_query($db, $query);
                    }

                    // SQL query to fetch all rows from the BusRoutes table
                    $query = "SELECT * FROM BusRoutes";
                    $result = mysqli_query($db, $query);

                    // Display the table of routes
                    echo "<table class='routes-table'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Route Name</th>";
                    echo "<th>Stops</th>";
                    echo "<th>Schedule</th>";
                    echo "<th>Actions</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["RouteName"] . "</td>";
                        echo "<td>" . $row["Stops"] . "</td>";
                        echo "<td>" . $row["Schedule"] . "</td>";
                        echo "<td>";
                        echo "<form method='post' action='AdminRoutes.php'>";
                        echo "<input type='hidden' name='id' value='" . $row["RouteID"] . "'>";
                        echo "<button type='submit' name='edit'>Edit</button>";
                        echo "<button type='submit' name='delete'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";

                    ?>
                    <?php
                    // Check if the edit button was clicked
                    if (isset($_POST["edit"])) {
                        // Get the RouteID from the form data
                        $id = $_POST["id"];

                        // SQL query to fetch the row with the corresponding RouteID
                        $query = "SELECT * FROM BusRoutes WHERE RouteID='$id'";
                        $result = mysqli_query($db, $query);
                        $row = mysqli_fetch_assoc($result);

                        // Display the form to edit the row
                        echo "<form method='post' action='AdminRoutes.php'>";
                        echo "<input type='hidden' name='id' value='" . $row["RouteID"] . "'>";
                        echo "<label for='routeName'>Route Name:</label>";
                        echo "<input type='text' name='routeName' value='" . $row["RouteName"] . "'><br>";
                        echo "<label for='stops'>Stops:</label>";
                        echo "<input type='text' name='stops' value='" . $row["Stops"] . "'><br>";
                        echo "<label for='schedule'>Schedule:</label>";
                        echo "<input type='text' name='schedule' value='" . $row["Schedule"] . "'><br>";
                        echo "<button type='submit' name='update'>Update</button>";
                        echo "</form>";
                    }

                    // Check if the update button was clicked
                    if (isset($_POST["update"])) {
                        // Get the form data
                        $id = $_POST["id"];
                        $routeName = $_POST["routeName"];
                        $stops = $_POST["stops"];
                        $schedule = $_POST["schedule"];

                        // SQL query to update the row in the database
                        $query = "UPDATE BusRoutes SET RouteName='$routeName', Stops='$stops', Schedule='$schedule' WHERE RouteID='$id'";
                        mysqli_query($db, $query);
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </section>
</body>

</html>