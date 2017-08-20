<?php 
if($_SESSION['name']=='Pyphilia' and $_SESSION['mdp']=='it\''sme){
	header('Location: index.php');
}

echo 'T es ' . $_SESSION['name'];

 ?>