<?php
include_once("config.php");
if(array_key_exists('logout',$_GET))
{
	$gClient->revokeToken($_SESSION['token']);
	unset($_SESSION['token']);
	unset($_SESSION['google_data']); //Google session data unset
	session_destroy();
	header("Location:index.php");
}
?>