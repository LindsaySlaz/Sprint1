<?php

session_start();
require_once("groupTemplate.php");

$page = new GroupTemplate("Home Page");
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

print	"<div class='survey mw-wrapper'>\n";
print		"<div class='page-header'>\n";
print			"<h1 class='page-title'>Album Search</h1>\n";
print			"<hr>\n";
print		"</div>\n";
print		"<form id='searchForm' method='POST' action='searchFormAction.php'>\n";
print			"<div class='form-section'>\n";
print				"<div class='form-group search'>\n";
print					"<input type='text' class='form-control' id='searchField' name='searchField' placeholder='Enter an Album Title or Artist'>\n";
print					"<span class='material-icons'>search</span>\n";
print				"</div>\n";
print			"</div>\n";
print			"<button id='searchSubmit' type='submit' class='btn btn-primary' disabled>Submit</button>\n";
print		"</form>\n";
print	"</div>\n";
print    "<script src='js/validation.js'></script>\n";

require_once("bsScripts.php");
print $page->createFooter();
print $page->getBottomSection();