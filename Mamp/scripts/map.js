/*  https://support.google.com/maps/answer/144361?co=GENIE.Platform%3DDesktop&hl=fr 
 tutoriel par google pour ajouter une carte google maps */ 
let map;

function initMap() {
  /* longitude et latitude de l'endroit ou l'on veut centrer la map */
  const endroit = { lat: 45.452132, lng: 4.386869};
  map = new google.maps.Map(document.getElementById("map"),
  {center:endroit,zoom: 16,});
  
  /* pointeur sur la carte de l'endroit exact */
  const marker = new google.maps.Marker({
    position: endroit,
    map: map,
  });
}