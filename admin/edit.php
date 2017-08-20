<?php 
require_once('../bd.php');

if(!isset($_POST)) {
	echo '<script>document.location = "' .SITE_URL. "/admin/code.php" . '";</script>';
}
else {
	$code = htmlspecialchars($_POST['code']);
	if($code != $CODE_REQUIRED) {
		echo '<script>document.location = "' .SITE_URL. "/admin/code.php" . '";</script>';
		
	}
}

/*if(!isLogged($con)){
	header('Location: login.php');
	die();
	echo '<script type="text/javascript">window.location = "http://creaphy.royalwebhosting.net/admin/login.php"</script>';

}*/

?>

<style type="text/css">
h4 {
	width:auto;
	margin:0;
}
</style>


<?php 

if(isset($_POST['celebrity'])){
	// delete celebrity + its img
	if(isset($_POST['deleteCeleb'])){
		$con->query("DELETE FROM celebrities WHERE id=" . $_POST['deleteCeleb']);
		$con->query("DELETE FROM creations WHERE celebrities_id=" .  $_POST['deleteCeleb']);
	}
	else {
		//update name in celebrity table
		$con->query('UPDATE celebrities SET name="'.$_POST['celebrity'].'" WHERE id="'.$_POST['celebrityId'].'"');
		
		$cImg = '';
		$cUrl = '';
		foreach ($_POST as $key => $value) {

			if(preg_match('/url_/', $key)){
				$cUrl = $value;
			}

			if(preg_match('/img_/', $key)){
				$cImg = $value;
			}

			if(preg_match('/cat_/', $key)){
				$con->query('UPDATE creations SET url="'.$cUrl.'",categories_id='. $value .' WHERE id="' . $cImg . '"');
			}

			//delete selected img
			if(preg_match('/deleteImg/', $key)){
				$con->query("DELETE FROM creations WHERE id=" . $value);
			}
		}
	}
}

if(isset($_POST['title'])){
	// delete celebrity + its img
	if(isset($_POST['delete'])){
		$con->query("DELETE FROM creations WHERE title='" .  $_POST['delete']."'");
	}
	else {
		// Update name for all 
		$con->query('UPDATE creations SET title="'. $_POST['title'] .'" WHERE title="'. $_POST['current'] .'"');
		

		$cImg = '';
		$cUrl = '';
		//delete selected img
		foreach ($_POST as $key => $value) {

			if(preg_match('/img_/', $key)){
				$cImg = $value;
			}

			if(preg_match('/url_/', $key)){
				$cUrl = $value;
			}

			if(preg_match('/cat_/', $key)){
				$con->query('UPDATE creations SET url="'.$cUrl.'",categories_id='. $value .' WHERE id=' . $cImg);
			}

			if(preg_match('/deleteImg/', $key)){
				$con->query("DELETE FROM creations WHERE id=" . $value);
			}
		}
	}
}

if(isset($_POST['tuto_name'])){
	if(isset($_POST['delete'])){
		$con->query("DELETE FROM tutorial WHERE id='" .  $_POST['tuto_name']."'");
	}
	else {
		$con->query('UPDATE tutorial SET name="'. $_POST['tuto_name'].'", example_url="'.$_POST['tuto_example'].'", description="'.htmlentities($_POST['tuto_desc']).'" WHERE id='. $_POST['id']);
	}
}

if(isset($_POST['wc_name'])){
	if(isset($_POST['delete'])){
		$con->query("DELETE FROM webdesign_code WHERE id='" .  $_POST['id']."'");
	}
	else {
		$con->query('UPDATE webdesign_code SET name="'. $_POST['wc_name'].'", preview="'.$_POST['preview'].'", description="'.htmlentities($_POST['tuto_desc']).'", url="'.$_POST['url'].'" WHERE id='. $_POST['id']);
	}
}

if(isset($_POST['h_name'])){
	if(isset($_POST['delete'])){
		$con->query("DELETE FROM history WHERE id='" .  $_POST['id']."'");
	}
	else {
		$con->query('UPDATE history SET name_title="'. $_POST['h_name'].'", categories_id="'.$_POST['categories_id'].'" WHERE id='. $_POST['id']);
	}
}

?>



<div style="font-size:12px; font-family:arial;width:60%;-webkit-column-count: 3; /* Chrome, Safari, Opera */
-moz-column-count: 3; /* Firefox */
column-count: 3;display:inline-block;vertical-align:top;">

<?php

$sql = $con->query("SELECT * FROM creations LEFT JOIN celebrities ON creations.celebrities_id = celebrities.id ORDER BY categories_id ASC, name ASC, title ASC");

$cCate = '';
$cName = '';
$cTitle = '';

foreach ($sql as $r) {
	// change of category
	if($cCate != $r['categories_id']){
		$id = (intval($cCate) != 0) ? intval($r['categories_id']) : 15;
		echo '<br/><br/><h4>'.$CATEGORIES[$id].'</h4>';
		$cCate = $r['categories_id'];
	}

	if(!empty($r['name']) and $cName != $r['name']){
		echo '<a href="?id='.$r['celebrities_id'].'&cat='.$cCate.'">' . $r['name'] . '</a><br/>';
		$cName = $r['name'];
	}
	else if(!empty($r['title']) and $cTitle != $r['title']){
		echo '<a href="?title='.$r['title'].'">'.$r['title'] . '</a><br/>';
		$cTitle = $r['title'];
	}
}

echo '<br/><br/>Tutos<br/>';
$sql = $con->query("SELECT * FROM tutorial ORDER BY name ASC");

foreach ($sql as $q) {
	echo '<a href="?tuto='. $q['id'].'">'.$q['name'].'</a><br/>';
}

echo '<br/><br/>Web, Codes<br/>';

$sql1 = $con->query("SELECT * FROM webdesign_code ORDER BY name ASC");

foreach ($sql1 as $q) {
	echo '<a href="?wc='. $q['id'].'">'.$q['name'].'</a><br/>';
}

echo '<br/><br/>History<br/>';

$sql2 = $con->query("SELECT * FROM history LIMIT 10");
foreach ($sql2 as $q) {
	echo '<a href="?history='. $q['id'] .'">'.$q['name_title'].'</a><br/>';
}

?>

</div>

<!--DISPLAY-->
<div style="width:39%;display:inline-block;vertical-align:top;">
	<form method="post" action="">
		<?php 

		if(!empty($_GET['id'])){
			$result = $con->query("SELECT * FROM creations LEFT JOIN celebrities ON creations.celebrities_id = celebrities.id WHERE celebrities_id=".$_GET['id']." AND categories_id=".$_GET['cat']." ORDER BY categories_id ASC, name ASC, title DESC LIMIT 20");
			$i=0;
			foreach ($result as $r) {
				if($i < 1) {
					echo '<input name="celebrityId" value="' . $r['celebrities_id'] . '" hidden/>';
					echo '<input name="celebrity" style="width:300px" value="' . $r['name'] . '"/>';
					echo '<input name="deleteCeleb" value="'. $r['celebrities_id'] .'" type="checkbox"/> Delete Celebrity<br/>';
				}
				echo '<img src="'.$r['url'].'"" width="30px"/><input name="url '.$i.'" value="' . $r['url'] . '"/>';
				echo '<input name="img '.$i.'" value="'.$r['0'].'" hidden/>';


				echo '<select name="cat '.$i.'">';
				foreach ($CATEGORIES as $key => $value) {
					$selected = ($key == $r['categories_id']) ? 'selected' : '';
					echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
				}
				echo '</select>';

				echo '<input name="deleteImg '.$i++.'" value="'.$r['0'].'" type="checkbox"/> Delete<br/>';
			}
			echo '<input type="submit" value="Submit"/>';
		}
		if(!empty($_GET['title'])){
			$res = $con->query("SELECT * FROM creations WHERE title='".  $_GET['title'] ."'");
			$i=0;
			foreach ($res as $r) {
				if($i < 1) {
					echo '<input name="current" value="' . $r['title'] . '" hidden/>';
					echo '<input name="title" style="width:300px" value="' . $r['title'] . '"/>';
					echo '<input name="delete" value="'. $r['title'] .'" type="checkbox"/> Delete<br/>';
				}
				echo '<img src="'.$r['url'].'"" width="30px"/><input style="width:250px" name="url '.$i.'" value="' . $r['url'] . '"/>';
				echo '<input name="img '.$i.'" value="'.$r['0'].'" hidden/>';

				echo '<select name="cat '.$i.'">';
				foreach ($CATEGORIES as $key => $value) {
					$selected = ($key == $r['categories_id']) ? 'selected' : '';
					echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
				}
				echo '</select>';

				echo '<input name="deleteImg '.$i++.'" value="'.$r['0'].'" type="checkbox"/> Delete<br/>';
			}
			echo '<input type="submit" value="Submit"/>';
		}
		if(!empty($_GET['tuto'])){
			$res = $con->query("SELECT * FROM tutorial WHERE id='".  $_GET['tuto'] ."'")->fetch();
			echo '<input name="id" value="' . $res['id'] . '" hidden/>';
			echo '<input style="width:250px" name="tuto_name" value="' . $res['name'] . '"/><br/>';
			echo '<input name="delete" value="'. $r['title'] .'" type="checkbox"/> Delete<br/>';
			echo '<textarea cols="50" rows="15" name="tuto_desc">' . $res['description'] . '</textarea><br/>';
			echo '<input name="tuto_example" value="' . $res['example_url'] . '"/><br/>';
			echo '<img width="50" src="'.$res['example_url'].'"/><br/>';
			echo '<input type="submit" value="Submit"/>';
		}
		if(!empty($_GET['wc'])){
			$res = $con->query("SELECT * FROM webdesign_code WHERE id='".  $_GET['wc'] ."'")->fetch();
			echo '<input name="id" value="' . $res['id'] . '" hidden/>';
			echo '<input style="width:250px" name="wc_name" value="' . $res['name'] . '"/>';
			echo '<input name="delete" value="'. $res['name'] .'" type="checkbox"/> Delete<br/>';
			echo '<input style="width:250px" name="url" value="' . $res['url'] . '"/><br/>';
			echo '<textarea cols="50" rows="15" name="tuto_desc">' . $res['description'] . '</textarea><br/>';
			echo '<input name="preview" value="' . $res['preview'] . '"/><br/>';
			echo '<img width="50" src="'.$res['preview'].'"/><br/>';
			echo '<input type="submit" value="Submit"/>';
		}
		if(!empty($_GET['history'])){
			$res = $con->query("SELECT * FROM history WHERE id='".  $_GET['history'] ."'")->fetch();
			echo '<input name="id" value="' . $res['id'] . '" hidden/>';
			echo '<input style="width:250px" name="h_name" value="' . $res['name_title'] . '"/>';
			echo '<input name="delete" value="'. $res['name_title'] .'" type="checkbox"/> Delete<br/>';
			echo '<input style="width:250px" name="categories_id" value="' . $res['categories_id'] . '"/><br/>';
			echo '<input type="submit" value="Submit"/>';
		}


		?>
	</form>

	Note: Tu ne vois que les 20 derniers !!

</div>