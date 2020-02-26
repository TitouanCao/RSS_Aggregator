<?php
require_once("tp3-helpers.php");


function display_movie_data($id, $params=null) {
  $requestResponse = tmdbget("movie/".$id, $params);
  $content = json_decode($requestResponse);
  echo "\nTitle : ".$content->title."\n";
  echo "Original title : ".$content->original_title."\n";
  if (isset($content->tagline)) echo "Tagline : ".$content->tagline."\n";
  echo "Overview : ".$content->overview."\n";
  echo "Link to homepage : ".$content->homepage."\n";
}



?>
