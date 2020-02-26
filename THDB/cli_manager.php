<?php

require_once("functions.php");


if (isset($argv[1])) {
  $params = array();
  $i = 2;
  while (isset($argv[$i])){
    $strSplit = explode("=", $argv[$i]);
    $params[$strSplit[0]] = $strSplit[1];
    $i++;
  }
  display_movie_data($argv[1], $params);
}



?>
