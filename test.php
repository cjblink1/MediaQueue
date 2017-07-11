<?php

include "database.php";

include "config.php";


$userID = "";

if(isset($_POST['token'])) {
    $ticket = $gClient->verifyIdToken($_POST['token']);
    if ($ticket) {
        $data = $ticket->getAttributes();
        $userID = $data['payload']['sub']; // user ID
    } else {
        echo "Ticket not set";
    }

}else {
    die("No Access Token.");
}

echo $userID;

?>