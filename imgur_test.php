<!-- <form action="" enctype="multipart/form-data" method="POST">
	Choose Image : <input name="img" size="35" type="file"/><br/>
	<input type="submit" name="submit" value="Upload"/>
</form> -->

<?php 

$client_id_imgur = "1386c0cf5ad7748";


$pms = getImagesFromAlbum("PJH5A");

$tags = "seo in guk, u-kiss";
$tags = processTags($tags);

$sorted = sortByTags(array_slice($pms['data'],0,10), $tags);

var_dump($sorted);



$i = 0;

/*foreach($pms['data'] as $link) {
	echo '<img style="height:100px;" src="'.$link['link'].'"/>';
	if($i++ > 10) break;
}*/


// tags is a string containing comma
function processTags($tags){

	// get array of tags
	$tags = explode(",",$tags);

	$res = [];
	foreach ($tags as $tag) {
		$t = strtolower($tag);
		$t = preg_replace("/[-\s\,\.\#]/", "", $t);
		array_push($res, $t);
	}
	return $res;
}

function sortByTags($data, $tags){
	$res = [];
	foreach ($data as $key => $value) {
		foreach ($tags as $tag) {
			if(strpos($value['description'], $tag) !== false){
				array_push($res, $value);
				break;
			}
		}
	}
	return $res;
}


function getImagesFromAlbum($albumId) {
	global $client_id_imgur;
	$timeout = 30;
	$curl = curl_init();

	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/album/'.$albumId.'/images');
	curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id_imgur));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$out = curl_exec($curl);
	curl_close ($curl);
	$pms = json_decode($out,true);
	return $pms;
}



function upload() {
	$img = $_FILES['img'];
	if(isset($_POST['submit'])){ 
		if($img['name']==''){  
			echo "<h2>An Image Please.</h2>";
		}
		else{
			global $client_id_imgur;
			$filename = $img['tmp_name'];
			$handle = fopen($filename, "r");
			$data = fread($handle, filesize($filename));
			$pvars   = array('image' => base64_encode($data) /*, 'album' => "hR8io"*/); // Need to be authorize --> token in url
			$timeout = 30;
			$curl = curl_init();
		// BAD
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

			curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
			curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id_imgur));
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
			$out = curl_exec($curl);
			curl_close ($curl);
			$pms = json_decode($out,true);
			var_dump($pms);
			$url=$pms['data']['link'];
			if($url!=""){
				echo "<h2>Uploaded Without Any Problem</h2>";
				echo "<img src='$url'/>";
			}else{
				echo "<h2>There's a Problem</h2>";
				echo $pms['data']['error'];  
			} 
		}
	}
}
?>