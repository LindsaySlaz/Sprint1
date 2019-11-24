<?php

require_once("DB.class.php");

$rawData = file_get_contents("php://input");

if (is_null($rawData) || empty($rawData)){
    
    print "No input recieved.";
    exit;
}

$input = json_decode($rawData);

$db = new DB();
$query = "SELECT major, expectedgrade, favetopping
		  FROM survey";

$results = $db->dbCall($query);	

if(!$results){
    print json_encode(array("result" =>
    array("badSearch" => "No results found.")));
    
} else{
    print json_encode(array("result" => $results));
}

?>