<?php include('../functions.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Driver | Start/End Route</title>
    <link rel="stylesheet" href="./CSS/startRoute.css" />
</head>

<body>
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
    </nav>
    <section class="container1">
        <h1 class="title">Start or End Your Route</h1>
        <div class="current-date">
            <p class="date">Today's Date</p>
            <div id="current-date"></div>
        </div>
        <form class="driver-form" method="post" action="./DriverStartEndRoute.php">
            <label for="driver-number">Driver Number:</label>
            <input id="driver-number" type="text" name="driverNumber" value="<?php echo $driverNumber; ?>" required />
            <label for="driver-fullname">Driver Full Name:</label>
            <input id="driver-fullname" type="text" name="driverFullName" value="<?php echo $driverFullName; ?>" required />
            <label for="route-name">Route Name:</label>
            <input id="route-name" type="text" name="routeName" value="<?php echo $routeName; ?>" required />
            <label for="route-starttime">Route Start Time:</label>
            <input id="route-starttime" type="time" name="routeStartTime" value="<?php echo $routeStartTime; ?>" required />
            <button type="submit" name="drive_start_stop" class="button">Start Route</button>
        </form>
    </section>
    <section class="container2">
        <h1 class="title">Active Routes</h1>
        <p class="subtitle">This is a chart of active routes</p>
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
                        <th>Action</th>
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
                        echo '<td>
                          <div style="display: flex; justify-content: center;">
                            <form class="updateForm" action="" method="post">
                              <input type="hidden" name="id" value="' . $row["DriverNumber"] . '">
                              <select name="position" style="margin-right: 10px; padding: 5px;">
                                  <option value="">Select Position</option>
                                  <option value="Lot 60">Lot 60</option>
                                  <option value="NJ Transit Train Station">NJ Transit Train Station</option>
                                  <option value="Fenwick Hall">Fenwick Hall</option>
                                  <option value="Basie Hall">Basie Hall</option>
                                  <option value="Sinatra Hall">Sinatra Hall</option>
                                  <option value="Hawk Crossings">Hawk Crossings</option>
                                  <option value="Montclair Heights">Montclair Heights</option>
                                  <option value="Red Hawk Garage">Red Hawk Garage</option>
                                  <option value="University Hall">University Hall</option>
                                  <option value="CarParc Diem Garage">CarParc Diem Garage</option>
                                  <option value="The Heights">The Heights</option>
                                  <option value="Fenwick Hall">Fenwick Hall</option>
                              </select>
                              <input type="submit" name="update" value="Update" class="updatebutton">
                              <input type="submit" name="delete" value="Delete" class="updatebutton">
                            </form>
                          </div>
                        </td>';

                        if (isset($_POST['update']) && !empty($_POST['position'])) {
                            // Get the selected position and generate a random number between 3 and 13
                            $position = $_POST['position'];
                            $random_number = rand(3, 13);

                            // Get the current driver's RouteName
                            $route_name = $row['RouteName'];

                            // Delete all previous entries for this driver's RouteName
                            $query = "DELETE FROM ActiveRoutes WHERE RouteName = '" . $route_name . "'";
                            mysqli_query($db, $query);

                            // Insert the new entry in the ActiveRoutes table
                            $query = "INSERT INTO ActiveRoutes (RouteName, CurrentPosition, WaitTime) 
                                VALUES ('" . $route_name . "', '" . $position . "', '" . $random_number . "')";
                            mysqli_query($db, $query);
                        }
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
            echo "<p class=\"no-routes\">There are no active routes</p>";
        }

        if (isset($_POST["update"])) {
            $id = $_POST["id"];
            $position = $_POST["position"];

            if ($position !== "") {
                $query = "UPDATE ActiveBusDrivers SET CurrentPosition='$position' WHERE DriverNumber=$id";
                mysqli_query($db, $query);
                exit();
            }
        }

        if (isset($_POST['delete'])) {
            // Get the selected driver ID
            $driver_id = $_POST['id'];

            // Delete the driver from the ActiveBusDrivers table
            $query = "DELETE FROM ActiveBusDrivers WHERE DriverNumber = '" . $driver_id . "'";
            mysqli_query($db, $query);

            // Delete the corresponding route entries from the ActiveRoutes table
            $route_name = $row['RouteName'];
            $query = "DELETE FROM ActiveRoutes WHERE RouteName = '" . $route_name . "'";
            mysqli_query($db, $query);
        }

        ?>
    </section>
    <div style="height: 300px;"></div>
    <script src="./JavaScript/Script.js"></script>
</body>

</html>