<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Icons -->
    <link
      rel="stylesheet"
      href="https://kit.fontawesome.com/201778e25e.css"
      crossorigin="anonymous"
    />
    <script
      src="https://kit.fontawesome.com/9ea20d0aca.js"
      crossorigin="anonymous"
    ></script>
    <title>Shuttlebus Home</title>

    <!-- Link CSS -->
    <link rel="stylesheet" href="./style.css" />
  </head>
  <nav class="navbar" style="background-color:  #edf2f4;">
    <!-- LOGO -->
    <div class="logo" style="color: #ef233c;">ShuttleBus</div>
    <!-- NAVIGATION MENU -->
    <ul class="nav-links">
      <!-- USING CHECKBOX HACK -->
      <input type="checkbox" id="checkbox_toggle" />
      <label for="checkbox_toggle" class="hamburger" style="color: #ef233c;">&#9776;</label>
      <!-- NAVIGATION MENUS -->
      <div class="menu">
        <li><a href="#home" style="color: #ef233c;">Home</a></li>
        <li><a href="#About" style="color: #ef233c;">About</a></li>
        <li><a href="./User/UserRegistration.php" style="color: #ef233c;">Sign Up</a></li>
        <li class="services" style="color: #ef233c;">
          <a href="/" style="color: #ef233c;">Login</a>
          <!-- DROPDOWN MENU -->
          <ul class="dropdown" style="background-color: #edf2f4;">
            <li><a href="./User/UserLogin.php" style="color: #ef233c;">User</a></li>
            <li><a href="./maintenanceLogin.php" style="color: #ef233c;">Maintenance</a></li>
            <li><a href="./DriverLogin.php" style="color: #ef233c;">Driver</a></li>
            <li><a href="./AdminLogin.php" style="color: #ef233c;">Admin</a></li>
            <li><a href="./Guest/GuestLogin.php" style="color: #ef233c;">Guest</a></li>
          </ul>
        </li>
        <li><a href="#Contact" style="color: #ef233c;">Contact</a></li>
      </div>
    </ul>
  </nav>

  <body>
    <section class="container1" id="home">
      <div class="leftSquare">
        <h4 class="featHead">Features:</h4>
        <div class="featText" style="text-align: center">
          <ul>
            <li style="text-align: left">
              <i class="fa-regular fa-circle-check"></i> Real-time shuttle
              tracking
            </li>
            <li style="text-align: left">
              <i class="fa-regular fa-circle-check"></i> See locations of all
              active shuttles
            </li>
            <li style="text-align: left">
              <i class="fa-regular fa-circle-check"></i> User-friendly interface
              with campus and shuttle maps
            </li>
            <li style="text-align: left">
              <i class="fa-regular fa-circle-check"></i> Select specific shuttle
              routes to track
            </li>
            <li style="text-align: left">
              <i class="fa-regular fa-circle-check"></i> Estimated arrival times
              for each shuttle stop
            </li>
            <li style="text-align: left">
              <i class="fa-regular fa-circle-check"></i> And More!
            </li>
          </ul>
        </div>
      </div>

      <div class="ImageCarousel">
        <img src="./Assets/Image1.jpg" alt="Image 1" />
        <img src="./Assets/Image2.jpg" alt="Image 2" />
        <img src="./Assets/Image3.jpg" alt="Image 3" />
      </div>
    </section>
    <div
      style="
        color: black;
        padding-top: 710px;
        font-size: 34px;
        text-align: center;
      "
      id="About"
    >
      About ShuttleBus
    </div>
    <section class="container2">
      <!-- For Users -->
      <div class="card">
        <div class="card-content hover">
          <div class="main-content">
            <div class="main-title">
              <h2 class="main-title-text">Ease Of Mind</h2>
            </div>
            <div class="main-para">
              <p>
                Know where the shuttle is at every moment so 
                you can always be on time and spend less time 
                at the bus stop.
              </p>
            </div>
          </div>
          <div class="card-title">
            <h2 class="card-text">For Users</h2>
          </div>
        </div>
        <img src="./Assets/Students.jpg" alt="">
      </div>

      <!-- For Faculty -->
      <div class="card">
        <div class="card-content hover">
          <div class="main-content">
            <div class="main-title">
              <h2 class="main-title-text">Know What Needs to Happen</h2>
            </div>
            <div class="main-para">
              <p>
                See all request that are needed to be fixed from users 
                and drivers. See what needs to be done to keep the 
                operation running smoothy.
              </p>
            </div>
          </div>
          <div class="card-title">
            <h2 class="card-text">For Maintenance</h2>
          </div>
        </div>
        <img src="./Assets/Faculty.jpg" alt="">
      </div>

      <!-- FOr Drivers -->
      <div class="card">
        <div class="card-content hover">
          <div class="main-content">
            <div class="main-title">
              <h2 class="main-title-text">Less Time At Stops</h2>
            </div>
            <div class="main-para">
              <p>
                Have passengers waiting to get on with accurate 
                tracking of the shuttle postion.
              </p>
            </div>
          </div>
          <div class="card-title">
            <h2 class="card-text">For Drivers</h2>
          </div>
        </div>
        <img src="./Assets/Driver.jpg" alt="">
      </div>
    </section>

    <div class="space" style="height: 100px"></div>

    <section class="contact-form" id="Contact">
      <h2>Contact Us</h2>
      <form action="./index.php" method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required />

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required />

        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" required />

        <label for="message">Message</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit" name="admin-message">Submit</button>
      </form>
    </section>

    <div class="space" style="height: 100px"></div>

    <footer>
      <div class="footer-content">
        <h3>ShuttleBus</h3>
        <p>123 Main St. | Cool City, USA 12345</p>
        <p>Email: info@shuttlebus.com</p>
        <p>Phone: 555-123-4567</p>
      </div>
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
      <p>&copy; 2023 ShuttleBus. All rights reserved.</p>
    </footer>

    <!-- Link JS -->
    <script src="./JS/Scripts.js"></script>
  </body>
</html>
