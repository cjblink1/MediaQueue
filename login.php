<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<?php include 'title.php'
		?>
		<meta name="description" content="">
		<meta name="author" content="boylec">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
		<style type="text/css">
			input[type=submit] {
				-webkit-appearance: none;
				-moz-appearance: none;
				display: block;
				margin: 0 0;
				font-size: .9em;
				line-height: 2.5em;
				color: #333;
				font-weight: bold;
				height: 2.5em;
				width: 100%;
				background: #fdfdfd;
				background: -moz-linear-gradient(top, #fdfdfd 0%, #bebebe 100%);
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fdfdfd), color-stop(100%,#bebebe));
				background: -webkit-linear-gradient(top, #fdfdfd 0%,#bebebe 100%);
				background: -o-linear-gradient(top, #fdfdfd 0%,#bebebe 100%);
				background: -ms-linear-gradient(top, #fdfdfd 0%,#bebebe 100%);
				background: linear-gradient(to bottom, #fdfdfd 0%,#bebebe 100%);
				border: 1px solid #bbb;
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				border-radius: 10px;
			}
			
			.signin{
				height:46px;
				content:url('/images/btn_google_signin_dark_normal_web@2x.png');
			}
			/*.signin:hover{
				height:41px;
				content:url('/images/btn_google_signin_dark_focus_web@2x.png');
			}*/
			/*.signin:active{
				height:46px;
				content:url('/images/btn_google_signin_dark_pressed_web@2x.png');
			}*/
			
		</style>
	</head>
	<body>

		<?php
		include 'header.php';
		include_once ("config.php");

		include_once ("includes/functions.php");

		//print_r($_GET);die;

		if (isset($_REQUEST['code'])) {
			$gClient -> authenticate();
			$_SESSION['token'] = $gClient -> getAccessToken();
			header('Location: ' . filter_var($redirectUrl, FILTER_SANITIZE_URL));
		}

		if (isset($_SESSION['token'])) {
			$gClient -> setAccessToken($_SESSION['token']);
		}

		if ($gClient -> getAccessToken()) {
			$userProfile = $google_oauthV2 -> userinfo -> get();
			//DB Insert
			$gUser = new Users();
			$gUser -> checkUser('google', $userProfile['id'], $userProfile['given_name'], $userProfile['family_name'], $userProfile['email'], $userProfile['gender'], $userProfile['locale'], $userProfile['link'], $userProfile['picture']);
			$_SESSION['google_data'] = $userProfile;
			// Storing Google User Data in Session
			header("location: index.php");
			$_SESSION['token'] = $gClient -> getAccessToken();
		} else {
			$authUrl = $gClient -> createAuthUrl();
		}

		if (isset($authUrl)) {
			echo '<a href="' . $authUrl . '"><img class="signin" /></a>';
		} else {
			echo '<a href="logout.php?logout">Logout</a>';
		}
		
		include 'version.php';
		?>
	</body>
</html>
