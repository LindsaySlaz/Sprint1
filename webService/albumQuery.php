<?php

require_once("Database/DB.class.php");

$rawData = file_get_contents("php://input");

if (is_null($rawData) || empty($rawData)){
    
    print "No input recieved.";
    exit;
}

$input = json_decode($rawData);

if (!property_exists($input,"searchField")){
    print json_encode(array("result" =>
    array("ErrorMessage" => "No query detected")));
    exit;
}

$db = new DB();
$safeValue = $db->dbEsc($input->searchField);

$query = "SELECT albumtitle, albumartist, albumlength, albumlink 
            FROM album
            WHERE albumtitle LIKE '%" . $safeValue . "%' OR albumartist LIKE '%" . $safeValue . "%'";
	
$results = $db->dbCall($query);

if(!$results){
    print json_encode(array("result" =>
    array("badSearch" => "No results found")));
    
} else{
    print json_encode(array("result" => $results));
}

?>