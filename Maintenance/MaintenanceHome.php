<?php 
include('../functions.php');
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance | Home</title>
    
    <!-- CSS Styles -->
    <link rel="stylesheet" href="./CSS/homeStyle.css">
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
                <li><a href="./MaintenanceHome.php">Home</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </div>
        </ul>
    </nav>

        <h1>Maintenance Request List</h1>
        
        <?php
        // Connect to the database
        $conn = mysqli_connect ('localhost', 'wynmane1_admin', 'Edtv10052002!', 'wynmane1_shuttlebus');
        
        // Check if the connection was successful
        if (!$conn) {
            die('Connection failed: ' . mysqli_connect_error());
        }
        
        // Check if the delete button has been clicked
        if (isset($_POST['delete_button'])) {
            // Get the ID of the row to be deleted
            $id = $_POST['delete_button'];
        
            // Construct the SQL query to delete the record from the MaintenanceRequest table
            $sql = "DELETE FROM MaintenanceRequest WHERE request_number = $id";
        
            // Execute the SQL query
            if (mysqli_query($conn, $sql)) {
                echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }
        }
        
        // Construct the SQL query to retrieve all the records from the MaintenanceRequest table
        $sql = "SELECT * FROM MaintenanceRequest";
        
        // Execute the SQL query
        $result = mysqli_query($conn, $sql);
        
        // Check if the query was successful
        if (mysqli_num_rows($result) > 0) {
            // Display the table header
            echo '<table>';
            echo '<tr><th style="background-color: red; color: white;">Request Number</th><th style="background-color: red; color: white;">Title</th><th style="background-color: red; color: white;">Description</th><th style="background-color: red; color: white;">Location</th><th style="background-color: red; color: white;">Urgency</th><th style="background-color: red; color: white;">Action</th></tr>';
        
            // Loop through the query results and display each record in a row of the table
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['request_number'] . '</td>';
                echo '<td>' . $row['title'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
                echo '<td>' . $row['location'] . '</td>';
                echo '<td>' . $row['urgency'] . '</td>';
                echo '<td><form method="post"><button type="submit" name="delete_button" value="' . $row['request_number'] . '">Delete</button></form></td>';
                echo '</tr>';
            }
        
            // Display the table footer
            echo '</table>';
        } else {
            echo '<p style: text-align: center; color: red; font-size: 25px>No records found</p>';
        }
        
        // Close the database connection
        mysqli_close($conn);
?>

</body>
</html>
