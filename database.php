<?php

function db_conn() {

	$conn = new mysqli("localhost", "cjblinko_rokuMan", "rokuMan", "cjblinko_rokuData", 3306);

	if ($conn -> connect_error) {
		die("Connection failed: " . $conn -> connect_error);
	}
	return $conn;
}

function updateShowIndex($id, $showIndex, $conn) {

	$sql = "UPDATE movieData SET showIndex='" . $showIndex . "' WHERE id='" . $id . "'";
	if ($conn -> query($sql) === TRUE) {

	} else {
		echo "Error: " . $sql . "<br>" . $conn -> error;
	}

}

function isRokuEnabled($conn, $userID) {

	$sql = "SELECT rokuEnable from users WHERE oauth_uid='" . $userID . "'";
	$result = $conn -> query($sql);

	while ($row = $result -> fetch_assoc()) {
		return $row['rokuEnable'];
	}
}

session_start();
?>