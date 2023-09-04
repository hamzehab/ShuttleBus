console.log("JS CODE!!!")

async function initMap() {
  // Request needed libraries.
  //@ts-ignore
  const { Map, Marker } = await google.maps.importLibrary("maps");

  // The map, centered at the position and zoomed in
  const map = new Map(document.getElementById("map"), {
    zoom: 15,
    center: { lat: 40.86602158915414, lng: -74.19746694242397 },
    mapId: "DEMO_MAP_ID",
  });

  // Create a marker to represent the driver's location
  const marker = new Marker({
    map,
  });

setInterval(function() {
  console.log('Fetching driver location...');

  // Use fetch API to send a request to your PHP script to get the driver's coordinates
  fetch('getDriverLocation.php')
    .then(response => response.json())
    .then(data => {
      // Get the latitude and longitude values from the JSON response
      const { lat, lng } = data;

      // Log the latitude and longitude values to the console
      console.log(`Latitude: ${lat}, Longitude: ${lng}`);

      // Update the marker's position with the new coordinates
      marker.setPosition({ lat, lng });
    })
    .catch(error => console.error(error));
}, 5000); // Update the marker every 5 seconds


}