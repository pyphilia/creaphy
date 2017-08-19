<?php 

function displayGridImages(array $images) {
	foreach($images as $img) {
		echo '<img class="gridImg" src="'.$img.'"/>';
		break;
	}
	
}

function isCategory($s){
	global $CATEGORIES;
	$cat_names = array_keys($CATEGORIES);
	if(array_key_exists($s, $CATEGORIES)){
		return $CATEGORIES[$s];
	}
	else false;
}


?>