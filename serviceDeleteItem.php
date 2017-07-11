<?php

include "database.php";

include "config.php";

$userID = "";

if(isset($_GET['token'])) {
    $ticket = $gClient->verifyIdToken($_GET['token']);
    if ($ticket) {
        $data = $ticket->getAttributes();
        $userID = $data['payload']['sub']; // user ID
    } else {
        echo "Ticket not set";
    }

}else {
    die("No Access Token.");
}

$conn = db_conn();

$sql = "DELETE FROM movieData WHERE id =".$_GET['id'];

$conn->query($sql);

?>