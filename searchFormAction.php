<?php

require_once("Template.php");
require_once("DB.class.php");

$page = new Template("Album Results");
$page->addHeadElement("<meta charset='utf-8'>");
$page->addHeadElement("<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>");
$page->addHeadElement("<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>");
$page->addHeadElement("<link rel='stylesheet' href='styles/styles.css'>");
$page->addHeadElement("<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>");

$page->finalizeTopSection();
$page->finalizeBottomSection();

$error = false;
if (!isset($_POST['searchField']) || empty($_POST['searchField'])) {
	$error = true;
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
	$db = new DB();
	
	print $page->getTopSection();
	require_once("header.php");
	
	print 	"<div class='mw-wrapper'>\n"; 
	print		"<div class='page-header'>\n";
	print			"<h1 class='page-title'>Search Results</h1>\n";
	print		"</div>\n";	
	
	$query = "SELECT albumtitle, albumartist, albumlength 
			  FROM album
			  WHERE albumtitle = '" . $_POST['searchField'] . "' OR albumartist = '" . $_POST['searchField'] . "';";
	
	$results = $db->dbCall($query);
	if ($results) {
		print 		"<table class='table'>\n";
		print 			"<thead>\n";
		print 				"<tr>\n";
		print 					"<th>\n";
		print						"Album Title\n";
		print 					"</th>\n";
		print 					"<th>\n";
		print						"Album Artist\n";
		print 					"</th>\n";
		print 					"<th>\n";
		print						"Album Length\n";
		print 					"</th>\n";
		print 				"</tr>\n";
		print 			"</thead>\n";
		print 			"<tbody>\n";
		
		// Loop through all the results names here
		// foreach ($results as $album) {
		// 		print "<tr>\n";
		//		foreach ($album as $key) {
		// 			print "<td>\n";
		//			$album[$key];
		//			print "</td>\n";
		//}
		//		print "</tr>\n";
		// }

		print 			"</tbody>\n";
		print 		"</table>\n";
	} else {
		print	"<hr/>\n";
		print	"<h2>No results found.</h2>\n";
	}
	
	print	"</div>\n";

	require_once("bsScripts.php");
	print $page->getBottomSection();
}
