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
	<body>
		<?php include 'header.php'; ?>
		<?php
		/**
		 * Created by PhpStorm.
		 * User: connorboyle
		 * Date: 7/14/16
		 * Time: 10:42 PM
		 */

		$conn = new mysqli("localhost", "cjblinko_rokuMan", "rokuMan", "cjblinko_rokuData", 3306);

		if ($conn -> connect_error) {
			die("Connection failed: " . $conn -> connect_error);
		}

		$sql = "DELETE FROM movieData where id='" . $_POST['id'] . "'";

		if ($conn -> query($sql) === TRUE) {
			echo "Record removed successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn -> error;
		}

		$conn -> close();
		?>

		<form action='deleteIndex.php'>
			<input type="submit" value='Back'/>
		</form>
		<?php include 'version.php' ?>
	</body>

</html>