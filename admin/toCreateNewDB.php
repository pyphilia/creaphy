<meta charset="utf-8">

<?php 
include('../bd.php');
$con = mysqli_connect('localhost','root','', 'creaphy');
$con1 = mysqli_connect('localhost','root','', 'cv8');
$db = 'creaphy';

if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>


<form method="POST" action="toCreateNewDB.php">
	<textarea cols="60" rows="20" type="text" name="html"><?php 
	$q = mysqli_query($con,"SELECT * FROM signature");
//$getTxt = mysqli_fetch_array($q, MYSQL_ASSOC);

	while($getTxt = mysqli_fetch_array($q)) {

		echo "#%#" . $getTxt['nom'] . "#%#";
		$i=0;
		while(getHtml($i,$getTxt['html'])){
			$link = getHtml($i++,$getTxt['html']);
			echo "#0#" . $link . "#0#";
		}
	} ?></textarea>
	<input type="submit">
</form>

<?php 


if(isset($_POST['html'])){

	$text = $_POST['html'];
	// nom entre &%&
	// entre #0# les url

	$namefound = "#%#";
	$URLFOUND = "#0#";
	$posStart = 0;
	$posNext = 1;
	$length = strlen($text);
	$i = 0;
	while($posStart!==false and strpos($text,$namefound,$posStart+strlen($namefound))!==false){

	// search the names
		$posStart = strpos($text,$namefound,$posStart);
		$posNext = strpos($text,$namefound,$posStart+1);

		$lenghtlink = $posNext-$posStart-strlen($namefound);
		$name = substr($text, $posStart+strlen($namefound), $lenghtlink);

		var_dump($name);

		$s = mysqli_query($con1, "SELECT * FROM celebrities WHERE name='".$name."'");
		$celebrity = mysqli_fetch_array($s, MYSQL_ASSOC);

		if(!isset($celebrity['id'])){
			mysqli_query($con1, "INSERT INTO celebrities(name) VALUES('".$name."')");
			$p = mysqli_query($con1,"SELECT id FROM celebrities ORDER BY id DESC LIMIT 1");
			$lastId = mysqli_fetch_array($p, MYSQL_ASSOC);

			$id = $lastId['id'];
		}

		else {
			$id = $celebrity['id'];
		}

	// search the urls after

		// VERIFIER BOUCLE INFINIE

		while($posStart!==false and strpos($text,$URLFOUND,$posStart+strlen($URLFOUND))!==false){
			
			$posStart = strpos($text,$URLFOUND,$posStart);

			if($posStart-$posNext>4){
				$posStart=$posNext+1;
				break;
			}

			$posNext = strpos($text,$URLFOUND,$posStart+1);

			$lenghtlink = $posNext-$posStart-strlen($URLFOUND);
			$link = substr($text, $posStart+strlen($URLFOUND), $lenghtlink);
			$posStart = $posNext+1;

			// test if the url already exists
			$exist = false;
			$test = mysqli_query($con1,"SELECT * FROM creations WHERE url='". $link ."'");
			foreach(mysqli_fetch_array($test,MYSQL_ASSOC) as $m => $v){
				// find so add the condition
				$exist = true;
				var_dump($exist);
			}
			if(!$exist) {
				$sql = "INSERT INTO creations (celebrities_id, url, categories_id, last_modified) VALUES ('".$id."','".$link."','".SIGNATURE_ID."','".date('Y-m-d H:i:s')."')";
					$mysql = mysqli_query($con1, $sql);
			}

		// insert or/and get id

			


		}
		$i++;
	}
}


?>


<?php 


	// GET LINKS BETWEEN #0#
function getHtml($i, $html){

	$posStart = 0;

	$find = '#'.$i.'#';
	$posStart = strpos($html,$find,$posStart);

	if($posStart!==false and strpos($html,$find,$posStart+strlen($find))!==false){

		$posEnd = strpos($html,$find,$posStart+strlen($find));

		$lenghtlink = $posEnd-$posStart-strlen($find);

		$link = substr($html, $posStart+strlen($find), $lenghtlink);
		$link = str_replace(array("\r", "\n", "\r\n"), "", $link);
			//var_dump($link);
		return $link;
	}
	else {
		return false;
	}
}
?>