<?php

session_start();

require_once("vars.php");

require_once($_SESSION["classesLocation"]."day.php");
require_once($_SESSION["classesLocation"]."week.php");
require_once($_SESSION["classesLocation"]."source.php");
require_once($_SESSION["classesLocation"]."podcast.php");

$savingFile = $_SESSION['saveLocation']."feeds.php";
$savingFolder = substr($_SESSION['saveLocation'], 0, -1);
if (!file_exists($savingFolder)) {
  mkdir($savingFolder, 0700);
}
 if (!file_exists($savingFile) ) {
  touch($savingFile, 0700);
  file_put_contents($_SESSION["saveLocation"]."feeds.php", '<?php $_SESSION["rss"] = array() ?>');
 }

require_once($_SESSION["saveLocation"]."feeds.php");
require_once($_SESSION["utilsLocation"]."utils.php");


if (isset($_GET["start"])) {
  $_SESSION["start"] = $_GET["start"];
}
if (isset($_GET["stop"])) {
  $_SESSION["stop"] = $_GET["stop"];
}




?>
