<?php 

include('../bd.php');

if(isset($_POST)){

	$currentUrl = '';
	$currentName = '';
	$toDelete = false;
	$exist = false;

	var_dump($_POST);

	foreach ($_POST as $k => $v) {

		if(preg_match('/delete/', $k)){
			$toDelete = true;
		}

		// NOM REQUEST
		else if(preg_match('/name/', $k)){
			$currentName = $v;
		}

		// URL
		else if(preg_match('/url/', $k)){

			if(!$toDelete){
				$d = $con->query("SELECT id FROM creations WHERE url='".$v."'")->fetch();
				$currentUrl = $v;
				$exist = isset($d['id']) ? $d['id'] : false;
			}
		}

		else if(preg_match('/category/', $k)){
			if(!$toDelete){

		// check if there is edit, if not do nothing, otherwise update 
				if(!$exist){
					var_dump('new');
					$query = "INSERT INTO creations(url, categories_id, last_modified, title) VALUES('".$currentUrl."','".$v."','".date('Y-m-d H:i:s')."','".$currentName."')";
					$con->query($query);
				}

				else {
					var_dump('exist');
					$r = 'UPDATE creations SET categories_id = "'.$v.'", title="'.$currentName.'" WHERE id="'.$exist.'"';
					$con->query($r);
				}
			}
			else {
				echo 'not added';
			}
			$toDelete = false;
		}
		
	}


}

?>