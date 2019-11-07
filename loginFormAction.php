<?php

session_start();
require_once("DB.class.php");

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
	
	$_SESSION['username'] = $safeUsername;
	
	$query = "SELECT group_concat(role.rolename separator ',') as roles 
			  FROM role, user, user2role
			  WHERE user.id = user2role.userid AND role.id = user2role.roleid AND user.username = '" . $_SESSION['username'] . "';";
			  
	$role = $db->dbCall($query);
	$_SESSION['role'] = '';
	
	if(strpos($role, 'admin') === true){
		$_SESSION['role'] = 'admin';
	}
	else{
		$_SESSION['role'] = "user";
	}
	
	
	
	
	header("location: index.php");	
}
