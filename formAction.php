<?php

session_start();
require_once("classes/GroupTemplate.php");

$page = new GroupTemplate("Thanks for your feedback");
$page->addHeadElement("<meta charset='utf-8'>");
$page->addHeadElement("<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>");
$page->addHeadElement("<link rel='icon' type='image/x-icon' href='img/favicon.ico' />");
$page->addHeadElement("<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>");
$page->addHeadElement("<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>");
$page->addHeadElement("<link rel='stylesheet' href='styles/styles.css'>");

$page->finalizeTopSection();
$page->finalizeBottomSection();

// Required field names
$fields = array('email', 'majorChecks', 'gradeRadios', 'toppingRadios');
$error = false;
	
foreach($fields as $field) {
	if (!isset($_POST[$field]) || empty($_POST[$field])) {
		$error = true;
	}
}

if ($error) {
	print $page->getTopSection();
	print $page->createHeader();
	
	print	"<div class='mw-wrapper'>\n";
	print		"<h2>All fields are required.</h2>\n";
	print	"</div>\n";
	
	require_once("bsScripts.php");
	print $page->createFooter();
	print $page->getBottomSection();
} else {
    $data = array("apikey" => "22394232932kwhfwfe2","majorChecks" => $_POST['majorChecks'], "gradeRadios" => $_POST['gradeRadios'], "toppingRadios" => $_POST['toppingRadios'], "ip" => $_SERVER['REMOTE_ADDR']);
    $dataJson = json_encode($data);
    $contentLength = strlen($dataJson);
    $header = array(
        'Content-Type: application/json',
        'Accept: application/json',
        'Content-Length: ' . $contentLength
    );
    $url = "http://cnmtsrv2.uwsp.edu/~jdick723/Sprint1/webService/surveyInsert.php";
    $ch = curl_init();

    curl_setopt($ch,
        CURLOPT_URL, $url);
    curl_setopt($ch,
        CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,
        CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch,
        CURLOPT_POSTFIELDS, $dataJson);
    curl_setopt($ch,
        CURLOPT_HTTPHEADER, $header);

    $return = curl_exec($ch);

    $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpStatus != 200) {
            // Usually don't reflect httpStatus to user.
            print "Something went wrong with the request: " . $httpStatus;
            curl_close($ch);
            exit;
    }
    
    $results = json_decode($return);
    if (!is_object($results)) {
            print "Something went wrong decoding the return";
            curl_close($ch);
            exit;
    }
	
	print $page->getTopSection();
	print $page->createHeader();
	
    if (property_exists($results,"result")) {
            if (property_exists($results->result,"ErrorMessage")) {
                print "Something went wrong: " . $results->result->ErrorMessage;
            } elseif(property_exists($results->result, "badOptionSelect")) {
                print	"<h2>" . $results->result->badOptionSelect . "</h2>\n";
                    
            } elseif(property_exists($results->result, "success")){
                print	"<div class='mw-wrapper'>\n";
                print		"<div class='flex center home-cards'>\n";
                print			"<div class='card text-center'>\n";
                print				"<div class='card-body'>\n";
                print					"<h2>Thank you for your feedback &#128513;</h2>\n";
                print				"</div>\n";
                print			"</div>\n";
                print		"</div>\n";
                print	"</div>\n";
                
            }
    } else {
            print "Something went wrong with the return, no result found";
    }
	

	require_once("bsScripts.php");
	print $page->createFooter();
	print $page->getBottomSection();
}
