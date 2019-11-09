<?php

session_start();
require_once("groupTemplate.php");
require_once("DB.class.php");

$page = new GroupTemplate("Survey Data");
$page->addHeadElement("<meta charset='utf-8'>");
$page->addHeadElement("<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>");
$page->addHeadElement("<link rel='icon' type='image/x-icon' href='img/favicon.ico' />");
$page->addHeadElement("<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>");
$page->addHeadElement("<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>");
$page->addHeadElement("<link rel='stylesheet' href='styles/styles.css'>");

$page->finalizeTopSection();
$page->finalizeBottomSection();

print $page->getTopSection();
print $page->createHeader();

print 	"<div class='mw-wrapper'>\n"; 
print		"<div class='page-header'>\n";
print			"<h1 class='page-title'>Survey Data</h1>\n";
print		"</div>\n";

if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
	$db = new DB();
	$query = "SELECT major, expectedgrade, favetopping
		  FROM survey;";

	$results = $db->dbCall($query);	
	
	if ($results) {
		print 		"<table class='table'>\n";
		print 			"<thead>\n";
		print 				"<tr>\n";
		print 					"<th>\n";
		print						"Major\n";
		print 					"</th>\n";
		print 					"<th>\n";
		print						"Expected Grade\n";
		print 					"</th>\n";
		print 					"<th>\n";
		print						"Favorite Topping\n";
		print 					"</th>\n";
		print 				"</tr>\n";
		print 			"</thead>\n";
		print 			"<tbody>\n";
		
		 foreach ($results as $survey) {
			 print "<tr>\n";
			 foreach ($survey as $key => $value) {
				 print "<td>\n";
				 print $value;
				 print "</td>\n";
			 }
			 print "</tr>\n";
		 }

		print 			"</tbody>\n";
		print 		"</table>\n";
	} else {
		print	"<hr/>\n";
		print	"<h2>No surveys found.</h2>\n";
	}
} else {
	print	"<hr/>\n";
	print	"<h2>Please log in as an administrator to view survey data.</h2>\n";
}

print	"</div>\n";

require_once("bsScripts.php");
print $page->createFooter();
print $page->getBottomSection();

