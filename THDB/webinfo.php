<?php
require_once("tp3-helpers.php");
?>
<html>
	<body>
		<p>
			<?php
			if(isset($_GET['language'])){
				$array["language"] = $_GET['language'];
			}
			else $array = array('language' => 'en');
			if(isset($_GET['movie'])) $content = json_decode(tmdbget("movie/".$_GET['movie'], $array), true);
			else $content = json_decode(tmdbget("movie/550", $array), true);
			foreach($content as $key => $value){
				if($key == "title") {
					echo "<strong>Title</strong> : ".$value."</br>";
					$value = strtolower($value);
					if(isset($_GET['movie'])) $email = "https://www.themoviedb.org/movie/".$_GET['movie']."-"."$value";
					else $email = "https://www.themoviedb.org/movie/"."550"."-"."$value";
					$email = str_replace(" ", "-", $email);
				}
				if($key == "original_title") echo "<strong>Original_Title</strong> : ".$value."</br>";
				if($key == "tagline") echo "<strong>Tagline</strong> : ".$value."</br>";
				if($key == "overview") echo "<strong>Overview</strong> : ".$value."</br>";
				if($key == "homepage") echo "<strong>Homepage</strong> : <a href=$value>$value</a></br>";
			}
			echo "<strong>Lien</strong> : <a href=$email>$email</a></br>";
			?>
		</p>
	</body>
</html>
