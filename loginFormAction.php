<?php

session_start();
require_once("classes/GroupTemplate.php");

$page = new GroupTemplate("Login");
$page->addHeadElement("<meta charset='utf-8'>");
$page->addHeadElement("<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>");
$page->addHeadElement("<link rel='icon' type='image/x-icon' href='img/favicon.ico' />");
$page->addHeadElement("<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>");
$page->addHeadElement("<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>");
$page->addHeadElement("<link rel='stylesheet' href='styles/styles.css'>");

$page->finalizeTopSection();
$page->finalizeBottomSection();

$fields = array('username', 'password');
$error = false;
	
foreach($fields as $field) {
	if (!isset($_POST[$field]) || empty($_POST[$field])) {
		$error = true;
	}
}

if ($error) {
	print $page->getTopSection();
	print $page->createHeader();
	
	print	"<div class='mw-wrapper'>\n";
	print		"<h2>All fields are required.</h2>\n";
	print	"</div>\n";
	
	require_once("bsScripts.php");
	print $page->createFooter();
	print $page->getBottomSection();
} else {	
    $data = array("apikey" => "22394232932kwhfwfe2","username" => $_POST['username'],"password" => $_POST['password']);
    $dataJson = json_encode($data);
    $contentLength = strlen($dataJson);
    $header = array(
        'Content-Type: application/json',
        'Accept: application/json',
        'Content-Length: ' . $contentLength
    );
    $url = "http://cnmtsrv2.uwsp.edu/~jdick723/Sprint1/webService/loginQuery.php";
    $ch = curl_init();

    curl_setopt($ch,
        CURLOPT_URL, $url);
    curl_setopt($ch,
        CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,
        CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch,
        CURLOPT_POSTFIELDS, $dataJson);
    curl_setopt($ch,
        CURLOPT_HTTPHEADER, $header);

    $return = curl_exec($ch);

    $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpStatus != 200) {
            // Usually don't reflect httpStatus to user.
            print "Something went wrong with the request: " . $httpStatus;
            curl_close($ch);
            exit;
    }
    
    $results = json_decode($return);    
    if (!is_object($results)) {
            print "Something went wrong decoding the return";
            curl_close($ch);
            exit;
    }
    
	if (property_exists($results,"result")) {
        if (property_exists($results,"ErrorMessage")) {                    
            print "Something went wrong: " . $results->result->ErrorMessage;
        } else {
            if(is_array($results->result)){
                $_SESSION['error'] = "";
                            
                if(password_verify($_POST['password'], $results->result[0]->userpass)) {
                    $_SESSION['isLoggedIn'] = true;
                    $_SESSION['username'] = $results->result[0]->username;
                    $_SESSION['name'] = $results->result[0]->realname;
                    $_SESSION['email'] = $results->result[0]->email;
                    $_SESSION['role'] = $results->result[0]->rolename;
                    header("location: index.php");	
                    exit;
                }
                else {
                    header("location: login.php");
                    $_SESSION['error'] = "Invalid username or password.";
                    exit;                    
                }	
            } else {
                header("location: login.php");
                $_SESSION['error'] = $results->result->badLogin;
                exit;                   
            }
        }
    } else {
        print "Something went wrong with the return, no result found";
    }
}
