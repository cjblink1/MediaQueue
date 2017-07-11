<?php
session_start();
include_once ("src/Google_Client.php");
include_once ("src/contrib/Google_Oauth2Service.php");
######### edit details ##########
$clientId = '417813978023-5eo8a3fksso4tbdcmple1ltg2ift4del.apps.googleusercontent.com';
//Google CLIENT ID
$clientSecret = 'uWPrGmf71YSy9MTDwPjTydpO';
//Google CLIENT SECRET
$redirectUrl = 'http://mediaqueue.cjblink120.com/login.php';
//return url (url to script)
$homeUrl = 'http://mediaqueue.cjblink120.com';
//return to home

##################################

$gClient = new Google_Client();
$gClient -> setApplicationName('Login to mediaqueue.cjblink120.com');
$gClient -> setClientId($clientId);
$gClient -> setClientSecret($clientSecret);
$gClient -> setRedirectUri($redirectUrl);
$gClient -> setAccessType("online");
$gClient -> setApprovalPrompt("auto");

$google_oauthV2 = new Google_Oauth2Service($gClient);

?>