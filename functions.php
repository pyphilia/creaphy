<?php 

function displayGridImages(array $images) {
	foreach($images as $img) {
		echo '<img class="gridImg" src="'.$img.'"/>';
		break;
	}
	
}


?>