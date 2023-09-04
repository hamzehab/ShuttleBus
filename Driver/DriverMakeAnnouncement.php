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
        <title>Driver Announcements Form</title>
        <!-- CSS Styles -->
        <link rel="stylesheet" href="./CSS/homeStyle.css">


        <link rel="stylesheet" href="style.css">
        <style>
            /* Set the font and background color for the form */
            form {
                margin-top: 50px;
                font-family: Arial, sans-serif;
                background-color: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                max-width: 600px;
                margin: 0 auto;
            }

            /* Set the style for the form elements */
            input[type=text],
            select,
            textarea {
                width: 100%;
                padding: 8px;
                border: none;
                border-bottom: 1px solid black;
                box-sizing: border-box;
                margin-top: 16px;
                margin-bottom: 32px;
                resize: vertical;
                font-size: 16px;
                font-weight: bold;
            }

            /* Set the style for the submit button */
            input[type=submit] {
                background-color: #ff4d4d;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
                font-weight: bold;
            }

            /* Set the style for the form labels */
            label {
                display: block;
                font-size: 16px;
                font-weight: bold;
                color: black;
                margin-bottom: 8px;
            }

            /* Set the style for the form header */
            h2 {
                font-size: 24px;
                color: #ff4d4d;
                margin-top: 0;
                text-align: center;
            }

            /* Set the style for the form error messages */
            .error {
                color: red;
                font-size: 14px;
                margin-top: 4px;
            }

            /* Style the success message */
            .success {
                color: green;
                font-size: 14px;
                margin-top: 4px;
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
                <li><a href="./DriverHome.php">Home</a></li>
                <li><a href="./makeRequest.php">Make Request</a></li>
                <li><a href="./DriverStartEndRoute.php">Start/End Route</a></li>
                <li><a href="./DriverMakeAnnouncement.php">Make Announcement</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </div>
        </ul>
    </nav>

    <body>

        <?php
        // Connect to the database
        $conn = mysqli_connect('localhost', 'wynmane1_admin', 'Edtv10052002!', 'wynmane1_shuttlebus');
        if (!$conn) {
            die('Connection failed: ' . mysqli_connect_error());
        }

        // Check if the form has been submitted
        if (isset($_POST['submitDriverAnn'])) {
            // Get the data from the form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $date = $_POST['date'];
            $time = $_POST['time'];


            // Construct the SQL query to insert the data into the DriverAnnouncements table
            $sql = "INSERT INTO DriverAnnouncements (Title, Description, Date, Time)
                VALUES ('$title', '$description', '$date', '$time')";

            // Execute the SQL query
            if (mysqli_query($conn, $sql)) {
                echo "Announcement added successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        mysqli_close($conn);
        ?>

        <!-- Form to submit data to the DriverAnnouncements table -->
        <form method="post" sty;e="margin-top:50px;">
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title" required><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description" required></textarea><br>

            <label for="date">Date:</label><br>
            <input type="date" id="date" name="date" required><br>

            <label for="time">Time:</label><br>
            <input type="time" id="time" name="time" required><br>

            <input type="submit" name="submitDriverAnn" value="Submit">
        </form>

    </body>

</html>