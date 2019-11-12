<?php

session_start();
require_once("classes/GroupTemplate.php");

$page = new GroupTemplate("My Account");
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
print			"<h1 class='page-title'>My Account</h1>\n";
print			"<hr>\n";
print		"</div>\n";

if(isset($_SESSION['isLoggedIn'])) {
	if (isset($_SESSION['name'], $_SESSION['email'], $_SESSION['username'], $_SESSION['role'])) {
		print		"<form id='accountForm'>\n";
		print			"<div class='form-section'>\n";
		print				"<div class='form-group'>\n";
		print					"<label class='form-label' for='realname'>Name</label>\n";
		print					"<input type='text' class='form-control' id='realname' name='realname' placeholder='" . $_SESSION['name'] . "' readonly>\n";
		print				"</div>\n";
		print				"<div class='form-group'>\n";
		print					"<label class='form-label' for='email'>Email</label>\n";
		print					"<input type='email' class='form-control' id='email' name='email' placeholder='" . $_SESSION['email'] . "' readonly>\n";
		print				"</div>\n";
		print				"<div class='form-group'>\n";
		print					"<label class='form-label' for='username'>Username</label>\n";
		print					"<input type='text' class='form-control' id='username' name='username' placeholder='" . $_SESSION['username'] . "' readonly>\n";
		print				"</div>\n";
		print				"<div class='form-group'>\n";
		print					"<label class='form-label' for='role'>Role</label>\n";
		print					"<input type='text' class='form-control' id='role' name='role' placeholder='" . $_SESSION['role'] . "' readonly>\n";
		print				"</div>\n";
		print			"</div>\n";
		print		"</form>\n";
	} else {
		print	"<h2>No account details found.</h2>\n";
	}
} else {
	print	"<hr/>\n";
	print	"<h2>Please log in to view your account information.</h2>\n";
}

print	"</div>\n";

require_once("bsScripts.php");
print $page->createFooter();
print $page->getBottomSection();

