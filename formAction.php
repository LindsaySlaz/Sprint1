<?php

require_once("groupTemplate.php");
require_once("DB.class.php");

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
	// There shouldn't be an error with JS validation
	print $page->getTopSection();
	print $page->createHeader();
	
	print	"<div class='mw-wrapper'>\n";
	print		"<h2>All fields are required.</h2>\n";
	print	"</div>\n";
	
	require_once("bsScripts.php");
	print $page->createFooter();
	print $page->getBottomSection();
} else {
	$db = new DB();
	
	//User ip
	$ip = $_SERVER['REMOTE_ADDR'];

	//Sanitize input
	$safeMajor = $db->dbEsc($_POST['majorChecks']);
	$safeGrade = $db->dbEsc($_POST['gradeRadios']);
	$safeTopping = $db->dbEsc($_POST['toppingRadios']);
	
	$insertStatement = "INSERT INTO survey (submittime, major, expectedgrade, favetopping, userip) 
	VALUES ( now(), '" . $safeMajor . "', '" . $safeGrade . "', '" . $safeTopping . "', '" . $ip . "');";
	
	$dbInsert = $db->dbCall($insertStatement);
	
	print $page->getTopSection();
	print $page->createHeader();
	
	print	"<div class='mw-wrapper'>\n";
	print		"<div class='flex center home-cards'>\n";
	print			"<div class='card text-center'>\n";
	print				"<div class='card-body'>\n";
	print					"<h2>Thank you for your feedback &#128513;</h2>\n";
	print				"</div>\n";
	print			"</div>\n";
	print		"</div>\n";
	print	"</div>\n";

	require_once("bsScripts.php");
	print $page->createFooter();
	print $page->getBottomSection();
}
