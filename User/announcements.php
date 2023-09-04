<?php include('../functions.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShuttleBus - Announcements</title>
  <link rel="stylesheet" href="./homeStyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<nav class="navbar">
    <div class="logo">
      <a href="./UserHome.php" style="color: white;">ShuttleBus</a>
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
     <div class="schedule" style="margin">
        <h1 class="title">Announcements</h1>
        <p style = "text-align:center; color:white;">
        Welcome to the Montclair State University Shuttle Bus System Announcement page! 
        Here you can stay up to date on all the latest news and updates regarding the shuttle bus service. 
        Our shuttle bus system is designed to provide students with a safe and convenient transportation option around campus. 
        We understand that getting to and from classes can be a challenge, which is why we're committed to making your commute as hassle-free as possible.
        To ensure that you stay informed, we regularly send out announcements to keep you up to date on any changes or disruptions to the service. 
        These announcements are sent by our drivers, who are dedicated to providing you with the best possible service.
        To view the latest announcements, simply visit this page regularly or sign up to receive email notifications. 
        You can also follow us on social media to stay connected and get the latest news.
        Thank you for choosing Montclair State University Shuttle Bus System. 
        We're proud to serve you and look forward to making your time on campus as comfortable and enjoyable as possible.
    </p>
    </div>
    <br><br>
    </section>
  <div class="container" style="margin-bottom: 50px;">
    <div class="announcements">
        <?php
          //Get the current page number
          $page = isset($_GET['page']) ? $_GET['page'] : 1;
          $offset = ($page - 1) * 5;
          // Fetch all announcements
          $query = "SELECT * FROM DriverAnnouncements ORDER BY Date, Time DESC LIMIT 5 OFFSET $offset";
          $result = mysqli_query($db, $query);
    
          // Check if there are any announcements
          $announcements = array();
          while($row = mysqli_fetch_assoc($result)){
              $announcements[] = $row;
          }
          
          foreach ($announcements as $announcement){
              $announcement_date = date('F j, Y', strtotime($announcement['Date']));
              $announcement_time = date('h:i A', strtotime($announcement['Time']));
              
              echo "<div class='announcement'>";
              echo "<h2>" . $announcement['Title'] . "</h2>";
              echo "<p class='date'>" . $announcement_date. "</p>";
              echo "<p class='description'>" . $announcement['Description'] . "</p>";
              echo "<p class='time'>" . $announcement_time . " EST<p>";
              echo "</div>";
          }
          
          $query = "SELECT COUNT(*) as total FROM DriverAnnouncements";
          $result = mysqli_query($db, $query);
          $row = mysqli_fetch_assoc($result);
          $total_pages = ceil($row['total'] / 5);
          
          echo "<ul>"; ?>
          <div style="text-align:center;">
            <div class="pagination">
            <?php if($page > 1) echo "<a href='?page=".($page - 1)."'><i class='fa fa-arrow-left'></i></a>";?>
            <?php 
                if($total_pages > 1){
                    for($i=1; $i<=$total_pages; $i++){
                        if($i == $page){
                            echo "<span class='current-page'>$i</span>";
                        }
                }
            }?>
            <?php if($page < $total_pages) echo "<a href='?page=".($page + 1)."'><i class='fa fa-arrow-right'></i></a>";?>
            </div>
        </div>

        <?php 
            // Close database connection
            mysqli_close($db);
        ?>
    </div>
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
