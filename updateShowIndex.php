<?php 

	include "database.php";
	
	$conn = db_conn();
	
	$sql = "UPDATE movieData SET showIndex='".$_GET["showIndex"]."' WHERE id='".$_GET["id"]."'";
	
	$conn->query($sql);
	
	echo "Hello World";


?>