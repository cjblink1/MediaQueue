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
			td{
				padding: 0px 0px 0px 0px;
				height:36px;
			}
		</style>
	</head>

	<?php

	session_start();
	if (!isset($_SESSION['google_data'])) :header("Location:login.php");
	endif;

	/**
	 * Created by PhpStorm.
	 * User: connorboyle
	 * Date: 7/14/16
	 * Time: 9:22 PM
	 */

	include 'database.php';

	function list_movie_data($result, $conn, $userID) {
		$count = 0;
		while ($row = $result -> fetch_assoc()) {

			$rokuEnable = isRokuEnabled($conn, $userID);

			$htmlform = ($rokuEnable) ? "<form action='playMovie.php' method='post'>\n" : "";
			$htmlform .= "<tr><input type='hidden' name='id' value='%1\$s'>\n";
			$htmlform .= "<td>%2\$s<input type='hidden' name='name' value='%2\$s'></td>\n";
			$htmlform .= "<td>%3\$s<input type='hidden' name='platform' value='%3\$s'></td>\n";
			$htmlform .= "<td><a href='%5\$s'>%4\$s</a><input type='hidden' name='contentID' value='%4\$s'></td>\n";
			$htmlform .= ($rokuEnable) ? "<td><input type='submit' value='Play on Roku'</td></form>\n" : "";
			$htmlform .= "</tr>\n";
			echo sprintf($htmlform, $row["id"], $row["name"], $row["platform"], $row["contentID"], $row["simpleurl"]);
			$htmlform = "";
			updateShowIndex($row["id"], $count, $conn);
			$count += 1;
		}
	}

	$conn = db_conn();
	$result = $conn -> query("SELECT * FROM movieData WHERE userID='" . $_SESSION['google_data']['id'] . "' ORDER BY showIndex ASC");
	?>
	<body>
	<?php
	include 'header.php';
	?>

	<table style='border: 1px solid black;'>
	<tr>
	<th>Name</th>
	<th>Platform</th>
	<th>Content ID</th>
	</tr>

	<?php list_movie_data($result, $conn, $_SESSION['google_data']['id']); ?>
	</table>
	<table>
	<tr>
	<td>
	<form action="addRecord.php">
	<input type="submit" value="Add Record" />
	</form></td>
	<td>
	<form action="changeIndex.php">
	<input type="submit" value ="Change Order" />
	</form></td>
	</tr>
	<tr>
		<td>
		<form action="deleteIndex.php">
			<input type="submit" value="Remove Record"/>
		</form></td>
		<td>
		<form action="logout.php" method="get">
			<input type="hidden" name="logout" value="" />
			<input type="submit" value="Logout" />
		</form></td>
	</tr>
	</table>
	<?php
	include 'version.php';
	?>
	</body>
</html>
