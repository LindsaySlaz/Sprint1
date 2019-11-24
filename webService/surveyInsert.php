<?php

require_once("Database/DB.class.php");

$rawData = file_get_contents("php://input");
if (is_null($rawData) || empty($rawData)){
    
    print "No input recieved.";
    exit;
}

$input = json_decode($rawData);
if (!property_exists($input,"majorChecks") 
    && !property_exists($input, "gradeRadios") 
    && !property_exists($input, "toppingRadios") 
    && !propery_exists($input, "ip")){
    print json_encode(array("result" =>
    array("ErrorMessage" => "No properties found.")));
    exit;
}

if(is_null($input->majorChecks) || empty($input->majorChecks) 
   || is_null($input->gradeRadios) || empty($input->gradeRadios) 
   || is_null($input->toppingRadios) || empty($input->toppingRadios)){
    
    print json_encode(array("result" => array("badOptionSelect" => "No option selected.")));
} else{
    $db = new DB();	    
    $safeMajor = $db->dbEsc($input->majorChecks);
    $safeGrade = $db->dbEsc($input->gradeRadios);
    $safeTopping = $db->dbEsc($input->toppingRadios);
    $ip = $input->ip;

    $insertStatement = "INSERT INTO survey (submittime, major, expectedgrade, favetopping, userip) 
    VALUES ( now(), '" . $safeMajor . "', '" . $safeGrade . "', '" . $safeTopping . "', '" . $ip . "');";

    $dbInsert = $db->dbCall($insertStatement);
    
    print json_encode(array("result" => array("success" => "Survey recorded.")));
}

?>