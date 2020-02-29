<?php

require_once("init.php");

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
  <?php
    if(isset($_POST["name"]) && isset($_POST["src"]) && isset($_POST["color"]) && isset($_POST["twitter"])) {
      check_files();
      $eval = evaluate_feed($_POST["name"], $_POST["src"], $_POST["color"], $_POST["twitter"]);
  } ?>
  <div id='compact-container'>
    <div class='scroller'>
      <?php display_compact($_SESSION["rss"], $_SESSION["start"], $_SESSION["stop"]); ?>
    </div>
  </div>
  <div id='row-container'>
    <div class='scroller'>
      <?php display_row($_SESSION["rss"], $_SESSION["start"], $_SESSION["stop"]); ?>
    </div>
  </div>
  <div id="switcher">
    <div id="switcher-text" onclick="switch_mode()">
      <span id="switcher-text-p" onmousedown="return false;">SWITCH DISPLAY</span>
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
      <input type="text" name="start" value=<?php echo $_SESSION["start"]; ?> class="picker-input my_inputs" autocomplete="off">
      <input type="text" name="stop" value=<?php echo $_SESSION["stop"]; ?> class="picker-input my_inputs" autocomplete="off">
      <input type="submit" value="RELOAD" class="my_buttons">
    </form>
  </div>
  <div id="adder">
    <img id="adder-arrow" src="<?php echo $_SESSION['resourcesLocation']; ?>top-right-arrow.png" alt="top right arrow icon">
    <form action="" method="post" class="adder-form">
      <input type="text" name="name" placeholder="Name" class="adder-input my_inputs" autocomplete="off">
      <input type="text" name="src" placeholder="URL" class="adder-input my_inputs" autocomplete="off">
      <input type="text" name="twitter" placeholder="Twitter link" class="adder-input my_inputs" autocomplete="off">
      <input type="text" name="color" placeholder="Display Color" class="adder-input my_inputs" autocomplete="off">
      <input type="submit" value="SEND" class="my_buttons">
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
