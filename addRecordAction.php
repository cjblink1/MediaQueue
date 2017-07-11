<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<?php include 'title.php' ?>
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
				margin: .5em 0;
				font-size: .9em;
				line-height: 2.5em;
				color: #333;
				font-weight: bold;
				height: 2.5em;
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
		</style>
	</head>

	<?php

	// URL Parsing
	session_start();
	$platform;
	$contentID;
	$simpleurl;
	$url_components = parse_url($_POST['url']);

	if (strcmp($url_components['host'], "youtu.be") == 0) {
		$platform = 'youtube';
		$contentID = substr($url_components['path'], 1);
		$simpleurl = 'http://youtu.be/' . $contentID;
	} else if (strcmp($url_components['host'], "www.youtube.com") == 0) {
		$platform = 'youtube';
		$contentID = substr($url_components['query'], 2);
		$simpleurl = 'http://youtu.be/' . $contentID;
	} else if (strcmp($url_components['host'], "www.netflix.com") == 0) {
		$platform = 'netflix';
		if (strpos($url_components['path'], '/title') !== FALSE) {
			//short form of the URL
			$contentID = substr($url_components['path'], 7, 8);
		} else if (strpos($url_components['path'], '/search') !== FALSE) {
			//search form of the URL
			$contentID = substr($url_components['query'], strpos($url_components['query'], 'jbv') + 4, 8);
		} else if (strpos($url_components['path'], '/browse') !== FALSE) {
			//search form of the URL
			$contentID = substr($url_components['query'], strpos($url_components['query'], 'jbv') + 4, 8);
		} else if (strpos($url_components['path'], '/watch') !== FALSE) {
			//watch form of the url
			$contentID = substr($url_components['path'], 7, 8);
		} else {
			die("Unrecognized Netflix URL.");
		}
		$simpleurl = 'http://www.netflix.com/title/' . $contentID . "?s=i";
	} else if (strcmp($url_components['host'], "www.amazon.com") == 0) {
		$platform = 'amazon';
		if (strpos($url_components['path'], '/dp') !== FALSE){
			$contentID = substr($url_components['path'], strpos($url_components['path'], '/dp') + 4, 10);
		} else if (strpos($url_components['path'], '/gp/product') !== FALSE){
			$contentID = substr($url_components['path'], strpos($url_components['path'], '/gp/product') + 12, 10);
		} else {
			die('Unrecognized Amazon Instant Video URL.');
		}
		$simpleurl = $_POST['url'];
	} else {
		die("Unable to parse URL");
	}

	//Add to DB
	$conn = new mysqli("localhost", "cjblinko_rokuMan", "rokuMan", "cjblinko_rokuData", 3306);

	if ($conn -> connect_error) {
		die("Connection failed: " . $conn -> connect_error);
	}

	$sql = "INSERT INTO `movieData` (`name`, `platform`, `contentID`, `url`, `simpleurl`, `userID`, `showIndex`)
VALUES ('" . $_POST['name'] . "', '" . $platform . "', '" . $contentID . "', '" . $_POST['url'] . "', '" . $simpleurl . "', '" . $_SESSION['google_data']['id'] . "', '-1')";

	if ($conn -> query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn -> error;
	}

	$conn -> close();
	?>
	<body>
		<?php include 'header.php'; ?>
		<form action='index.php'>
			<input type='submit' value="Back"/>
		</form>
		<?php include 'version.php'; ?>
	</body>
</html>