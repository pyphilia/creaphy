<style type="text/css">
	img {
		filter:grayscale(100%);
		opacity:0.5;
		height:200px;
	} 
	img:hover {
		filter:none;
		opacity:0.9;
	}
</style>

<?php 
require_once 'vendor/autoload.php';
if(!session_id()) {
	session_start();
}

// make sure you have enough time to download all pictures
ini_set('max_execution_time', 6000);
ini_set('memory_limit', '64M');

$app_id = '673050199540698';
$app_secret = 'febd8e346ea6fda591f5709b6d00039d';

$page_id = '647380205348927';

$fb = new Facebook\Facebook([
	'app_id' => $app_id,
	'app_secret' => $app_secret,
	'default_graph_version' => 'v2.8',
	]);

// TO OBTAIN ACCESS TOKEN
/*$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/creaphy/facebook_callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';


var_dump($_SESSION);

$helper = $fb->getPageTabHelper();
$accessToken = $_SESSION['fb_access_token'];
if (!isset($accessToken)) {
  echo 'No OAuth data could be obtained from the signed request. User has not authorized your app yet.';
  exit;
}*/

// long lived acces token
$accessToken = "EAAJkIrYPQ9oBABwZBwzxWhuZCLuPmWFTZBgnjAKWfS3sISBWIm60hSqklLY5Hvjk0lXQDwv7MTXPTbs3tGZAkTUl5qfW9ZBnojnrhJmb1zWLSR6HKlL8lGO8Xeixos779ixWjZCXnvTgFTl96ZBiPdI7VNBU1UZAuAmHl0FYjqWuzAZDZD";


// get all photos (no specific album) with limit set to 50 (enough)
$page = $fb->get('/'.$page_id."/photos/uploaded?limit=50", $accessToken);
$photos = $page->getDecodedBody();
foreach ($photos['data'] as $photo) {
	$photo_id = $photo['id'];
	// print the image with link to facebook
	echo '<a target="_blank" href="https://www.facebook.com/photo.php?fbid='.$photo_id.'&theater"><img src="https://graph.facebook.com/'.$photo_id.'/picture"/></a>';
}

?>
