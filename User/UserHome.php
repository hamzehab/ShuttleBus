<?php
    include('../functions.php');
    if(!isset($_SESSION['UserNumber'])) header('location: ../index.php');
    $user = getUserInfo($_SESSION['UserNumber']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--CSS Styles-->
    <link rel="stylesheet" href="./homeStyle.css" />
    <title>User | Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
  
    <script src="./initMap.js"></script>
    <link rel="stylesheet" href="./style.css">
    
    
  </head>
<nav class="navbar">
    <!-- LOGO -->
    <!-- Check if user is logged in, if they are the logo redirects to home page. If they are not send them back to the landing page.-->
    <div class="logo"><a href="<?php if (isset($_SESSION['UserNumber'])) echo './UserHome.php'; else echo '../index.php';?>" style="color:white;">ShuttleBus</a></div>
    <!-- NAVIGATION MENU -->
    <ul class="nav-links">
      <!-- USING CHECKBOX HACK -->
      <input type="checkbox" id="checkbox_toggle" />
      <label for="checkbox_toggle" class="hamburger">&#9776;</label>
      <!-- NAVIGATION MENUS -->
      <div class="menu">
        <li><a href="./announcements.php"><center><img src="./Images/AnnouncementIcon.png" alt="Announcements" style="width:70%"></center></a></li>
        <li><a href="./UserMaintenanceRequest.php"><center><img src="./Images/MaintenanceIcon.png" alt="Announcements" style="width:70%"></center></a></li>
        <li><a href="./UserAccount.php"><center><img src="./Images/ProfileIcon.png" alt="Profile Icon" style="width:70%"></center></a></li>
        <li><a href="../logout.php"><center><img src="./Images/LogoutIcon.png" alt="Logout" style="width:30%">Logout</center></a></li>
      </div>
    </ul>
  </nav>
  <body style="padding: 0;">
  <section style="margin-top: 45px; margin-bottom: 50px;" class="container1">
    <h2 style="color: black;">Welcome <?php echo $user['FirstName'] . " " . $user['LastName'] . "!";?></h2>
    <?php
      // Fetch all route names from the BusRoutes table
      $query = "SELECT * FROM BusRoutes";
      $result = mysqli_query($db, $query);
    
      // Store all route names in an array
      $routes = array();
      while ($row = mysqli_fetch_assoc($result)){
          array_push($routes, $row);
      }
    ?>
    
      <!-- Display the schedule in a table -->
     <div class="schedule">
        <h2>Shuttle Schedule</h2>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Route Name</th>
                    <th>Stops</th>
                    <th>Schedule</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($routes as $route){ ?>
                    <tr>
                        <td><?php echo $route['RouteName'];?></td>
                        <td><?php echo $route['Stops'];?></td>
                        <td><?php echo $route['Schedule'];?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
            <button class="submitButton">
                <a href="./Images/Shuttle-Map.pdf" style=" color: white !important;">View Shuttle Map</a>
            </button>
             <button class="submitButton">
                <a href="./Images/CampusMap.png" style=" color: white !important;">View Campus Map</a>
            </button>
        
    </div>
    <br><br>
    <h1 class="title">Active Routes</h1>
    <table class="routes-table">
    <thead>
      <tr>
        <th>Route Name</th>
        <th>Wait Time</th>
        <th>Current Position</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * 5;
    $query = "SELECT * FROM ActiveRoutes LIMIT 5 OFFSET $offset";
    $result = mysqli_query($db, $query);
    
    $activeRoutes = array();
    while ($row = mysqli_fetch_assoc($result)){
        $activeRoutes[] = $row;
    }
    
    foreach ($activeRoutes as $activeRoute){
        echo "<tr>";
        echo "<td>" . $activeRoute['RouteName'] . "</td>";
        echo "<td>" . rand(3,15) . " minutes" . "</td>";
        echo "<td>" . $activeRoute['CurrentPosition'] . "</td>";
        echo "</tr>";
    }
    
    $query = "SELECT COUNT(*) as total FROM ActiveRoutes";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $total_pages = ceil($row['total'] / 5);
  ?>
    </tbody>
  </table>
  <?php echo "<ul>"; ?>
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
</section>
<br><br>
        <div class="container" style="margin: auto;">
          <h1>Live Shuttle Location</h1>
          <div id="driver-location"></div>
          <div id="map"></div>
          <div class="space" style="height: 300px;"></div>
        </div>
        
<div class="footer">
  <p>&copy; 2023 ShuttleBus Inc. All Rights Reserved.</p>
  <p>
    <a href="#" class="footer-link">Privacy Policy</a>
    <a href="#" class="footer-link">Terms of Use</a>
  </p>
</div>

</body>
</html>
