async function initMap() {
  // The location of MSU
  const position = { lat: 40.86602158915414, lng: -74.19746694242397 };
  // Request needed libraries.
  //@ts-ignore
  const { Map } = await google.maps.importLibrary("maps");

  // The map, centered at the position and zoomed in
  map = new Map(document.getElementById("map"), {
    zoom: 15,
    center: position,
    mapId: "DEMO_MAP_ID",
  });
}