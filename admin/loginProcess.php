<?php 
require_once('../bd.php');

if(isset($_POST['name']) && isset($_POST['mdp'])){

	$name = htmlspecialchars($_POST['name']);
	$mdp = htmlspecialchars($_POST['mdp']);

	$exist = $con->query('SELECT * FROM users WHERE name="'.$name.'"')->fetch();

	if($exist){
		$real = $con->query('SELECT * FROM users WHERE name="'.$name.'"')->fetch();
		$realMDP = $real['password'];

		if(md5($mdp)==$realMDP){
			session_start();
			$_SESSION['name'] = $name;
			$_SESSION['mdp'] = $realMDP;
			//header('Location: add.php');
			?><script type="text/javascript">window.location = <?php echo '"'.SITE_URL.'admin/add.php"'; ?>;</script><?php
			exit;
		}

		else {
			echo '<br/>Bad password';
		}
	}
	else {
		echo '<br/>Bad name';
	}
	
}