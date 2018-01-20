<?php
try {
//	$con = new PDO('mysql:host=fdb7.royalwebhosting.net;dbname=2120706_creaphy', '2120706_creaphy', 'rVive_pyro1');
	$con = new PDO('mysql:host=localhost;dbname=cv9', 'root', '');
	//$con1 = new PDO('mysql:host=localhost;dbname=creaphy', 'root', '');
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}

define('SITE_URL', 'http://localhost/creaphy/');
//define('SITE_URL', 'http://creaphy.royalwebhosting.net/');


// DEFINE CATEGORIES ID

$CODE_REQUIRED = "pyphilia1997";




function getPageUrl($id){
	if($id==AVATAR_ID or $id==ICON_ID or $id==SIGNATURE_ID or $id==GIF_ID ){
		return 2;
	}
	else if($id==WEBDESIGN_ID){
		return 4;
	}
	else if($id==CODE_ID) {
		return 5;
	}
	else if($id==TUTORIAL_ID){
		return 6;
	}
	else if($id==HEADER_ID or $id==LOGO_ID or $id==WALLPAPER_ID or $id==AUTRE_ID or $id==FB_TW_ID){
		return 3;
	}
}




function currentDate(){
	return date('Y-m-d H:i:s');
}

function isLogged($con){
	if(isset($_SESSION['name']) and isset($_SESSION['mdp']))  {
		$user = $con->query('SELECT * FROM users')->fetch();
		if(isset($user['id'])){
			return true;
		}
	}
	return false;
}

function setError($string){
	$_SESSION['flash'] = $string;
}


function allIsSet($args){
	foreach($args as $k){
		if(empty($_POST[$k])){
			setError('Il manque (entre autres) : '. $k);
			return false;
		}
	}
	return true;
}

// FLASH ERROR


if(!empty($_SESSION['flash'])){
	echo '<span style="background:red;color:white;">' . $_SESSION['flash'] . '</span>';
	$_SESSION['flash'] = '';
}

//session_start();




function showNews($id, $lastId, $marginId) {

	if($id > $lastId - $marginId) {
		echo '<span style="color:red">';
		echo ' <i class="fa fa-diamond" aria-hidden="true"></i> ';
		echo '</span>';
	}
} 


function isOk() {
	if(isset($_COOKIE['code'])) {
		return true;
	}
	return false;
}