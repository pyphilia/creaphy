<meta charset="utf-8">

<?php 

require_once('../bd.php');

if(isset($_POST)){
	
	if(isset($_POST['webdesign'])){
		$name = htmlspecialchars($_POST['name']);
		$url = htmlspecialchars($_POST['url']);
		$preview = htmlspecialchars($_POST['preview']);
		$desc = htmlspecialchars($_POST['description']);

		/*$con->query('INSERT INTO webdesign_code (name, description, preview, url, categories_id, last_modified) VALUES("'.$name.'","'.$desc.'","'.$preview.'","'.$url.'","'. WEBDESIGN_ID .'","'.currentDate().'")');
		$con->query('INSERT INTO history (nb, name_title, categories_id, celebrities_id) VALUES("1","'.$name.'","'.WEBDESIGN_ID.'", "")');

		setError('Webdesign publié');*/

		/*FACEBOOK*/
		$message = '+ 1 webdesign ' . $name . ' ' . SITE_URL . '?p=' . getPageUrl(WEBDESIGN_ID);
		$img_url = $preview;
		/*TWITTER*/
		$tw_url1 = $preview;

	}
	else if(isset($_POST['code'])){
		$name = htmlspecialchars($_POST['name']);
		$url = htmlspecialchars($_POST['url']);
		$preview = htmlspecialchars($_POST['preview']);
		$desc = htmlspecialchars($_POST['description']);

		/*$con->query('INSERT INTO webdesign_code (name, description, preview, url, categories_id, last_modified) VALUES("'.$name.'","'.$desc.'","'.$preview.'","'.$url.'","'. CODE_ID .'","'.currentDate().'")');
		$con->query('INSERT INTO history (nb, name_title, categories_id, celebrities_id) VALUES("1","'.$name.'","'.CODE_ID.'", "")');

		setError('Code publié');*/

		/*FACEBOOK*/
		$message = '+ 1 code ' . $name . ' ' . $url;
		$img_url = $preview;
		
		/*TWITTER*/
		$tw_url1 = $preview;

	}
	else if(isset($_POST['creation'])){


		if(!allIsSet(array('category','desc'))){
			header('Location: add.php');
			die();
		}
		$category = htmlspecialchars($_POST['category']);
		$commande = (isset($_POST['request'])) ? '1' : '0';
		$name = (isset($_POST['name'])) ? $_POST['name'] : "";
		$celeb = htmlspecialchars($_POST['celeb']);
		$result = preg_split('/[\s,]+/', $_POST['desc']);
		$celebId = $con->query('SELECT id FROM celebrities WHERE name="'.$celeb.'"')->fetch();
		$count = 2;
		//var_dump($_POST);

		if(!isset($celebId['id'])){
			$con->query("INSERT INTO celebrities(name) VALUES('".$celeb."')");
			$celebId = $con->query("SELECT id FROM celebrities ORDER BY id DESC LIMIT 1")->fetch();
		}
		
		$count = 0;
		foreach($result as $img){
			if(!empty($img)){
				$query = 'INSERT INTO creations (url, celebrities_id, categories_id, last_modified, title) VALUES ("'.$img.'","'.$celebId['id'].'","'.$category.'","'.currentDate().'","'.$name.'")';
				$con->query($query);
				$count++;
			}
		}
		
		$con->query('INSERT INTO history (nb, name_title, categories_id, celebrities_id, commande) VALUES("'.$count.'","'.$name.'","'.$category.'", "'.$celebId['id'].'", "'.$commande.'")');

		setError('Création publiée');

		/*FACEBOOK*/
		$category_name =  $con->query('SELECT name FROM categories WHERE id='.$category)->fetch()['name'];
		$name = $con->query('SELECT name FROM celebrities WHERE id='.$celebId['id'])->fetch()['name'];
		$message = '+ ' . $count . ' ' .$category_name .' de ' . $name . ' ' . SITE_URL . '?p=' . getPageUrl($category);
		if($category == AVATAR_ID || $category == ICON_ID || $category == SIGNATURE_ID){
			$message = $message . '&search=' . $name;
		}
		$img_url =  $result['0'];

		/*TWITTER*/
		$tw_url1 = $result['0'];
		$tw_url2 = ($count > 1) ? $result['1'] : '';
		
		
	}
	else if(isset($_POST['tutorial'])){
		$name = htmlspecialchars($_POST['name']);
		$ex = htmlspecialchars($_POST['example']);
		$desc = htmlspecialchars($_POST['desc']);

		/*$con->query('INSERT INTO tutorial (name, example_url, description, date) VALUES("'.$name.'","'.$ex.'","'.$desc.'","'. currentDate() .'")');
		$con->query('INSERT INTO history (nb, name_title, categories_id, celebrities_id) VALUES("1","'.$name.'","'.TUTORIAL_ID.'", "")');

		setError('Tutorial publié');*/

		/*FACEBOOK*/
		$message = '+ 1 tutoriel ' . $name;
		$img_url = $ex;

		/*TWITTER*/
		$tw_url1 = $ex;
	}
	else if(isset($_POST['music'])){
		ini_set('post_max_size','10M');
		$target_dir = "../uploads/";
		$name = $_POST['artist'] .'-'. $_POST['song'] . '.mp3';
		move_uploaded_file($_FILES["file"]['tmp_name'], $target_dir . $name);
		$con->query('INSERT INTO music (artist, name, url, img) VALUES("'.$_POST['artist'].'","'.$_POST['song'].'","'.$name.'","'. $_POST['url'] .'")');
		setError('Musique uploadée');
	}
	else {
		setError('Erreur');
	}
	/*require('../facebook.php');
	require_once('../twitter.php');*/
	header('Location: add.php');
}



?>