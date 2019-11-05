<?php

session_start();
require_once("groupTemplate.php");

$page = new GroupTemplate("Survey");
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
print			"<h1 class='page-title'>Survey</h1>\n";
print			"<hr>\n";
print			"<p class='required'>All fields are required.</p>\n";
print		"</div>\n";
print		"<form id='surveyForm' method='POST' action='formAction.php'>\n";
print			"<div class='form-section'>\n";
print				"<div class='form-group'>\n";
print					"<label class='form-label' for='email'>Your Email</label>\n";
print					"<input type='email' class='form-control' id='email' name='email'>\n";
print				"</div>\n";
print				"<div class='form-label' id='major'>\n";
print					"What is your major?\n";
print				"</div>\n";
print				"<div class='form-check'>\n";
print					"<input class='form-check-input' type='checkbox' value='CIS-AppDev' id='major1' name='majorChecks'>\n";
print					"<label class='form-check-label' for='major1'>\n";
print						"CIS-AppDev\n";
print					"</label>\n";
print				"</div>\n";
print				"<div class='form-check'>\n";
print					"<input class='form-check-input' type='checkbox' value='CIS-Networking' id='major2' name='majorChecks'>\n";
print					"<label class='form-check-label' for='major2'>\n";
print						"CIS-Networking\n";
print					"</label>\n";
print				"</div>\n";
print				"<div class='form-check'>\n";
print					"<input class='form-check-input' type='checkbox' value='WDMD' id='major3' name='majorChecks'>\n";
print					"<label class='form-check-label' for='major3'>\n";
print						"WDMD\n";
print					"</label>\n";
print				"</div>\n";
print				"<div class='form-check'>\n";
print					"<input class='form-check-input' type='checkbox' value='WD' id='major4' name='majorChecks'>\n";
print					"<label class='form-check-label' for='major4'>\n";
print						"WD\n";
print					"</label>\n";
print				"</div>\n";
print				"<div class='form-check'>\n";
print					"<input class='form-check-input' type='checkbox' value='HTI' id='major5' name='majorChecks'>\n";
print					"<label class='form-check-label' for='major5'>\n";
print						"HTI\n";
print					"</label>\n";
print				"</div>\n";
print				"<div class='form-check'>\n";
print					"<input class='form-check-input' type='checkbox' value='Other' id='major6' name='majorChecks'>\n";
print					"<label class='form-check-label' for='major6'>\n";
print						"Other\n";
print					"</label>\n";
print				"</div>\n";
print			"</div>\n";
print			"<div class='form-section'>\n";
print				"<div class='form-label' id='grade'>\n";
print					"What grade do you expect to receive in CNMT 310?\n";
print				"</div>\n";
print				"<div class='form-check'>\n";
print					"<input class='form-check-input' type='radio' name='gradeRadios' id='gradeA' value='A' checked>\n";
print					"<label class='form-check-label' for='gradeA'>\n";
print						"A\n";
print					"</label>\n";
print				"</div>\n";
print				"<div class='form-check'>\n";
print					"<input class='form-check-input' type='radio' name='gradeRadios' id='gradeB' value='B'>\n";
print					"<label class='form-check-label' for='gradeB'>\n";
print						"B\n";
print					"</label>\n";
print				"</div>\n";
print				"<div class='form-check'>\n";
print					"<input class='form-check-input' type='radio' name='gradeRadios' id='gradeC' value='C'>\n";
print					"<label class='form-check-label' for='gradeC'>\n";
print						"C\n";
print					"</label>\n";
print				"</div>\n";
print				"<div class='form-check'>\n";
print					"<input class='form-check-input' type='radio' name='gradeRadios' id='gradeD' value='D'>\n";
print					"<label class='form-check-label' for='gradeD'>\n";
print						"D\n";
print					"</label>\n";
print				"</div>\n";
print				"<div class='form-check'>\n";
print					"<input class='form-check-input' type='radio' name='gradeRadios' id='gradeF' value='F'>\n";
print					"<label class='form-check-label' for='gradeF'>\n";
print						"F\n";
print					"</label>\n";
print				"</div>\n";
print			"</div>\n";
print			"<div class='form-section'>\n";
print				"<div class='form-label' id='toppings'>\n";
print					"What is your favorite pizza topping?\n";
print				"</div>\n";
print				"<div class='form-check'>\n";
print					"<input class='form-check-input' type='radio' name='toppingRadios' id='topping1' value='cheese' checked>\n";
print					"<label class='form-check-label' for='topping1'>\n";
print						"Cheese\n";
print					"</label>\n";
print				"</div>\n";
print				"<div class='form-check'>\n";
print					"<input class='form-check-input' type='radio' name='toppingRadios' id='topping2' value='pepperoni'>\n";
print					"<label class='form-check-label' for='topping2'>\n";
print						"Pepperoni\n";
print					"</label>\n";
print				"</div>\n";
print				"<div class='form-check'>\n";
print					"<input class='form-check-input' type='radio' name='toppingRadios' id='topping3' value='mushrooms'>\n";
print					"<label class='form-check-label' for='topping3'>\n";
print						"Mushrooms\n";
print					"</label>\n";
print				"</div>\n";
print				"<div class='form-check'>\n";
print					"<input class='form-check-input' type='radio' name='toppingRadios' id='topping4' value='pineapple'>\n";
print					"<label class='form-check-label' for='topping4'>\n";
print						"Pineapple\n";
print					"</label>\n";
print				"</div>\n";
print				"<div class='form-check'>\n";
print					"<input class='form-check-input' type='radio' name='toppingRadios' id='topping5' value='olives'>\n";
print					"<label class='form-check-label' for='topping5'>\n";
print						"Olives\n";
print					"</label>\n";
print				"</div>\n";
print			"</div>\n";
print			"<button id='submitBtn' type='submit' class='btn btn-primary' disabled>Submit</button>\n";
print		"</form>\n";
print	"</div>\n";
print    "<script src='js/validation.js'></script>\n";

require_once("bsScripts.php");
print $page->createFooter();
print $page->getBottomSection();