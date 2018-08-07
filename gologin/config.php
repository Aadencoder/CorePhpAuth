<?php
include_once("src/Google_Client.php");
include_once("src/contrib/Google_Oauth2Service.php");
######### edit details ##########
$clientId = '261602092078-7933ui970vambku86or28vbrecvv05tb.apps.googleusercontent.com'; //Google CLIENT ID
$clientSecret = 'L9WGo8uwdC8UhKRb930zQjn_'; //Google CLIENT SECRET
$redirectUrl = 'http://localhost/zimboo/home.php';  //return url (url to script)
$homeUrl = 'http://localhost/zimboo/';  //return to home

##################################

$gClient = new Google_Client();
$gClient->setApplicationName('Login to ZimboO.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectUrl);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>