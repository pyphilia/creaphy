<?php 

require("Db.php");
$db = new Db($dbhost, $dbuser, $dbpw, $dbname); 

require("Imgur.php");
$imgur = new Imgur($imgur_client_id);




// get category from get
$currentCategory = (isset($_GET["category"]) && isCategory($_GET["category"])) 
? isCategory(htmlspecialchars($_GET["category"])) 
: $CATEGORIES["Avatars"];

$tags = array();
if(isset($_GET['search'])) {
	$tags = $_GET['search'];
}


?>

<section id="gallery">

	<?php 
	echo '<h2 id="graph_title">';
	echo $currentCategory["name"] . " : ";
	$size = count($tags);
	foreach ($tags as $value) {
		echo $value;
		if ($tags[$size-1] != $value) {
			echo ", ";
		}
	}
	echo '</h2>';
	?>

	<div class="list">

		<?php 
			// use the cookie to get the search information

		printCreationsByCategoriesAndTag($tags, $db, $imgur);

		?>


	</div>
	<select class="gallery" multiple="true">

		<?php 

		echo getAllNames($db, $imgur);

		?>

	</select>

	<input class="gallery_send" value="Valider" type="submit"/>
	<p style="font-style:italic;">Buggy? Reload!</p>



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

			$search = "";
			$selected.each(function(){
				$search += "search[]=" + ($(this).html()) + "&";
			});

			window.location.href = "graphism.php?category=" + <?php printCurrentCategory(); ?> + "&" + $search;

		});

	});

</script>


<?php 

// get images from get values 
function printCreationsByCategoriesAndTag($search, $db, $imgur) {

	global $currentCategory;

	// if there is sth
	/*DB*/ 
	$cond = NULL;
	$limit = 45;
	$images;

	// category process
	if($currentCategory){

		$cat_id = $currentCategory["id"];
		$cat_imgur_id = $currentCategory["imgur_album_id"];
		$conditions = array("categories_id" => array($cat_id));
		$imgur_content;

		// search process
		if(isset($search) && $search != "" && count($search)){
			array_walk($search, "htmlspecialchars");
			if(isCelebrityDepending($cat_id)) {
				$conditions["celebrities.name"] = $search;
			}
			else {
				$conditions["creations.title"] = $search;
			}

			/* IMGUR */
			$imgur_content = $imgur->getImagesFromAlbumWithTags($cat_imgur_id, $search);
		}
		else {
			/* IMGUR */
			$imgur_content = array_slice($imgur->getImagesFromAlbum($cat_imgur_id)["data"], 0, 45);
		}

		/*DB*/
		$limit = (isCelebrityDepending($cat_id) && (!isset($conditions["celebrities.name"]))) ? 45 - count($imgur_content) : NULL;

		$db_images = array();
		if(!isset($limit) || $limit > 0) {
			$db_creations = $db->leftJoin("creations", "celebrities", array("celebrities_id" => "id"), array("creations.url"), $conditions, "last_modified DESC", $limit)->fetchAll();
			$db_images = array_column($db_creations, "url");
			/*var_dump($db_creations);*/
		}

		/*IMGUR*/
		$imgur_images = array_reverse(array_column($imgur_content, "link")); // reverse to have most recent one first

		/*all images*/ 
		$images = array_merge($imgur_images, $db_images);
	}
	else {
		var_dump("ERROR");
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

	global $currentCategory;

	$cat_id = $currentCategory["id"];
	$cat_imgur_id = $currentCategory["imgur_album_id"];
	$db_creations;

	if(isCelebrityDepending($cat_id)) {

		$db_creations = array_column($db->leftJoin("creations", "celebrities", array("celebrities_id" => "id"), array("celebrities.name"), array("categories_id" => array($cat_id)), "last_modified DESC")->fetchAll(),"name");
		/*$db_creations = array_column($db->select("celebrities", array("name"))->fetchAll(),"name");*/
	}
	else {
		$db_creations = array_column($db->select("creations", array("distinct title"), 
			array("title" => array("IS NOT NULL"), "categories_id" => array($cat_id))
			)->fetchAll(),"title");
	}
	//$db_celebrities = array_column($db->select("celebrities", array("name"))->fetchAll(), "name");

	// get imgur names
	$imgur_content = $imgur->getImagesFromAlbum($cat_imgur_id);
	$imgur_names = array_column($imgur_content["data"], "description");

	/*var_dump($db_creations);*/

	// mix all together and keep unique ones
	//$allNames = array_merge($db_celebrities, array_merge($db_creations, $imgur_names));
	$allNames = array_merge($db_creations, $imgur_names);
	$names = array_unique($allNames);
	natcasesort($names);
	array_shift($names);


	$html = "";
	foreach ($names as $name) {
		$html .= '<option>' . $name . '</option>';
	}

	return $html;
}

function printCurrentCategory(){

	global $currentCategory;
	echo "'" . $currentCategory["name"] . "'"; 

}

?>