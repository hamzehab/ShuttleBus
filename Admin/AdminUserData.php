<?php include('../functions.php'); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Admin | Manage Users</title>
        <!-- CSS Styles -->
        <link rel="stylesheet" href="./CSS/style.css" />

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

        <style>
            button[name="delete_user"] {
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

            button[name="delete_user"]:hover {
                background-color: #cc0000;
            }

            button[name="delete_driver"] {
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

            button[name="delete_driver"]:hover {
                background-color: #cc0000;
            }

            button[name="delete_worker"] {
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

            button[name="delete_worker"]:hover {
                background-color: #cc0000;
            }

            button[name="edit_driver"] {
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

            button[name="edit_driver"]:hover {
                background-color: #cc0000;
            }
            button[name="submit_worker"] {
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

            button[name="submit_worker"]:hover {
                background-color: #cc0000;
            }
            button[name="submit_user"] {
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

            button[name="submit_user"]:hover {
                background-color: #cc0000;
            }

            .success-message {
                background-color: #d4edda;
                border-color: #c3e6cb;
                color: #155724;
                padding: 12px;
                margin-top: 10px;
                border-radius: 4px;
            }
        </style>
    </head>

    <body>
        <div style="margin-top: 50px; text-align: center; margin-left: 150px">
            <!--==========================USER INFO============================-->
            <h1 style="color: red; text-align: center;">User Infomation</h1>
            <?php
            $conn = mysqli_connect('localhost', 'wynmane1_admin', 'Edtv10052002!', 'wynmane1_shuttlebus');
            if (!$conn) {
                die('Could not connect: ' . mysqli_error($conn));
            }

            // Delete user if delete button is clicked
            if (isset($_POST['delete_user'])) {
                $user_number = $_POST['delete_user'];
                $sql = "DELETE FROM User WHERE UserNumber = '$user_number'";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die('Error: ' . mysqli_error($conn));
                }
                echo '<div class="success-message">User deleted successfully</div>';
            }
            
            if (isset($_POST['submit_user'])) {
                $id = $_POST['UserNumber'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $sql = "UPDATE User SET username='$username', email='$email' WHERE UserNumber='$id'";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die('Error: ' . mysqli_error($conn));
                }
                echo '<div class="success-message">User updated successfully</div>';
            }

            // Query the database
            $sql = "SELECT UserNumber, UserName, Password, FirstName, LastName, email FROM User";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die('Error: ' . mysqli_error($conn));
            }

            // Display the results in an HTML table
            echo "<table>";
            echo "<tr><th>ID</th><th>Username</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Action</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['UserNumber'] . "</td>";
                echo "<td>" . $row['UserName'] . "</td>";
                echo "<td>" . $row['FirstName'] . "</td>";
                echo "<td>" . $row['LastName'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo '<td>
                <form method="post" action="">
                    <input type="hidden" name="UserNumber" value="' . $row['UserNumber'] . '">
                    <input type="text" name="username" placeholder="Username" value="' . $row['UserName'] . '">
                    <input type="email" name="email" placeholder="Email" value="' . $row['email'] . '">
                    <button type="submit" name="submit_user">Save</button>
                    <button type="submit" name="delete_user" value="' . $row['UserNumber'] . '">Delete</button>
                </form>
             </td>';
                echo "</tr>";
            }
            echo "</table>";

            ?><br><br><br>

            <!--=========================DRIVER INFO====================================-->
            <h1 style="color: red; text-align: center;">Driver Infomation</h1>
            <?php
            // Delete Driver if delete button is clicked
            if (isset($_POST['delete_driver'])) {
                $user_number = $_POST['delete_driver'];
                $sql = "DELETE FROM Driver WHERE id = '$user_number'";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die('Error: ' . mysqli_error($conn));
                }
                echo '<div class="success-message">User deleted successfully</div>';
            }
            // Check if the edit button was clicked
            if (isset($_POST["edit"])) {
                // Get the driver ID from the form data
                $id = $_POST["id"];

                // SQL query to fetch the row with the corresponding driver ID
                $query = "SELECT * FROM Driver WHERE id='$id'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);

                // Display the form to edit the row
                echo "<form method='post' action=''>";
                echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                echo "<label for='username'>Username:</label>";
                echo "<input type='text' name='username' value='" . $row["username"] . "'><br>";
                echo "<label for='email'>Email:</label>";
                echo "<input type='text' name='email' value='" . $row["email"] . "'><br>";
                echo "<button type='submit' name='update'>Update</button>";
                echo "</form>";
            }

            // Check if the update button was clicked
            if (isset($_POST["update"])) {
                // Get the form data
                $id = $_POST["id"];
                $username = $_POST["username"];
                $email = $_POST["email"];

                // SQL query to update the row in the database
                $query = "UPDATE Driver SET username='$username', email='$email' WHERE id='$id'";
                mysqli_query($conn, $query);
                echo '<div class="success-message">Driver updated successfully</div>';
            }
            ?>

            <h2>Driver List</h2>
            <?php
            $sql = "SELECT id, username, email, password FROM Driver";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die('Error: ' . mysqli_error($conn));
            }

            // Display the results in an HTML table
            echo "<table>";
            echo "<tr><th>Driver ID</th><th>Username</th><th>Email</th><th>Action</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo '<td>
                <form method="post" action="">
                    <input type="hidden" name="id" value="' . $row['id'] . '">
                    <button type="submit" name="edit_driver" value="' . $row['id'] . '">Edit</button>
                    <button type="submit" name="delete_driver" value="' . $row['id'] . '">Delete</button>
                </form>
                </td>';
                echo "</tr>";
            }
            echo "</table>";
            ?>
            <br> <br> <br> <br>
            <!--=============================MAINTENANCE INFO======================================-->
            <h1 style="color: red; text-align: center;">Maintenance Worker Information</h1>
            <?php
            // Delete Maintenance Worker if delete button is clicked
            if (isset($_POST['delete_worker'])) {
                $worker_id = $_POST['delete_worker'];
                $sql = "DELETE FROM MaintenanceWorkers WHERE id = '$worker_id'";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die('Error: ' . mysqli_error($conn));
                }
                echo '<div class="success-message">Maintenance Worker deleted successfully</div>';
            }

            // Update Maintenance Worker if form is submitted
            if (isset($_POST['submit_worker'])) {
                $id = $_POST['id'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $sql = "UPDATE MaintenanceWorkers SET username='$username', email='$email' WHERE id='$id'";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die('Error: ' . mysqli_error($conn));
                }
                echo '<div class="success-message">Maintenance Worker updated successfully</div>';
            }

            // Query Maintenance Workers table
            $sql = "SELECT id, username, email, password FROM MaintenanceWorkers";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die('Error: ' . mysqli_error($conn));
            }

            // Display the results in an HTML table
            echo "<table>";
            echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Action</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo '<td>
                <form method="post" action="">
                    <input type="hidden" name="id" value="' . $row['id'] . '">
                    <input type="text" name="username" placeholder="Username" value="' . $row['username'] . '">
                    <input type="email" name="email" placeholder="Email" value="' . $row['email'] . '">
                    <button type="submit" name="submit_worker">Save</button>
                    <button type="submit" name="delete_worker" value="' . $row['id'] . '">Delete</button>
                </form>
            </td>';
                echo "</tr>";
            }
            echo "</table>";
            ?>
        </div>
    </body>
</html>