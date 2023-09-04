let infoWindow;

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );
  infoWindow.open(map);
}

document.addEventListener("DOMContentLoaded", () => {
  const locationButton = document.getElementById("locationButton");

  locationButton.addEventListener("click", () => {
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };

          if (!infoWindow) {
            infoWindow = new google.maps.InfoWindow();
          }

          //Add Marker
          const marker = new google.maps.Marker({
            map: map,
            position: pos,
            title: "Current Location",
          });

          map.setCenter(pos);

          //Retrieve driver ID from session variable
          const driverId = 1;

          //Insert or update driver location in database
          const url = "update_driver_location.php"; 
          const data = { 
            driver_id: driverId, 
            latitude: pos.lat, 
            longitude: pos.lng 
          };

          const xhr = new XMLHttpRequest();
          xhr.open("POST", url);
          xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
          xhr.onload = () => {
            if (xhr.status === 200) {
              try {
                const driver = JSON.parse(xhr.responseText);
                console.log(driver);
              } catch (e) {
                console.error("Error parsing JSON response:", e);
              }
            }
          };
          xhr.send(JSON.stringify(data));
          
          console.log("Latitude: " + pos.lat);
          console.log("Longitude: " + pos.lng);
        },
        () => {
          handleLocationError(true, infoWindow, map.getCenter());
        }
      );
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }
  });
});
