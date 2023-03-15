<?php

// error_reporting(-1);
// ini_set('display_errors', 'On');
// set_error_handler("var_dump");
mail("contact@escalatorreviews.com","My subject","My message","From: contact@escalatorreviews.com");
if(isset($_POST['submit'])){
    $to = "contact@escalatorreviews.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $country = $_POST['country'];
    $city = $_POST['city'];
    $long = $_POST["longitude"];
    $lat = $_POST["latitude"];
    $address = $_POST["address"];
    $type = $_POST["type"];
    $inclination = $_POST["inclination"];
    $score = $_POST["score"];
    $comment = $_POST["comment"];

    $message = "Test"// $from . " wrote the following:" . "\n\n" . $_POST['country'];
    //Outgoing mail not configured //$message2 = "Here is a copy of your message " . $from . "\n\n" . $_POST['country'];
    $subject = "New submission";
    $subject2 = "EscalatorReviews.com submission";

    $headers = "Reply-to: " . $from;
    $headers2 = "Reply-to: " . $to;
    mail($to,$subject,$message,$headers);
    // mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    //echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
    //header('thank_you.php'); //to redirect to another page.
    // You cannot use header and echo together. It's one or the other.

    //$file = fopen('configurationSettings.txt', 'w+'); //Open your .txt file
    //ftruncate($file, 0); //Clear the file to 0bit
    // $content = $score. PHP_EOL .$long. PHP_EOL .$lat;
    // fwrite($file , $content); //Now lets write it in there
    // fclose($file ); //Finally close our .txt
    //die(header("Location: ".$_SERVER["HTTP_REFERER"]));
    //header("index.html")
    }
?>
<html>
<head>
  <link rel="stylesheet" href="style.css">
  <title>Thank you!</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="images/escalatorBlack.png">
</head>
<body>
  <h1><img src="images/escalator.png" alt="icon" style="width:100px;height:100px;"></h1> <!--Logo on top of the screen-->
  <div class="topnav" id="myTopnav"><!--Menu-->
     <a href="index.html">Home</a>
     <a href="about.html">About</a>
     <a href="submit.php">Submit</a>
     <a href="search.html" class="right">Search</a>
     <a href="javascript:void(0);" class="icon" onclick="loadMenu()">
       <i class="fa fa-bars"></i>
     </a>
  </div>
  <div class="thankyou"><p>Thank you for your submission!</p>
    <p>Although I havent programmed this path yet...<br>
       Please try again later</p>
  <!--<p>Your submission is highly appreciated, and it will be added to the list as soon as possible!</p></div>-->
  <img src="images/LoopEsc.gif" alt="Gif">
</body>
</html>
