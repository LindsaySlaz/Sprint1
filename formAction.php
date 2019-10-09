<?php

require_once("Template.php");

$page = new Template("Thanks for your feedback");
$page->addHeadElement("<meta charset='utf-8'>");
$page->addHeadElement("<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>");
$page->addHeadElement("<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>");
$page->addHeadElement("<link rel='stylesheet' href='styles.css'>");
$page->addHeadElement("<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>");

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
	require_once("header.php");
	
	print	"<div class='mw-wrapper'>\n";
	print		"<h2>All fields are required.</h2>\n";
	print	"</div>\n";
	
	require_once("bsScripts.php");
	print $page->getBottomSection();
} else {
	print $page->getTopSection();
	require_once("header.php");
	
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
	print $page->getBottomSection();
}
