<?php 

require("token.php");

require("Db.php");
$db = new Db($dbhost, $dbuser, $dbpw, $dbname); 

require("Imgur.php");
$imgur = new Imgur($imgur_client_id);

require("functions.php");

?>

<section id="gallery">
	<div class="list">

		<?php 
			// use the cookie to get the search information
		$search = '';
		if(isset($_GET['search'])) {
			$search = $_GET['search'];
		}

		printFromName($search, $db, $imgur);

		?>


	</div>
	<select class="gallery" multiple="true">

		<?php 

		echo getAllNames($db, $imgur);

		?>

	</select>

	<input class="gallery_send" value="Valider" type="submit"/>
	<p style="font-style:italic;">Si cela ne s'affiche pas bien, recharger la page !</p>



</section>

<!-- LIGHT GALLERY -->
<script type="text/javascript">
	
	lightGallery(document.getElementById('gallery_lightbox'));


</script>

<script type="text/javascript">
	$(document).ready(function(){

		/*GALLERY*/
		$(".gallery").chosen({
			search_contains : true,
		});


		// display the image
		$('.list img').click(function(){
			$html = '<strong>' + $(this).data('name') + '</strong>' + '<img src="'+ $(this).attr('src') +'"><input onClick="this.select();" value="' + $(this).attr('src') + '"/>';
			$("#gallery .display").html($html);
			$('section#gallery').animate({ scrollTop: 1500}, 'normal');
		});


		// When search is clicked
		$('.gallery_send').click(function(){

			$selected = $('.chosen-container').find('.search-choice span');

			$search = "?";
			$selected.each(function(){
				$search += "search[]=" + ($(this).html()) + "&";
			});

			window.location.href = "graphism.php" + $search;

		});

	});

</script>


<?php 

// get images from get values 
function printFromName($search, $db, $imgur) {

	// if there is sth
	/*DB*/ 
	$cond = NULL;
	$limit = 45;
	$images;

			// category process
	if($category = isCategory($search[0])){
		$cat_id = $category["id"];
		$cat_imgur_id = $category["imgur_album_id"];

		$db_images = $db->select("creations", array("url"), array("categories_id" => array($cat_id)), "last_modified DESC")->fetchAll();
		$images = array_column($db_images, "url");

	}

	else if(isset($search) && $search != ""){ 

		// create the conditions
		$names = array();
		foreach ($search as $key => $value) {


			$search = htmlspecialchars($value);
			/*$search = preg_replace('/%C3%A9/', 'é', $search);
			$search = preg_replace('/%E2%98%85/', '★', $search);*/
			/*$search = preg_split("/[,]+/", $search);*/
			array_push($names, $search);
		}

		/*$names = (count($names) == 1) ? $names[0] : $names; */
		$cond = array("celebrities.name" => $names);
		/*var_dump($cond);*/


		$db_creations = $db->leftJoin("creations", "celebrities", ["celebrities_id" => "id"], array("creations.url"), $cond, "last_modified DESC", $limit)->fetchAll();
		$db_images = array_column($db_creations, "url");

		/*IMGUR*/
		$imgur_content = $imgur->getImagesFromAlbumWithTags("R3nHG", $names);
		$imgur_images = array_reverse(array_column($imgur_content, "link")); // reverse to have most recent one first

		$images = array_merge($imgur_images, $db_images);

	}
	else {

		$db_images = $db->leftJoin("creations", "celebrities", ["celebrities_id" => "id"], array("creations.url"), $cond, "last_modified DESC", $limit)->fetchAll();
		$images = array_column($db_images, "url");
	}
	// echo
	$string = '';
	echo '<div id="gallery_lightbox">';
	foreach($images as $crea) {
		echo '<a href="' .  $crea .  '"><img src="' .  $crea .  '"/></a>';
	}
	echo '</div>';
}

?>


<?php 

function getAllNames($db, $imgur){

	$db_creations = array_column($db->select("creations", array("distinct title"), array("title" => "IS NOT NULL"))->fetchAll(),"title");
	$db_celebrities = array_column($db->select("celebrities", array("name"))->fetchAll(), "name");

	// get imgur names
	$imgur_content = $imgur->getImagesFromAlbum("R3nHG");
	$imgur_names = array_column($imgur_content["data"], "description");

	// mix all together and keep unique ones
	global $CATEGORIES;
	$categories = array_keys($CATEGORIES);
	$allNames = array_merge($db_celebrities, array_merge($db_creations, array_merge($imgur_names, $categories)));
	$names = array_unique($allNames);
	natcasesort($names);
	array_shift($names);

	$html = "";
	foreach ($names as $name) {
		$html .= '<option>' . $name . '</option>';
	}

	return $html;
}


?>