<html>
<head>
  <link rel="stylesheet" href="style.css">
  <title>Submit | Escalator Reviews</title>
  <meta charset="UTF-8">
  <meta name="description" content="How smooth are your local escalators? Look it up or add it to the website">
  <meta name="keywords" content="Escalator,Auto-Walk,Reviews,Submit">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="images/escalatorBlack.png">

  <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <!-- NAVIGATION SCRIPT -->
 <script language="javascript" type="text/javascript" src="navBar.js"></script>
 <script language="javascript" type="text/javascript" src="coordinates.js"></script>
</head>

<body>
  <h1><img src="images/escalator.png" alt="icon" style="width:100px;height:100px;"></h1> <!--Logo on top of the screen-->
  <div class="topnav" id="myTopnav"><!--Menu-->
     <a href="index.html">Home</a>
     <a href="about.html">About</a>
     <a href="submit.php" class="active">Submit</a>
     <a href="search.html" class="right">Search</a>
     <a href="javascript:void(0);" class="icon" onclick="loadMenu()">
       <i class="fa fa-bars"></i>
     </a>
  </div>
  <!-- <div class="res" id="results"></div> -->
  <!-- <h2>Coming soon</h2> -->
  <div class="submit">
  <h2>How to submit</h2>
  <h3><p>To submit an escalator you have to fill in the form on the left/bottom. You only have to fill in the fields marked with an <span style="color: #4F7BFF;">*</span>.  Every single submission is grately apreciated
  </p>
  <p>Click <a href="youtube.com">here</a> to see how to measure it
  </p></h3>
  <button onclick="getLocation()" style="width:90%;">What are my coordinates?</button>

  <p id="position"></p>



  </div>
  <div class="form">
  <h2>Submit an escalator WARNING this does not work</h2>


      <form action="submit.php?savedata=1" method="post">
        <fieldset>
          <label for="email">E-mail<span style="color: #4F7BFF;">*</span></label><br>
          <input type="email" name="email" required><br>

          <label for="country">Country<span style="color: #4F7BFF;">*</span></label><br>
          <input type="text" name="country" required><br>
          <label for="city">City<span style="color: #4F7BFF;">*</span></label><br>
          <input type="text" name="city" required><br>

        <label for="coordinates">Coordinates</label><br>
        <input type="text" placeholder="Latitude" name="latitude" id="lat" style="width:49%;">
        <input type="text" placeholder="Longitude" name="longitude" id="long" style="width:49%;float:right;"><br>
        <input type="button" onclick="setLocation()" value="Use my coordinates" style=""></input><br>


        <label for="address">Address</label>
        <input type="text" name="address" placeholder="Fill out if you don't know the coordinates"><br>

        <label for="type">Type</label>
        <select name="type">
          <option value="escalator">Escalator</option>
          <option value="autowalk">Autowalk</option>
        </select><br>

        <label for="score">Overall score<span style="color: #4F7BFF;">*</span></label>
        <input type="number" name="score" min="1" max="10" placeholder="1 to 10" required><br>

        <label for="smoothness">Smoothness</label>
        <input type="number" name="smoothness" min="1" max="10" placeholder="1 to 10"><br>

        <label for="speed">Speed</label>
        <input type="number" name="speed" min="-5" max="5" placeholder="-5 to 5"><br>

        <p><span style="color: #4F7BFF;">*</span>Required</p>

        <input type="submit" name="submit" value="Submit">


        </fieldset>

      </form>

      </body>
</html>

<?php
echo "php";
$err = "Error: Please try again later";
$savedata = $_REQUEST['savedata'];
if ($savedata == 1){
  echo "sending";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get info
    if (empty($_POST["longitude"])) {
      $long = "-";
    } else {
      $long = $_POST["longitude"];
    }
    if (empty($_POST["latitude"])) {
      $lat = "-";
    } else {
      $lat = $_POST["latitude"];
    }
    if (empty($_POST["address"])) {
      $address = "-";
    } else {
      $address = $_POST["address"];
    }
    if (empty($_POST["smoothness"])) {
      $smoothness = "-";
    } else {
      $smoothness = $_POST["smoothness"];
    }
    if (empty($_POST["speed"])) {
      $speed = "-";
    } else {
      $speed = $_POST["speed"];
    }
    $mail = $_POST['email']; // this is the sender's Email address
    $country = $_POST['country'];
    $city = $_POST['city'];
    $type = $_POST["type"];
    $score = $_POST["score"];

    // Check if the right info is filled out
    if(($lat == $address) || ($long == $address)){
      echo "Please fill out either \"Address\" or \"Latitide\" & \"Longitude\"";
    } else {

      // Create JSON (really unoptimized)
      $data =
      "{\n  lat : $lat,\n" .
       "  long : $long,\n" .
       "  score : $score,\n" .
       "  speed : $speed,\n" .
       "  smoothness : $smoothness,\n" .
       "  type : $type,\n" .
       "  country : $country,\n" .
       "  city : $city,\n" .
       "  address : $address\n" .
      "},";
      // Replace unvalid email characters
      $file = $mail;
      $file = str_replace(".", "-", $file);
      $file = str_replace("@", "-", $file);

      $dir = "C:\\Users\\matsh\\Documents\\Test\\" . $file;

      // If folder $dir doesn't exist yet - create it
      // owner will be the user/group the PHP script is run under
      if ( !file_exists($dir) ) {
          mkdir ($dir, 0744, true) or die($err);
      }

      $file = $dir . "/" . $file . ".txt";

      // Create file if doesn't exist
      if ( !file_exists($file) ) {
          touch ($file, 0744) or die($err);
      }

      //Write to file or return errors
      $fp = fopen($file, "a") or die("Couldn't open $file for writing!");
      fwrite($fp, $data) or die("Couldn't write values to file!");

      fclose($fp);
      echo "Your Form has been Submitted!";
      header("Location: http://www.escalatorreviews.com/thank_you.html");
    }
  } else {
    echo "Error 001";
  }
} else {
  echo "Error 002";
}
?>
