function processForm(){
  console.log("A");
  const form = document.getElementById('submissionform');

  // form.addEventListener("submit", e => {
      // e.preventDefault();
      let reqBody = {};
      Object.keys(form.elements).forEach(key => {
          let element = form.elements[key];
          if (element.type !== "submit") {
              reqBody[element.name] = element.value;
          }
      });
      let email =
      "DO NOT CHANGE ANYTHING IN THIS EMAIL\n==========\n\n" +
      "{\n  time : " + (Math.floor(Date.now() / 1000)).toString() +
      ",\n  lat : " + reqBody["latitude"] +
      ",\n  long : " + reqBody["longitude"] +
      ",\n  score : " + reqBody["score"] +
      ",\n  speed : " + reqBody["speed"] +
      ",\n  smoothness : " + reqBody["smoothness"] +
      ",\n  type : \"" + reqBody["type"] + "\"" +
      ",\n  country : \"" + reqBody["country"] + "\"" +
      ",\n  city : \"" + reqBody["city"] + "\"" +
      ",\n  comment : \"" + reqBody["comment"] + "\"" +
      "\n}\n\n==========\nEND OF EMAIL\n";
      let hashGenerated = email.hashCode();
      email += hashGenerated;
      submitForm(email, reqBody["latitude"], reqBody["longitude"], reqBody["city"], reqBody["country"]); // Call to function for form submission
  
}
function submitForm(info, lat, long, city, country){
  try {
    // console.log("Sending icon click to GA4.");
    gtag("event", "submission", {
      latitude: lat,
      longitude: long,
      email: info
    });
  } catch (e) {
    console.log(
      "Something wrong happened when setting up event handling for the icon click."
    );
  }
    sendMail(info, lat, long, city, country);
}

function sendMail(info, lat, long, city, country){
    var yourMessage = info;
    var subject = city +","+ country + " Submission";
    window.open("mailto:submissions.escalatorreviews@gmail.com?subject="
        + encodeURIComponent(subject)
        + "&body=" + encodeURIComponent(yourMessage), '_blank');
        window.location = "thank_you.html";
}

String.prototype.hashCode = function() {
    // https://stackoverflow.com/questions/7616461/generate-a-hash-from-string-in-javascript
    var hash = 0,
      i, chr;
    if (this.length === 0) return hash;
    for (i = 0; i < this.length; i++) {
      chr = this.charCodeAt(i);
      hash = ((hash << 5) - hash) + chr;
      hash |= 0; // Convert to 32bit integer
    }
    return hash;
}

function getLatLong(){
  // Get url params if there are any
  let params = new URLSearchParams(location.search);
  let lat = params.get('lat');
  if (lat != undefined){
    document.getElementById("form_lat").value = lat;
  }
  let long = params.get('long');
  if (lat != undefined){
    document.getElementById("form_long").value = long;
  }
};