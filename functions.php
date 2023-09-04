<?php
session_start();

//Connect to DB
$db = new mysqli('localhost', 'wynmane1_admin', 'Edtv10052002!', 'wynmane1_shuttlebus');

//Display Errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


/*
***********************************************************************************************
****************************************ADMIN FUNCTIONS***************************************
***********************************************************************************************
*/

//Register a User:
//Register
if (isset($_POST['Auser-register-bttn'])) {
    AregisterUser();
}

function AisUsernameUnique($username)
{
    global $db, $errors;

    $query = "SELECT * FROM User WHERE UserName='$username'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 0) return true;

    return false;
}

function AisUserEmailUnique($email)
{
    global $db, $errors;

    $query = "SELECT * FROM User WHERE email='$email'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 0) return true;

    return false;
}

function AregisterUser()
{
    global $db, $errors;

    // receive all input values from the form. Call the e() function
    // defined below to escape form values
    $fname       = $_POST['fname'];
    $lname       = $_POST['lname'];
    $username    = $_POST['username'];
    $email       = $_POST['email'];
    $password_1  = $_POST['password_1'];
    $password_2  = $_POST['password_2'];

    // form validation: ensure that the form is correctly filled
    if (empty($fname)) {
        array_push($errors, "First Name is required");
    }
    if (empty($lname)) {
        array_push($errors, "Last Name is required");
    }
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // register user if there are no errors in the form
    if (count($errors) == 0) {
        // Prepare the SQL statement to check if email is already registered
        $stmt = $db->prepare("SELECT * FROM User WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Prepare the SQL statement to check if username is taken
            $stmt = $db->prepare("SELECT * FROM User WHERE UserName=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 0) {
                $password = password_hash($password_1, PASSWORD_DEFAULT); //encrypt the password before saving in the database

                // Prepare the SQL statement to insert the data into the database
                $stmt = $db->prepare("INSERT INTO User (UserName, Password, FirstName, LastName, email) VALUES(?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $username, $password, $fname, $lname, $email);
                $stmt->execute();
                $stmt->close();

                $_SESSION['success'] = "Successful Registration.\tPlease Login to Continue";
                //Set session counter to print success message after registering and being redirected to login page
                $_SESSION['counter'] = 1;
            } else {
                array_push($errors, "Username is taken");
            }
        } else {
            array_push($errors, "Email already registered");
        }
    }
}

//Register a Driver
$username = "";
$email    = "";
$errors   = array();

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
    register();
}

function register()
{
    global $db, $errors, $username, $email;

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    if (count($errors) == 0) {
        $password = md5($password_1);
        $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : 'user';
        $stmt = $db->prepare("INSERT INTO Driver (username, email, user_type, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $user_type, $password);
        if ($stmt->execute()) {
            $logged_in_user_id = $stmt->insert_id;
            $_SESSION['user'] = getUserById($logged_in_user_id);
            header('location: ./AdminAddUser.php');
        } else {
            array_push($errors, "Error: " . $db->error);
        }
        $stmt->close();
    }
}

//Register Maintance
// call the register() function if register_btn is clicked
if (isset($_POST['main_register_btn'])) {
    registerMain();
}

function registerMain()
{
    global $db, $errors, $username, $email;

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    if (count($errors) == 0) {
        $password = md5($password_1);
        $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : 'user';
        $stmt = $db->prepare("INSERT INTO MaintenanceWorkers (username, email, user_type, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $user_type, $password);
        if ($stmt->execute()) {
            $logged_in_user_id = $stmt->insert_id;
            $_SESSION['user'] = getUserById($logged_in_user_id);
            header('location: ./AdminAddUser.php');
        } else {
            array_push($errors, "Error: " . $db->error);
        }
        $stmt->close();
    }
}



//Register User

//Login
if (isset($_POST['admin_login_btn'])) {
    Adminlogin();
}

function Adminlogin()
{
    global $db, $username, $errors;

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $stmt = $db->prepare("SELECT * FROM Admins WHERE username=? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (md5($password) == $user['password']) {
                $_SESSION['userAdmin'] = $user;
                $_SESSION['success'] = "You are now logged in";
                header('location: ./Admin/AdminHome.php');
            } else {
                array_push($errors, "Wrong username/password combination");
            }
        } else {
            array_push($errors, "Wrong username/password combination");
        }
        $stmt->close();
    }
}


// return user array from their id
function getUserById2($id)
{
    global $db;
    $query = "SELECT * FROM Admins WHERE id=" . $id;
    $result = mysqli_query($db, $query);

    $user = mysqli_fetch_assoc($result);
    return $userAdmin;
}

function AdminisLoggedIn()
{
    if (isset($_SESSION['userAdmin'])) {
        return true;
    } else {
        return false;
    }
}

//???
if (isset($_POST['admin-message'])) {
    insertMessage();
}

function insertMessage()
{
}



/*
***********************************************************************************************
****************************************DRIVER FUNCTIONS***************************************
***********************************************************************************************
*/

// Login
if (isset($_POST['login_btn'])) {
    login();
}

// LOGIN USER
function login()
{
    global $db, $username, $errors;

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $stmt = $db->prepare("SELECT * FROM Driver WHERE username=? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (md5($password) == $user['password']) {
                $_SESSION['user'] = $user;
                $_SESSION['success'] = "You are now logged in";
                if ($user['user_type'] == 'admin') {
                    header('location: admin/home.php');
                } else {
                    header('location: ./Driver/DriverHome.php');
                }
            } else {
                array_push($errors, "Wrong username/password combination");
            }
        } else {
            array_push($errors, "Wrong username/password combination");
        }
        $stmt->close();
    }
}


// return user array from their id
function getUserById($id)
{
    global $db;
    $query = "SELECT * FROM Driver WHERE id=" . $id;
    $result = mysqli_query($db, $query);

    $user = mysqli_fetch_assoc($result);
    return $user;
}

// escape string
function e($val)
{
    global $db;
    return mysqli_real_escape_string($db, trim($val));
}

function display_error()
{
    global $errors;

    if (count($errors) > 0) {
        echo '<div class="errors">';
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
        echo '</div>';
    }
}


function isLoggedIn()
{
    if (isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}


//Start or End a Route
if (isset($_POST['drive_start_stop'])) {
    DriverStartStop();
}

$driverNumber = "";
$driverFullName = "";
$routeName = "";
$routeStartTime = "";
$routeEndTime = "";

function DriverStartStop()
{
    global $db, $driverNumber, $driverFullName, $routeName, $routeStartTime;

    $driverNumber = $_POST['driverNumber'];
    $driverFullName = $_POST['driverFullName'];
    $routeName = $_POST['routeName'];
    $routeStartTime = $_POST['routeStartTime'];

    // Prepare the SQL statement
    $stmt = $db->prepare("INSERT INTO ActiveBusDrivers (DriverNumber, DriverFullName, RouteName, RouteStartTime) VALUES (?, ?, ?, ?)");
    // Bind the parameters to the statement
    $stmt->bind_param("ssss", $driverNumber, $driverFullName, $routeName, $routeStartTime);
    // Execute the statement
    $stmt->execute();
    // Close the statement
    $stmt->close();
}


$DriverNumber = "";
$DriverFullName = "";
$RouteName = "";
$RouteStartTime = "";


if (isset($_POST['delete'])) {
    global $db;
    $DriverNumber = $_POST['id'];

    // Prepare the SQL statement to retrieve the row from the database
    $stmt = $db->prepare("SELECT * FROM ActiveBusDrivers WHERE DriverNumber=?");
    $stmt->bind_param("s", $DriverNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $DriverFullName = $row['DriverFullName'];
        $RouteName = $row['RouteName'];
        $RouteStartTime = $row['RouteStartTime'];

        // Prepare the SQL statement to delete the row from the database
        $stmt = $db->prepare("DELETE FROM ActiveBusDrivers WHERE DriverNumber=?");
        $stmt->bind_param("s", $DriverNumber);
        $stmt->execute();
        $stmt->close();
    }
}


//Maintaince Request

if (isset($_POST['DriveReq'])) {
    // Retrieve the form data
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $urgency = isset($_POST['urgency']) && $_POST['urgency'] !== '' ? $_POST['urgency'] : 0;

    // Insert the form data into the database
    insertRequest($title, $description, $location, $urgency);

    // Redirect the user to a success page
    header('Location: makeRequest.php');
    exit;
}

// Define the function to insert the form data into the database
function insertRequest($title, $description, $location, $urgency)
{
    global $db;
    // Escape the form data to prevent SQL injection attacks
    $title = mysqli_real_escape_string($db, $title);
    $description = mysqli_real_escape_string($db, $description);
    $location = mysqli_real_escape_string($db, $location);
    $urgency = mysqli_real_escape_string($db, $urgency);

    // Construct the SQL query
    $sql = "INSERT INTO MaintenanceRequest (title, description, location, urgency) VALUES ('$title', '$description', '$location', $urgency)";

    // Execute the SQL query
    if (mysqli_query($db, $sql)) {
        // Redirect the user to a success page
        header('Location: makeRequest.php');
        exit();
    } else {
        echo 'Error inserting record: ' . mysqli_error($db);
        // Redirect the user to a success page
        header('Location: makeRequest.php');
        exit();
    }
}


/*
***********************************************************************************************
****************************************USER FUNCTIONS***************************************
***********************************************************************************************
*/


//Register
if (isset($_POST['user-register-bttn'])) {
    registerUser();
}

function isUsernameUnique($username)
{
    global $db, $errors;

    $query = "SELECT * FROM User WHERE UserName='$username'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 0) return true;

    return false;
}

function isUserEmailUnique($email)
{
    global $db, $errors;

    $query = "SELECT * FROM User WHERE email='$email'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 0) return true;

    return false;
}

function registerUser()
{
    global $db, $errors;

    // receive all input values from the form. Call the e() function
    // defined below to escape form values
    $fname       = $_POST['fname'];
    $lname       = $_POST['lname'];
    $username    = $_POST['username'];
    $email       = $_POST['email'];
    $password_1  = $_POST['password_1'];
    $password_2  = $_POST['password_2'];

    // form validation: ensure that the form is correctly filled
    if (empty($fname)) {
        array_push($errors, "First Name is required");
    }
    if (empty($lname)) {
        array_push($errors, "Last Name is required");
    }
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // register user if there are no errors in the form
    if (count($errors) == 0) {
        // Prepare the SQL statement to check if email is already registered
        $stmt = $db->prepare("SELECT * FROM User WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Prepare the SQL statement to check if username is taken
            $stmt = $db->prepare("SELECT * FROM User WHERE UserName=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 0) {
                $password = password_hash($password_1, PASSWORD_DEFAULT); //encrypt the password before saving in the database

                // Prepare the SQL statement to insert the data into the database
                $stmt = $db->prepare("INSERT INTO User (UserName, Password, FirstName, LastName, email) VALUES(?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $username, $password, $fname, $lname, $email);
                $stmt->execute();
                $stmt->close();

                $_SESSION['success'] = "Successful Registration.\tPlease Login to Continue";
                //Set session counter to print success message after registering and being redirected to login page
                $_SESSION['counter'] = 1;
                header('location: ./UserLogin.php');
            } else {
                array_push($errors, "Username is taken");
            }
        } else {
            array_push($errors, "Email already registered");
        }
    }
}


//Login
if (isset($_POST['user-login-bttn'])) {
    userLogin();
}

function userLogin()
{
    global $db, $errors;

    // receive all input values from the form. Call the e() function
    // defined below to escape form values\
    $username    =  e($_POST['username']);
    $password  =  e($_POST['password']);

    // form validation: ensure that the form is correctly filled
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // register user if there are no errors in the form
    if (count($errors) == 0) {
        $query = "SELECT * FROM User WHERE UserName='$username' OR email='$username'";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) == 0) {
            array_push($errors, "Incorrect credentials combination");
        } else {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['Password'])) {
                // get id of the created user

                $_SESSION['UserNumber'] = $user['UserNumber']; // put logged in user in session
                header('location: ./UserHome.php');
            } else {
                array_push($errors, "Incorrect credentials combination");
            }
        }
    }
}

function getUserInfo($UserNumber)
{
    global $db;
    $query = "SELECT * FROM User WHERE UserNumber=" . $UserNumber;
    $result = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($result);

    return $user;
}


//Edit User Info
unset($_SESSION['savedChanges']);
if (isset($_POST['save-changes-bttn'])) {
    editUserInfo();
}

function editUserInfo()
{
    global $db, $errors;

    $fname       = e($_POST['fname']);
    $lname       = e($_POST['lname']);
    $username    =  e($_POST['username']);
    $email       =  e($_POST['email']);
    $password    =  e($_POST['password']);

    // form validation: ensure that the form is correctly filled
    if (empty($fname)) {
        array_push($errors, "First Name is required");
    }
    if (empty($lname)) {
        array_push($errors, "Last Name is required");
    }
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }


    // register user if there are no errors in the form
    if (count($errors) == 0) {

        //Get user information to check if email/user is the same or already registered
        $user = getUserInfo($_SESSION['UserNumber']);
        $query = "SELECT * FROM User WHERE NOT UserNumber=" . $_SESSION['UserNumber'] . " AND email='$email'";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) > 0) {
            array_push($errors, "Email is already registered");
        } else {
            $query = "SELECT * FROM User WHERE NOT UserNumber=" . $_SESSION['UserNumber'] . " AND UserName='$username'";
            $result = mysqli_query($db, $query);

            if (mysqli_num_rows($result) > 0) {
                array_push($errors, "Username is taken");
            } else {
                if (password_verify($password, $user['Password'])) {
                    $query = "UPDATE User SET UserName='$username', email='$email', FirstName='$fname', LastName='$lname' 
                                WHERE UserNumber=" . $user['UserNumber'];
                    mysqli_query($db, $query);
                    $_SESSION['savedChanges'] = "Changes saved successfully";
                    $_SESSION['counterSC'] = 1;
                } else {
                    array_push($errors, "Incorrect password");
                }
            }
        }
    }
}

//User make maintaince request
if (isset($_POST['UserReq'])) {
    // Retrieve the form data
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $urgency = isset($_POST['urgency']) && $_POST['urgency'] !== '' ? $_POST['urgency'] : 0;

    // Insert the form data into the database
    insertUserRequest($title, $description, $location, $urgency);

    // Redirect the user to a success page
    header('Location: UserMaintenanceRequest.php');
    exit;
}

// Define the function to insert the form data into the database
function insertUserRequest($title, $description, $location, $urgency)
{
    global $db;
    // Escape the form data to prevent SQL injection attacks
    $title = mysqli_real_escape_string($db, $title);
    $description = mysqli_real_escape_string($db, $description);
    $location = mysqli_real_escape_string($db, $location);
    $urgency = mysqli_real_escape_string($db, $urgency);

    // Construct the SQL query
    $sql = "INSERT INTO MaintenanceRequest (title, description, location, urgency) VALUES ('$title', '$description', '$location', $urgency)";

    // Execute the SQL query
    if (mysqli_query($db, $sql)) {
        // Redirect the user to a success page
        $_SESSION['successm'] = "Successful Maintenance Request.";
        //Set session counter to print success message after registering and being redirected to login page
        $_SESSION['counterm'] = 1;
        header('Location: UserMaintenanceRequest.php');
        exit();
    } else {
        echo 'Error inserting record: ' . mysqli_error($db);
        // Redirect the user to a success page
        header('Location: UserMaintenanceRequest.php');
        exit();
    }
}

//Driver Announcements 
function retrieveAnnouncements()
{
    global $db, $errors;

    $query = "SELECT * FROM DriverAnnouncements ORDER BY Date, Time DESC";
    $result = mysqli_query($db, $query);
}

/*========================================LOGIN Maintenance==============================*/
// call the login() function if register_btn is clicked
if (isset($_POST['main_login_btn'])) {
    loginMain();
}

// LOGIN USER
function loginMain()
{
    global $db, $username, $errors;

    $username = $_POST['Musername'];
    $password = $_POST['Mpassword'];

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $stmt2 = $db->prepare("SELECT * FROM MaintenanceWorkers WHERE username=? LIMIT 1");
        $stmt2->bind_param("s", $username);
        $stmt2->execute();
        $result = $stmt2->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (md5($password) == $user['password']) {
                $_SESSION['user'] = $user;
                $_SESSION['success'] = "You are now logged in";
                if ($user['user_type'] == 'admin') {
                    header('location: admin/home.php');
                } else {
                    header('location: ./Maintenance/MaintenanceHome.php');
                }
            } else {
                array_push($errors, "Wrong username/password combination");
            }
        } else {
            array_push($errors, "Wrong username/password combination");
        }
        $stmt2->close();
    }
}


// return user array from their id
function getMUserById($id)
{
    global $db;
    $queryy = "SELECT * FROM MaintenanceWorkers WHERE id=" . $id;
    $resultt = mysqli_query($db, $queryy);

    $userr = mysqli_fetch_assoc($resultt);
    return $userr;
}