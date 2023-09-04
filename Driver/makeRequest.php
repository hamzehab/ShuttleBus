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
    <title>Driver | Make Request</title>
    <!-- CSS Styles -->
    <link rel="stylesheet" href="./CSS/homeStyle.css">

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuHy-8zWn8DSaq6g7UuOmcWLUaVv9SreE&callback=initMap" async defer></script>
    <script src="./initMap.js"></script>
    <script src="./getCurrentCoordinates.js"></script>
    <link rel="stylesheet" href="style.css">

    <style>
        /* Set the font and background color for the form */
        form {
            font-family: Arial, sans-serif;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 50%;
            margin: auto;
        }

        /* Set the style for the form elements */
        input[type=text],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: none;
            border-bottom: 2px solid black;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
            font-size: 16px;
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
        }

        /* Set the style for the form labels */
        label {
            font-weight: bold;
            font-size: 18px;
            color: black;
        }

        /* Set the style for the form header */
        h2 {
            font-size: 24px;
            color: #ff4d4d;
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Set the style for the form error messages */
        .error {
            color: red;
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
    <h1 style="text-align: center; margin: 25px">Maintenance Request Form</h1>
    <form action="makeRequest.php" method="POST">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br>

        <label for="location">Location:</label>
        <input type="text" name="location" id="location" required><br>

        <label for="urgency">Urgency:</label>
        <select name="urgency" id="urgency" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select><br>

        <input type="submit" value="Submit" name="DriveReq">
    </form>
</body>

</html>