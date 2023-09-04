<?php 
include('../functions.php'); 
if(!isset($_SESSION['UserNumber'])) header('location: ../index.php');
$user = getUserInfo($_SESSION['UserNumber']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShuttleBus - Maintenance Request</title>
  <link rel="stylesheet" href="./homeStyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
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
        input[type=text], select, textarea {
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
    <div class="logo">
      <div class="logo"><a href="<?php if (isset($_SESSION['UserNumber'])) echo './UserHome.php'; else echo '../index.php';?>" style="color:white;">ShuttleBus</a></div>
    </div>
    <ul class="nav-links">
      <input type="checkbox" id="checkbox_toggle" />
      <label for="checkbox_toggle" class="hamburger">&#9776;</label>
      <div class="menu">
        <li>
          <a href="./announcements.php">
              <center>
            <img src="./Images/AnnouncementIcon.png" alt="Announcements" style="width: 70%">
            </center>
          </a>
        </li>
        <li>
          <a href="./UserMaintenanceRequest.php">
              <center>
            <img src="./Images/MaintenanceIcon.png" alt="Maintenance" style="width: 70%">
            </center>
          </a>
        </li>
        <li>
          <a href="./UserAccount.php">
              <center>
            <img src="./Images/ProfileIcon.png" alt="Profile Icon" style="width: 70%">
            </center>
          </a>
        </li>
        <li>
          <a href="../logout.php">
              <center>
            <img src="./Images/LogoutIcon.png" alt="Logout" style="width: 30%">
            Logout
            </center>
          </a>
        </li>
      </div>
    </ul>
  </nav>
<body style="padding: 0;">
  <section style="margin-top: 45px;" class="containerAnnouncements">
     <div class="schedule">
        <h1 class="title">Maintenance Request Form</h1>
        <p style = "text-align:center; color:white;">
        Welcome to the Montclair State University Shuttle Bus System Maintenance Request page! 
        Here you can fill out the maintenance request form if there is anything that needs to fixed and maintained.
        This allows us to make any changes and fixes that we need to make as quickly and effectively as possible.
        Our shuttle bus system is designed to provide students with a safe and convenient transportation option around campus. 
        We understand that getting to and from classes can be a challenge, which is why we're committed to making your commute as hassle-free as possible.
        Thank you for choosing Montclair State University Shuttle Bus System. 
        We're proud to serve you and look forward to making your time on campus as comfortable and enjoyable as possible.
    </p>
    </div>
    <br><br>
    </section>
  <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <form action="UserMaintenanceRequest.php" method="POST">
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

        <input type="submit" value="Submit" name="UserReq">
    </form>
  </div>
  <br><br>
  
  
  <div class="footer">
  <p>&copy; 2023 ShuttleBus Inc. All Rights Reserved.</p>
  <p>
    <a href="#" class="footer-link">Privacy Policy</a>
    <a href="#" class="footer-link">Terms of Use</a>
  </p>
</div>

</body>
</html>