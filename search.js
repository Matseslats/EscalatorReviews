function myFunction() {
  var x = document.getElementById("search").value;
  var matches = 0;
  var block = "";

  for (var i in data) { //Check all data elements
      if(inJSON(x, data[i])){ //Check if any escalators match the search
        matches += 1; //Add 1 to the number of results per result
        var country = data[i].country;
        var city = data[i].city;
        var type = data[i].type;
        var score = data[i].score;
        var speed = data[i].speed;
        var smooth = data[i].smoothness;
        if (type=="autowalk"){
          var icon = "images/autowalk.svg";
        } else {
          var icon = "images/escalator.svg";
        }
        type = (type.charAt(0).toUpperCase() + type.slice(1));
        // var comment = data[i].comment;
        block += '<div class="res">'+ //Apply classes to text and format it correctly
        '<div class="icon"><img src="' + icon + '" alt="Escalator icon" style="width:90px;"></div>' +
        '<div class="place">'+ country +'<br>' +
        city +'<br>' +
        type +'<br></div>' +
        '<div class="info">'+'Score: ' + score +'<br>' +
        'Speed: ' + speed +'<br>' +
        'Smoothness: ' + smooth +'</div>' +
        '</div>';
        document.getElementById("block").innerHTML = block;

      }
    }
    if(x == "" || block == ""){
      document.getElementById("block").innerHTML = block;
    }
    document.getElementById("results").innerHTML = "Results: " + matches; //Make number of matches a string and send to html

}

function inJSON(string, json){
  let inCountry = inStr(string, json.country);
  let inCity = inStr(string, json.city);
  return inCountry || inCity;
}

function inStr(strA, strB){
  strA = strA.toLowerCase();
  strB = strB.toLowerCase();
  let inStr = false;
  for(let i = 0; i < (strB.length - strA.length +1); i++){
    // console.log(strB.substr(i,strA.length));
    inStr += strA == strB.substr(i,strA.length);
  }
  return inStr;
}