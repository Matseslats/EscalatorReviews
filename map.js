var map = L.map('mapid').setView([51.505, -0.09], 5); //Set view position of the map

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

var LeafIcon = L.Icon.extend({
	options: {
  	shadowUrl: 'images/shadow.png',

  	iconSize:     [40, 45], // size of the icon
  	shadowSize:   [42, 44], // size of the shadow
  	iconAnchor:   [17, 45], // point of the icon which will correspond to marker's location
  	shadowAnchor: [14, 46],  // the same for the shadow
  	popupAnchor:  [4, -45] // point from which the popup should open relative to the iconAnchor
  }
});

var escalatorIcon = new LeafIcon({iconUrl: 'images/escalatorPin.png'}),
	autowalkIcon = new LeafIcon({iconUrl: 'images/autowalkPin.png'});

for (var i in data) {
  var type = data[i].type;
  type = (type.charAt(0).toUpperCase() + type.slice(1));
  var latlng = L.latLng({ lat: data[i].lat, lng: data[i].long });
  var info = "<b> " +  data[i].score + "/10 " + type + "</b><br>" + data[i].city +
    "<br>" + data[i].comment;

  if(data[i].type == "escalator"){
    L.marker( latlng, {icon: escalatorIcon}).addTo(map).bindPopup(info).on('click', onClick);
  } else {
    L.marker( latlng, {icon: autowalkIcon}).addTo(map).bindPopup(info).on('click', onClick);
  }
}

function onClick(e) {
  let infoStr = this.getLatLng().lat + ":" + this.getLatLng().lng;
  let url = "index.html";

  if (typeof gtag === 'undefined') return;
  try {
      // console.log("Sending icon click to GA4.");
      gtag("event", "IconClick", {
        icon_coords: infoStr,
        page_origin: url,
      });
  } catch (e) {
    console.log(
      "Something wrong happened when setting up event handling for the icon click."
    );
  }
}

const popup = L.popup();

function onMapClick(e) {
  popup
    .setLatLng(e.latlng)
    .setContent(`<a href="submit.html?lat=${e.latlng.lat}&long=${e.latlng.lng}">Submit an escalator here</a>`)
    .openOn(map);
}

map.on('click', onMapClick);