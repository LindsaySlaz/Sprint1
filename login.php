<?php

session_start();
require_once("classes/GroupTemplate.php");

$page = new GroupTemplate("Log In");
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

print	"<div class='mw-wrapper'>\n";
print		"<div class='flex center login'>\n";
print			"<div class='card text-center'>\n";
print				"<div class='card-header'>\n";
print					"<h4 class='mb-0'>LOGIN</h4>\n";
print				"</div>\n";
print				"<div class='card-body mt-4'>\n";
print					"<form id='loginForm' method='POST' action='loginFormAction.php'>\n";
print						"<div class='form-section'>\n";
print							"<div class='form-group'>\n";
print								"<input type='text' class='form-control' id='username' name='username' placeholder='Username'>\n";
print								"<input type='password' class='form-control' id='password' name='password' placeholder='**********'>\n";
print							"</div>\n";
print						"</div>\n";
if (isset($_SESSION['error'])) {
	print 					"<div class='login-error text-left'>\n";
	print						"<i>" . $_SESSION['error'] . "</i>\n";
	print 					"</div>\n";
}
print						"<button id='loginSubmit' type='submit' class='btn btn-primary mt-1' disabled>Log In</button>\n";
print					"</form>\n";
print				"</div>\n";
print			"</div>\n";
print		"</div>\n";
print	"</div>\n";
print   "<script src='js/validation.js'></script>\n";

require_once("bsScripts.php");
print $page->createFooter();
print $page->getBottomSection();