<?php
/**
 * Created by PhpStorm.
 * User: connorboyle
 * Date: 7/14/16
 * Time: 10:42 PM
 */

//function playYoutube($contentID)
//{
//    echo sprintf('http://cjblink1.ddns.net:7890/launch/837?contentID=%s',$contentID);
//    $r = new HttpRequest(sprintf('http://cjblink1.ddns.net:7890/launch/837?contentID=%s',$contentID), HTTP_METH_POST);
//    $response = $r->send();
//    echo $response->getBody();
//
//}
//
//echo sprintf("Playing \"%s\".", $_POST["name"]);
//playYoutube($_POST["contentID"]);


//extract data from the post
//set POST variables
$url = 'http://cjblink1.ddns.net';
$fields = array(
    'id' => urlencode($_POST['id']),
    'name' => urlencode($_POST['name']),
    'platform' => urlencode($_POST['platform']),
    'contentID' => urlencode($_POST['contentID'])
);

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);



?>