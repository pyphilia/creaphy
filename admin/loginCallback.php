<?php 
require_once '../vendor/Facebook/autoload.php';
session_start();

$fb = new Facebook\Facebook([
  'app_id' => '128727894133033',
  'app_secret' => '26517495e61aa20e4b9ff2452b9387c6',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();


try {
	$accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
	echo 'Graph returned an error: ' . $e->getMessage();
	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
}

if (isset($accessToken)) {
  // Logged in!
	$_SESSION['facebook_access_token'] = (string) $accessToken;
	header('Location:../facebook.php');

  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']
}


?>