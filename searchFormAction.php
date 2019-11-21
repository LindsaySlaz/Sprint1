<?php

session_start();
require_once("classes/GroupTemplate.php");
require_once("DB.class.php");

$page = new GroupTemplate("Album Results");
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
	

$error = false;
if (!isset($_POST['searchField']) || empty($_POST['searchField'])) {
	$error = true;
}

if ($error) {
	// There shouldn't be an error with JS validation
	
	print	"<div class='mw-wrapper'>\n";
	print		"<h2>All fields are required.</h2>\n";
	print	"</div>\n";

} else {
    
    $data = array("apikey" => "22394232932kwhfwfe2","searchField" => $_POST['searchField']);
    $dataJson = json_encode($data);

    $contentLength = strlen($dataJson);

    $header = array(
        'Content-Type: application/json',
        'Accept: application/json',
        'Content-Length: ' . $contentLength
    );
    
    $url = "http://cnmtsrv2.uwsp.edu/~jdick723/Sprint1/webService/albumQuery.php";
    
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
    
    print 	"<div class='mw-wrapper'>\n"; 
	print		"<div class='page-header'>\n";
	print			"<h1 class='page-title'>Search Results</h1>\n";
	print		"</div>\n";
    
    if (property_exists($results,"result")) {
            if (property_exists($results,"ErrorMessage")) {
                    //If this was user-facing, a better error message would be needed.
                    print "Something went wrong: " . $results->result->ErrorMessage;
            } else {
                if (is_array($results->result)) {
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
                    print 					"<th>\n";
                    print						"Album Link\n";
                    print 					"</th>\n";
                    print 				"</tr>\n";
                    print 			"</thead>\n";
                    print 			"<tbody>\n";

                    foreach ($results as $result) {
                        foreach($result as $album){
                            print "<tr>\n";
                            foreach ($album as $key => $value) {
                                print "<td>\n";
                                if($key == "albumlink")
                                    print "<a href='$value' target='_blank'><img src='img/amazonMusic.png' width='100' height='30' /></a>";
                                else
                                    print $value;
                                print "</td>\n";
                            }    
                        }                        
                        print "</tr>\n";
                    }

                    print 			"</tbody>\n";
                    print 		"</table>\n";
                } else {
                    print	"<hr/>\n";
                    print	"<h2>" . $results->result->badSearch . "</h2>\n";
                }
            }
    } else {
            print "Something went wrong with the return, no result found";
    }

    curl_close($ch);	
	
	print	"</div>\n";

	require_once("bsScripts.php");
	print $page->createFooter();
	print $page->getBottomSection();
}
