<?php 
$app_id = '673050199540698';
$app_secret = 'febd8e346ea6fda591f5709b6d00039d';
$page_id = '647380205348927';

$user_token = "EAAJkIrYPQ9oBABwZBwzxWhuZCLuPmWFTZBgnjAKWfS3sISBWIm60hSqklLY5Hvjk0lXQDwv7MTXPTbs3tGZAkTUl5qfW9ZBnojnrhJmb1zWLSR6HKlL8lGO8Xeixos779ixWjZCXnvTgFTl96ZBiPdI7VNBU1UZAuAmHl0FYjqWuzAZDZD";


$timeout = 30;
$attachment = array(
	'app_id' => $app_id,
	'app_secret' => $app_secret
);

$url = 'https://graph.facebook.com/v2.9/647380205348927/feed?access_token='.$user_token;

$curl = curl_init();

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($curl, CURLOPT_COOKIESESSION, false);
curl_setopt($curl, CURLOPT_POSTFIELDS, $attachment);
curl_setopt($curl, CURLOPT_URL, $url);
//curl_setopt($curl, CURLOPT_URL, 'https://graph.facebook.com/'.$page_id.'?access_token='.$app_id.'|'.$app_secret.'&fields=publish_pages');
//curl_setopt($curl, CURLOPT_URL, 'https://graph.facebook.com/'.$page_id.'/feed?access_token='.$app_id.'|'.$app_secret);
curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$out = curl_exec($curl);
curl_close ($curl);
$pms = json_decode($out,true);

var_dump($url);
var_dump($pms);


?>