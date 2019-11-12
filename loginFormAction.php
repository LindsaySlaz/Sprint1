<?php

session_start();
require_once("classes/GroupTemplate.php");
require_once("DB.class.php");

$page = new GroupTemplate("Login");
$page->addHeadElement("<meta charset='utf-8'>");
$page->addHeadElement("<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>");
$page->addHeadElement("<link rel='icon' type='image/x-icon' href='img/favicon.ico' />");
$page->addHeadElement("<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>");
$page->addHeadElement("<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>");
$page->addHeadElement("<link rel='stylesheet' href='styles/styles.css'>");

$page->finalizeTopSection();
$page->finalizeBottomSection();

// Required field names
$fields = array('username', 'password');
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
	$safeUsername = $db->dbEsc($_POST['username']);
	$safePassword = $db->dbEsc($_POST['password']);
	$query = "SELECT u.username, u.userpass, u.realname, u.email, r.rolename
		FROM user u
		JOIN user2role o ON u.id=o.id
		JOIN role r ON o.id=r.id
		WHERE u.username = '" . $safeUsername . "'";
	$results = $db->dbCall($query);
	
	if($results) {
		$_SESSION['error'] = "";
		if(password_verify($safePassword, $results[0]["userpass"])) {
			$_SESSION['isLoggedIn'] = true;
			$_SESSION['username'] = $results[0]["username"];
			$_SESSION['name'] = $results[0]["realname"];
			$_SESSION['email'] = $results[0]["email"];
			$_SESSION['role'] = $results[0]["rolename"];
			header("location: index.php");	
			exit;
		}
		else {
			header("location: login.php");
			exit;
		}	
	} else {
		header("location: login.php");
		$_SESSION['error'] = "Invalid username or password";
		exit;
	}
	
}
