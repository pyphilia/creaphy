<?php 
require_once('../bd.php');

if(!isOk()) {
	header("Location: ".SITE_URL."/admin/code.php");
}

 ?>

<h1>Add User</h1>

<form method="POST" action="addUser.php">
	<input name="name" value="Yes"/>
	<input name="mdp" type="password" value="MDP"/>
	<input type="submit" value="Submit"/>
</form>


<?php 

if(isset($_POST['name']) && isset($_POST['mdp'])){

	$name = htmlspecialchars($_POST['name']);
	$mdp = htmlspecialchars($_POST['mdp']);

	$exist = $con->query('SELECT * FROM users WHERE name="'.$name.'"')->fetch();

	if($exist){
		echo 'Already exists !';
	}
	else {
		$pdw = md5($mdp);
		$con->query('INSERT INTO users (name, password) VALUES ("'. $name .'", "'. $pdw .'")');
	}
}


?>