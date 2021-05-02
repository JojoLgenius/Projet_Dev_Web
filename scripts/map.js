let map;

function initMap() {
  const endroit = { lat: 45.452132, lng: 4.386869};
  map = new google.maps.Map(document.getElementById("map"), {
    center: endroit,
    zoom: 16,
  });

  const marker = new google.maps.Marker({
    position: endroit,
    map: map,
  });
}