<?php
require_once("tp3-helpers.php");
			//<?php
			if(isset($argv[2])){
				$split = explode("=", $argv[2]);
				$array[$split[0]] = $split[1];
			}
			//if(isset($argv[2])) $array = array('language' => $argv[2]);
			else $array = array('language' => 'en');
			$content = json_decode(tmdbget("movie/550", $array), true);
			if(isset($argv[1])) $content = json_decode(tmdbget($argv[1], $array), true);
			foreach($content as $key => $value){
				if($key == "title") echo "Title : ".$value."</br>";
				if($key == "original_title") echo "Original_Title : ".$value."</br>";
				if($key == "tagline") echo "Tagline : ".$value."</br>";
				if($key == "overview") echo "Overview : ".$value."</br>";
				if($key == "homepage") echo "\nHomepage : ".$value."</br>";
			}
?>