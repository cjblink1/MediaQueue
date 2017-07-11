<?php

include 'database.php';
$conn = db_conn();

if ($_POST['showIndex'] > 0) {
	$sql = "UPDATE movieData SET showIndex='" . $_POST['showIndex'] . "' WHERE showIndex='" . ($_POST['showIndex'] - 1) . "';";
	$sql .= "UPDATE movieData SET showIndex='" . ($_POST['showIndex'] - 1) . "' WHERE id='" . $_POST['id'] . "';";

	if ($conn -> multi_query($sql)) {
		echo "<META http-equiv=\"refresh\" content=\"0;URL=changeIndex.php\">";
	}
} else {
	echo "<META http-equiv=\"refresh\" content=\"0;URL=changeIndex.php\">";
}
?>