<?php

session_start();
require_once("classes/GroupTemplate.php");

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
    
	$data = array("apikey" => "22394232932kwhfwfe2");
    $dataJson = json_encode($data);

    $contentLength = strlen($dataJson);

    $header = array(
        'Content-Type: application/json',
        'Accept: application/json',
        'Content-Length: ' . $contentLength
    );
    
    $url = "http://cnmtsrv2.uwsp.edu/~jdick723/Sprint1/webService/surveyQuery.php";
    
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
	
	print $page->getTopSection();
	print $page->createHeader();
	
    if (property_exists($results,"result")) {
            if (property_exists($results,"ErrorMessage")) {
                print "Something went wrong: " . $results->result->ErrorMessage;
            } elseif(property_exists($results, "badSearch")) {
                print	"<h2>" . $results->result->badSearch . "</h2>\n";
                    
            } else{
                if(is_array($results->result)){
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

                    foreach($results as $result)
                     foreach ($result as $survey) {
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
                } else{
                    print	"<h2>" . $results->result->badSearch . "</h2>\n";
                }
                
            }
    } else {
            print "Something went wrong with the return, no result found";
    }	

} else {
	print	"<hr/>\n";
	print	"<h2>Please log in as an administrator to view survey data.</h2>\n";
}

print	"</div>\n";

require_once("bsScripts.php");
print $page->createFooter();
print $page->getBottomSection();

