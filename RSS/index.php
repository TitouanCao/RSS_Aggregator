<?php
session_start();

require_once("vars.php");

require_once($_SESSION["classesLocation"]."day.php");
require_once($_SESSION["classesLocation"]."week.php");
require_once($_SESSION["classesLocation"]."source.php");
require_once($_SESSION["classesLocation"]."podcast.php");

require_once($_SESSION["saveLocation"]."feeds.php");

require_once($_SESSION["utilsLocation"]."utils.php");

if (isset($_GET["start"])) {
  $start = $_GET["start"];
}
else $start = 0;

if (isset($_GET["stop"])) {
  $stop = $_GET["stop"];
}
else $stop = 5;

if(isset($_POST["name"]) && isset($_POST["src"]) && isset($_POST["color"]) && isset($_POST["twitter"])) {
  $eval = evaluate_feed($_POST["name"], $_POST["src"], $_POST["color"], $_POST["twitter"]);
}

if (!isset($_GET["mode"])){
  $_GET["mode"] = "row";
}

//podcast.mp3: Audio file with ID3 version 2.3.0, contains:MPEG ADTS, layer III, v1, 128 kbps, 44.1 kHz, Stereo
?>



<html>
<head>
  <title>Podcast Aggregator</title>
  <meta charset="utf-8">
  <link rel="icon" href="<?php echo $_SESSION['resourcesLocation'] ?>favico.png" />
  <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>
<body>
  <div id='compact-container'>
    <div class='scroller'>
      <?php display_compact($_SESSION["rss"]); ?>
    </div>
  </div>
  <div id='row-container'>
    <div class='scroller'>
      <?php display_row($_SESSION["rss"]); ?>
    </div>
  </div>
  <div id="switcher">
    <div id="switcher-text" onclick="switch_mode()">
      <span id="switcher-text-p">SWITCH DISPLAY</span>
    </div>
    <div id="to-top" onclick="top_function()">
      <img id="to-top-arrow" src="<?php echo $_SESSION['resourcesLocation']; ?>top-arrow.png" alt="top arrow icon">
    </div>
  </div>
  <div id="herald">
    <div id="herald-core">
      <div id="herald-name">Feeds</div>
      <?php display_feeds(); ?>
    </div>
    <div id="herald-horn">
      <img id="herald-arrow" src="<?php echo $_SESSION['resourcesLocation']; ?>right-arrow.png" alt="right arrow icon">
    </div>
  </div>
  <div id="picker">
    <img id="picker-arrow" src="<?php echo $_SESSION['resourcesLocation']; ?>bottom-right-arrow.png" alt="bottom right arrow icon">
    <form action="" method="get" class="picker-form">
      <input type="text" name="start" value=<?php echo $start ?> class="picker-input">
      <input type="text" name="stop" value=<?php echo $stop ?> class="picker-input">
      <input type="submit" value="reload">
    </form>
  </div>
  <div id="adder">
    <img id="adder-arrow" src="<?php echo $_SESSION['resourcesLocation']; ?>top-right-arrow.png" alt="top right arrow icon">
    <form action="" method="post" class="adder-form">
      <input type="text" name="name" placeholder="name" class="adder-input">
      <input type="text" name="src" placeholder="url" class="adder-input">
      <input type="text" name="twitter" placeholder="twitter" class="adder-input">
      <input type="text" name="color" placeholder="color" class="adder-input">
      <input type="submit" value="Create/Delete/Modify">
    </form>
  </div>
</body>
</html>

<script>
  var resourcesLocation = '<?php echo $_SESSION['resourcesLocation'];?>'
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
<script type="text/javascript" src="<?php echo $_SESSION['utilsLocation'];?>utils.js"></script>
