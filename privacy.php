<?php

session_start();
require_once("groupTemplate.php");

$page = new GroupTemplate("Privacy Policy");
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

print	"<div class='privacy-policy mw-wrapper'>\n";
print		"<article>\n";
print			"<div class='page-header'>\n";
print				"<h1 class='page-title'>Privacy Policy</h1>\n";
print				"<hr>\n";
print			"</div>\n";
print			"<div class='pp-content'>\n";
print				"<p>The University of Wisconsin System Administration (UWSA) recognizes the importance of protecting the privacy of information provided to us.</p>\n";
print				"<h2>Personal information</h2>\n";
print				"<p>We will use personal information that you provide via e-mail or through other online means only for purposes necessary to serve your needs, such as responding to an inquiry or other request for information. This may involve redirecting your inquiry or comment to another person or department better suited to meeting your needs.</p>\n";
print				"<p>Some webpages at UWSA may collect personal information about visitors and use that information for purposes other than those stated above. Each webpage that collects information will have a separate privacy statement that will tell you how that information is used.</p>\n";
print				"<h2>Collected Information</h2>\n";
print				"<p>UWSA monitors network traffic for the purposes of site management and security. We use this information to help diagnose problems and carry out other administrative tasks. We also use statistic information to determine which information is of most interest to users, to identify system problem areas, or to help determine technical requirements. The server log information does not include personal information.</p>\n";
print				"<h2>External websites</h2>\n";
print				"<p>This site contains links to other sites outside of UWSA. UWSA is not responsible for the privacy practices or the content of such websites.</p>\n";
print				"<h2>Questions</h2>\n";
print				"<p>If you have any questions about this privacy statement, the practices of this site, or your use of this website, please contact&nbsp;<a href='mailto:webteam@uwsa.edu'>Webmaster</a>.</p>\n";
print			"</div>\n";
print		"</article>\n";
print	"</div>\n";

require_once("bsScripts.php");
print $page->createFooter();
print $page->getBottomSection();
