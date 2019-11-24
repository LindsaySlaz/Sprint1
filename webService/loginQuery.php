<?php

require_once("Database/DB.class.php");

$rawData = file_get_contents("php://input");

if (is_null($rawData) || empty($rawData)){
    
    print "No input recieved.";
    exit;
}

$input = json_decode($rawData);

if (!property_exists($input,"username") && !property_exists($input,"password")){
    print json_encode(array("result" =>
    array("ErrorMessage" => "No query detected")));
    exit;
}

$db = new DB();
$safeUsername = $db->dbEsc($input->username);
$safePassword = $db->dbEsc($input->password);
$query = "SELECT u.username, u.userpass, u.realname, u.email, r.rolename
    FROM user u
    JOIN user2role o ON u.id=o.id
    JOIN role r ON o.id=r.id
    WHERE u.username = '" . $safeUsername . "'";

$results = $db->dbCall($query);

if(!$results){
    print json_encode(array("result" => array("badLogin" => "Invalid username or password.")));
    
} else{
    print json_encode(array("result" => $results));
}

?>