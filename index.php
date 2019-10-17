<?php

require_once("Template.php");

$page = new Template("Home Page");
$page->addHeadElement("<meta charset='utf-8'>");
$page->addHeadElement("<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>");
$page->addHeadElement("<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>");
$page->addHeadElement("<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>");
$page->addHeadElement("<link rel='stylesheet' href='styles/styles.css'>");

$page->finalizeTopSection();
$page->finalizeBottomSection();

print $page->getTopSection();
require_once("header.php");

print	"<div class='mw-wrapper'>\n";
print		"<div class='flex center home-cards'>\n";
print			"<div class='card text-center'>\n";
print				"<div class='card-body'>\n";
print					"<a href='albumSearch.php'>ALBUM<br/>SEARCH</a>\n";
print				"</div>\n";
print			"</div>\n";
print			"<div class='card text-center'>\n";
print				"<div class='card-body'>\n";
print					"<a href='survey.php'>SURVEY</a>\n";
print				"</div>\n";
print			"</div>\n";
print			"<div class='card text-center'>\n";
print				"<div class='card-body'>\n";
print					"<a href='privacy.php'>PRIVACY<br/>POLICY</a>\n";
print				"</div>\n";
print			"</div>\n";
print		"</div>\n";
print	"</div>\n";

require_once("bsScripts.php");
print $page->getBottomSection();