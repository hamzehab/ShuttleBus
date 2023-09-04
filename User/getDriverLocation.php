<?php
// Connect to the database (replace with your own credentials)
$servername = "localhost";
$username = "wynmane1";
$password = "Edtv10052002!";
$dbname = "wynmane1_shuttlebus";

$conn = new mysqli($servername, $username, $password, $dbname);

// Get the driver ID from the POST request
$driverId = 1;

// Retrieve the driver's location data from the database
$sql = "SELECT latitude, longitude FROM Driver WHERE id = '$driverId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Convert the location data to a JSON string
  $row = $result->fetch_assoc();
  $locationData = array("latitude" => $row["latitude"], "longitude" => $row["longitude"]);
  $json = json_encode($locationData);

  // Send the JSON string to the JavaScript file
  header('Content-Type: application/json');
  echo $json;
} else {
  echo "No location data found for driver ID: " . $driverId;
}

$conn->close();
?>