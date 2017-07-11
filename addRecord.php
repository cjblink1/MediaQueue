<!DOCTYPE html>
<html lang="en">
	<head>
		<script src="http://www.w3schools.com/lib/w3data.js"></script>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>MediaQueue</title>
		<meta name="description" content="">
		<meta name="author" content="boylec">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
		<style type="text/css">
			input[type=text], input[type=url], input[type=email], input[type=password], input[type=tel], select {
				-webkit-appearance: none;
				-moz-appearance: none;
				display: block;
				margin: 0;
				width: 100%;
				height: 40px;
				line-height: 40px;
				font-size: 17px;
				border: 1px solid #bbb;
			}
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
		<?php include 'header.php';
		?>
		<form action='addRecordAction.php' method="post">
			<table>
				<tr>
					<td>Media Title:</td>
					<td>
					<input type='text' name='name' >
					</td>
				</tr>
				<tr>
					<td>URL:</td>
					<td>
					<input type='url' name='url' required>
					</td>
				</tr>
				<!-- <tr>
				<td>Platform:</td>
				<td>
				<select name="platform">
				<option value="netflix">Netflix</option>
				<option value="amazon">Amazon Instant Video</option>
				<option value="youtube">YouTube</option>
				</select></td>
				</tr>
				<tr>
				<td>Content ID:</td>
				<td>
				<input type='text' name='contentID' >
				</td>
				</tr> -->
			</table>
			<input type="submit" value='Submit' />

		</form>

		<form action='index.php'>
			<input type="submit" value='Back'/>
		</form>
		<?php
			include 'version.php';
		?>
	</body>
</html>
