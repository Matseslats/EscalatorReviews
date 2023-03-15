function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.watchPosition(showPosition);
  } else {
    document.getElementById("position").innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
    document.getElementById("position").innerHTML = "Latitude: " + Number((position.coords.latitude).toFixed(6)) +
    "<br>Longitude: " + Number((position.coords.longitude).toFixed(6));
}

function setLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.watchPosition(setPosition);
  } else {
    alert('Geolocation is not supported by this browser.');
  }
}

function setPosition(position) {
  document.getElementById("lat").value = Number((position.coords.latitude).toFixed(6));
  document.getElementById("long").value = Number((position.coords.longitude).toFixed(6));

}
