<?php
require_once("tp3-helpers.php");
			if(isset($argv[1])){//Le deuxième argument est là pour signaler la langue qu'on veut utiliser pour le film : par exemple : language=fr ou language=en.
				$split = explode("=", $argv[1]);
				$array = array('language' => $split[1]);
			}
			else $array = array('language' => 'en');
			if(isset($argv[2])) {//Le troisième argument est là pour choisir le film : par exemple : 549. Par défaut on a mis le film numéro 550.
				$content = json_decode(tmdbget("movie/".$argv[2], $array), true);
			}
			else {
				$content = json_decode(tmdbget("movie/550", $array), true);
			}
			foreach($content as $key => $value){
				if($key == "title") echo "Title : ".$value."\n";
				if($key == "original_title") echo "Original_Title : ".$value."\n";
				if($key == "tagline") echo "Tagline : ".$value."\n";
				if($key == "overview") echo "Overview : ".$value."\n";
				if($key == "homepage") echo "\nHomepage : ".$value."\n";
			}
?>
