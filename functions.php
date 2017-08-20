<?php 

function displayGridImages(array $images) {
	foreach($images as $img) {
		echo '<img class="gridImg" src="'.$img.'"/>';
		break;
	}
	
}

function isCategory($s){
	$s = htmlspecialchars($s);
	global $CATEGORIES;
	$cat_names = array_keys($CATEGORIES);
	if(array_key_exists($s, $CATEGORIES)){
		return $CATEGORIES[$s];
	}
	else false;
}


function isCelebrityDepending($id){
	return ($id == 15 || $id == 16 || $id == 17 || $id == 18);
}

function printSublinks(){
	global $CATEGORIES;
	foreach ($CATEGORIES as $key => $value) {
		echo '<a href="graphism.php?category=' . $key . '"><span>' . $key . '</span></a>';
	}
}
?>