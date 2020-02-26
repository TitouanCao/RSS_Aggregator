<?php

require_once("functions.php");

  function show_data() {
    if (isset($_GET["id"])) {
      display_movie_data($_GET["id"]);
    }
  }

?>




<html>
  <head>
    <title>Get Movies Data</title>
  </head>
  <body>
    <?php show_data(); ?>
  </body>
</hmtl>
