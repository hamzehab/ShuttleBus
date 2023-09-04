<?php
/*
//Display Errors
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Connect to the database (replace with your own credentials)
$servername = "localhost";
$username = "wynmane1";
$password = "Edtv10052002!";
$dbname = "wynmane1_shuttlebus";

$conn = new mysqli($servername, $username, $password, $dbname);

// Get the driver ID and location data from the POST request
$driverId = 1;
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];

echo "POST Data: ";
print_r($_POST);

echo "Driver ID: " . $driverId . "\n";
echo "Latitude: " . $latitude . "\n";
echo "Longitude: " . $longitude . "\n";

// Update existing record with new location data
$sql = "UPDATE Driver SET latitude = '$latitude', longitude = '$longitude', last_updated = NOW() WHERE id = '$driverId'";

echo "The query is: " . $sql . "\n";
echo "The driver id is: " . $driverId . "\n";

// Execute the SQL statement and check for errors
if ($conn->query($sql) === TRUE) {
  echo "Location updated \n";
} else {
  // Insert new record with driver ID and location data
  $sql = "INSERT INTO Driver (id, latitude, longitude, last_updated) VALUES ('$driverId', '$latitude', '$longitude', NOW())";

  // Execute the SQL statement and check for errors
  if ($conn->query($sql) === TRUE) {
    echo "Location inserted \n";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
*/
//Display Errors
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Connect to the database (replace with your own credentials)
$servername = "localhost";
$username = "wynmane1";
$password = "Edtv10052002!";
$dbname = "wynmane1_shuttlebus";

$conn = new mysqli($servername, $username, $password, $dbname);

// Get the driver ID and location data from the POST request
$driverId = 1;
$locationData = json_decode(file_get_contents('php://input'), true);
$latitude = $locationData["latitude"];
$longitude = $locationData["longitude"];

echo "Driver ID: " . $driverId . "\n";
echo "Latitude: " . $latitude . "\n";
echo "Longitude: " . $longitude . "\n";

// Update existing record with new location data
$sql = "UPDATE Driver SET latitude = '$latitude', longitude = '$longitude', last_updated = NOW() WHERE id = '$driverId'";

echo "The query is: " . $sql . "\n";
echo "The driver id is: " . $driverId . "\n";

// Execute the SQL statement and check for errors
if ($conn->query($sql) === TRUE) {
  echo "Location updated \n";
} else {
  // Insert new record with driver ID and location data
  $sql = "INSERT INTO Driver (id, latitude, longitude, last_updated) VALUES ('$driverId', '$latitude', '$longitude', NOW())";

  // Execute the SQL statement and check for errors
  if ($conn->query($sql) === TRUE) {
    echo "Location inserted \n";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();

?>
