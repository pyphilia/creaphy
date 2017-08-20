<?php 

require_once('../bd.php');

if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>

<style type="text/css">

input, textarea, img {
	padding:5px;
	display: inline-block;
	vertical-align: top;
}

</style>

<form action="editProcess.php" method="post">

	<?php 

	$i=0;
	$j=0;

	echo '<input type="submit" id="submit">';

	$namefound = "#%#";
	$URLFOUND = "#0#";


	$q = $con1->query("SELECT * FROM header");
//$getTxt = mysqli_fetch_array($q, MYSQL_ASSOC);

	foreach($q as $getTxt) {
		echo '<div name="hey">';
		echo '<h1>'.$getTxt['nom'].'</h1>';
		echo '<input value="' . $getTxt['nom'] . '" name="name '.$j.'"/>';
		$i=0;
		$text = '';

		$img = preg_split('/#[0-9]+#/', $getTxt['html']);

		foreach($img as $i){

			$i = preg_replace('/\n/', '',$i);
			$i = preg_replace('/\s/', '',$i);

			if(!empty($i)){
				var_dump($i);


				echo '<input type="checkbox" name="delete '.$j.'"/> No add ';
				echo '<input name="url_'.$j.'" value="'.$i.'" />';
				echo '<img src="'.$i.'" width="150">';

				?>
				<select name="category <?php echo $j++; ?>">
					<option value="<?php echo FB_TW_ID; ?>">FB / TW</option>
					<option value="<?php echo HEADER_ID; ?>">header</option>
					<option value="<?php echo LOGO_ID; ?>">logo</option>
					<option value="<?php echo AVATAR_ID; ?>">avatar</option>
					<option value="<?php echo SIGNATURE_ID; ?>">signature</option>
					<option value="<?php echo WALLPAPER_ID; ?>">wall</option>
					<option value="<?php echo AUTRE_ID; ?>">autre</option>
					<option value="<?php echo TUTORIAL_ID; ?>">tuto</option>
				</select>
				<br/>
				<?php
				echo $j;
			}
		}

		echo '</div><br/>';
	}
	echo '</form>';


	?>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#submit').click(function(){
			$('form').each(function(){
				$(this).submit();
			});
		});
	});
	</script>


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