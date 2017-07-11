<?php

include "database.php";

include "config.php";

include "includes/functions.php";

$userID = "";

if (isset($_GET['code'])) {
	
	$gClient -> authenticate($_GET['code']);

	//echo $gClient -> getAccessToken();
	//$gClient -> setAccessToken($_GET['accessToken']);
	$userProfile = $google_oauthV2 -> userinfo -> get();
	//$userProfile = $google_oauthV2 -> userinfo -> get();
	//DB Insert
	$gUser = new Users();
	$gUser -> checkUser('google', $userProfile['id'], $userProfile['given_name'], $userProfile['family_name'], $userProfile['email'], $userProfile['gender'], $userProfile['locale'], $userProfile['link'], $userProfile['picture']);
}

if (isset($_GET['token'])) {
	$ticket = $gClient -> verifyIdToken($_GET['token']);
	if ($ticket) {
		$data = $ticket -> getAttributes();
		$userID = $data['payload']['sub'];
		// // user ID

	} else {
		echo "Ticket not set";
	}

} else {
	die("No Access Token.");
}

$conn = db_conn();

$sql = "SELECT name, id, simpleurl FROM movieData WHERE userID='" . $userID . "'ORDER BY showIndex ASC";

if ($result = $conn -> query($sql)) {
	// If so, then create a results array and a temporary one
	// to hold the data
	$resultArray = array();
	$tempArray = array();

	// Loop through each row in the result set
	while ($row = $result -> fetch_assoc()) {
		// Add each row into our results array
		$tempArray = $row;
		array_push($resultArray, $tempArray);
	}

	// Finally, encode the array to JSON and output the results
	echo json_encode($resultArray);
}
