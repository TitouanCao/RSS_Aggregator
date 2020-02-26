<?php
session_start();

require_once("vars.php");

require_once($_SESSION["classesLocation"]."day.php");
require_once($_SESSION["classesLocation"]."week.php");
require_once($_SESSION["classesLocation"]."source.php");
require_once($_SESSION["classesLocation"]."podcast.php");

require_once($_SESSION["saveLocation"]."feeds.php");

require_once("utils.php");

if (isset($_GET["start"])) {
  $start = $_GET["start"];
}
else $start = 0;

if (isset($_GET["stop"])) {
  $stop = $_GET["stop"];
}
else $stop = 5;

if(isset($_POST["name"]) && isset($_POST["src"]) && isset($_POST["color"])) {
  $eval = evaluate_feed($_POST["name"], $_POST["src"], $_POST["color"]);
}

if (!isset($_GET["mode"])){
  $_GET["mode"] = "row";
}

//podcast.mp3: Audio file with ID3 version 2.3.0, contains:MPEG ADTS, layer III, v1, 128 kbps, 44.1 kHz, Stereo
?>



<html>
<head>
  <title>Podcast Agregator</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div id="compact-container">
    <div class="scroller">
      <?php display_compact($_SESSION["rss"]); ?>
    </div>
  </div>
  <div id="row-container">
    <div class="scroller">
      <?php display_row($_SESSION["rss"]); ?>
    </div>
  </div>
  <div id="switcher" onclick="switch_mode()">
    SWITCH MODE
  </div>
  <div id="herald">
    <div id="herald-core">
      <div id="herald-name">Feeds</div>
      <?php display_feeds(); ?>
    </div>
    <div id="herald-horn">
    </div>
  </div>
  <div id="picker">
    <form action="" method="get" class="picker-form">
      <input type="text" name="start" value=<?php echo $start ?> class="picker-input">
      <input type="text" name="stop" value=<?php echo $stop ?> class="picker-input">
      <input type="submit" value="reload">
    </form>
  </div>
  <div id="adder">
    <form action="" method="post" class="adder-form">
      <input type="text" name="name" placeholder="name" class="adder-input">
      <input type="text" name="src" placeholder="url" class="adder-input">
      <input type="text" name="color" placeholder="color" class="adder-input">
      <input type="submit" value="Create/Delete/Modify">
    </form>
  </div>
</body>
</html>

<script>
  var resourcesLocation = "resources/"
</script>
<script type="text/javascript" src="utils.js"></script>
