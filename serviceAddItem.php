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

$conn = db_conn();

$sql = "INSERT INTO `movieData` (`name`, `platform`, `contentID`, `url`, `simpleurl`, `userID`, `showIndex`)
VALUES ('" . $_POST['name'] . "', '" . $platform . "', '" . $contentID . "', '" . $_POST['url'] . "', '" . $simpleurl . "', '" . $userID . "', '-1')";

$conn->query($sql);