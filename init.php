<?php

session_start();

require_once("vars.php");

require_once($_SESSION["classesLocation"]."day.php");
require_once($_SESSION["classesLocation"]."week.php");
require_once($_SESSION["classesLocation"]."source.php");
require_once($_SESSION["classesLocation"]."podcast.php");
require_once($_SESSION["utilsLocation"]."utils.php");


if (!check_files()) {
  exit("Critical Error");
}

if (isset($_POST['loadArray'])) {
  if (!load_array($_POST['loadArray'])) {
    exit("Array Load Failure");
  }
}

require_once($_SESSION["saveLocation"]."feeds.php");

if (isset($_GET["start"])) {
  $_SESSION["start"] = $_GET["start"];
}
if (isset($_GET["stop"])) {
  $_SESSION["stop"] = $_GET["stop"];
}

function check_files() {
  $savingFile = $_SESSION['saveLocation']."feeds.php";
  $savingdirectory = substr($_SESSION['saveLocation'], 0, -1);
  if (!file_exists($savingdirectory)) {
    if (!mkdir($savingdirectory, 0700)) {
      display_err_msg("This error occured before CSS got loaded</br>It seems like this script does not have the right to write in the directory RSS</br>Make sure to grant write access and reload the page</br></br>");
      return false;
    }
  }
  if (!file_exists($savingFile) ) {
    if (!touch($savingFile, 0700)) {
      display_err_msg("This error occured before CSS got loaded</br>It seems like this script does not have the right to write in the directory SAVE</br>Make sure to give write access and reload the page</br></br>");
      return false;
    }
  }
  if (file_get_contents($_SESSION["saveLocation"]."feeds.php") === false) {
    display_err_msg("This error occured before CSS got loaded</br>It seems like this script does not have the right to read the file FEEDS.PHP</br>Make sure to give read access and reload the page</br>Otherwise remove the Save/feeds.php (if you have no save to load) file and directory and reload the page (with write access in RSS)</br></br>");
    return false;
  }
  if (strlen(file_get_contents($_SESSION["saveLocation"]."feeds.php")) <= 0) {
    if (file_put_contents($_SESSION["saveLocation"]."feeds.php", '<?php $_SESSION["rss"] = array() ?>') === false) {
      display_err_msg("This error occured before CSS got loaded</br>It seems like this script does not have the right to write in the file FEEDS.PHP</br>Make sure to give write access and reload the page</br>Otherwise remove the Save/feeds.php (if you have no save to load) file and directory and reload the page (with write access in RSS)</br></br>");
      return false;
    }
  }
  return true;
}

function load_array($array) {
  if (file_put_contents($_SESSION["saveLocation"]."feeds.php", '<?php $_SESSION["rss"] = array('.$array.'); ?>') === false) {
    display_err_msg("This error occured before CSS got loaded</br>It seems like this script does not have the right to write in the file FEEDS.PHP</br>Make sure to give write access and reload the page</br>Otherwise remove the Save/feeds.php (if you have no save to load) file and directory and reload the page (with write access in RSS)</br></br>");
    return false;
  }
  return true;
}

?>
