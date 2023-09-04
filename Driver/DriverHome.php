<?php include('../functions.php');
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Driver | Home</title>
        <!-- CSS Styles -->
        <link rel="stylesheet" href="./CSS/homeStyle.css">

        <script src="./initMap.js"></script>
        <script src="./getCurrentCoordinates.js"></script>
        <link rel="stylesheet" href="./CSS/style.css">

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
                <li><a href="./DriverHome.php">Home</a></li>
                <li><a href="./makeRequest.php">Make Request</a></li>
                <li><a href="./DriverStartEndRoute.php">Start/End Route</a></li>
                <li><a href="./DriverMakeAnnouncement.php">Make Announcement</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </div>
        </ul>
    </nav>

    <body>
        <!-- Main section for driver home -->
        <section class="container1">
            <!-- Notification message -->
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="notification success">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <div class="welcome">
                <button class="button button-rounded button-shadow" onclick="location.href='./DriverStartEndRoute.php'">Start My Route</button>
                <button class="button button-rounded button-shadow" onclick="location.href='./DriverStartEndRoute.php'">End My Route</button>
            </div>
        </section>

        <section class="container2">
            <div class="content">
                <h2>Current Routes Provided</h2>
                <p class="subtitle">This is a chart of all current routes provided.</p>

                <table class="routes-table">
                    <thead>
                        <tr>
                            <th>Route Name</th>
                            <th>Stops</th>
                            <th>Schedule</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // SQL Query to Display All Routes That Are Offered
                        $query = "SELECT * FROM BusRoutes";
                        $result = mysqli_query($db, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["RouteName"] . "</td>";
                            echo "<td>" . $row["Stops"] . "</td>";
                            echo "<td>" . $row["Schedule"] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <div class="container">
          <h1>Get Current Coordinates</h1>
          <button id="locationButton">Get Current Coordinates</button>
          <div id="map"></div>
          <div class="space" style="height: 300px;"></div>
        </div>


    </body>

</html>