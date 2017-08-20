<?php 
require("Imgur.php");
$imgur_client_id = "77174c1ba382af2";

$imgur = new Imgur($imgur_client_id);
var_dump($imgur->getImagesFromAlbum("JAIB8"));

phpinfo();

 ?>