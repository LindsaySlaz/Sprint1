<?php

session_start();
require_once("Template.php");

Class GroupTemplate extends Template {

	public function createHeader() {

		$html =   "<nav class='navbar navbar-expand-lg'>\n";
		$html .=           "<a class='navbar-brand' href='index.php'>Home</a>\n";
		$html .=           "<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarToggler'>\n";
		$html .=                   "<i class='material-icons'>menu</i>\n";
		$html .=           "</button>\n";

		$html .=           "<div class='collapse navbar-collapse' id='navbarToggler'>\n";
		$html .=                   "<ul class='navbar-nav ml-auto mt-2 mt-lg-0'>\n";
		$html .=                           "<li class='nav-item'>\n";
		$html .=                                   "<a class='nav-link' href='albumSearch.php'>Album Search</a>\n";
		$html .=                           "</li>\n";
		$html .=                           "<li class='nav-item'>\n";
		$html .=                                   "<a class='nav-link' href='survey.php'>Survey</a>\n";
		$html .=                           "</li>\n";
		
		if(!isset($_SESSION['username'])) {
			$html .=                       "<li class='nav-item'>\n";
			$html .=                               "<a class='nav-link' href='login.php'>Log In</a>\n";
			$html .=                       "</li>\n";
		}

		$html .=                   "</ul>\n";
		$html .=           "</div>\n";
		$html .=   "</nav>\n";
		$html .=   "<main>\n";
		
		return $html;
	}
	
	public function createFooter() {
		$html =   "</main>\n";
		$html .=  "<footer class='footer'>\n";
		$html .=      "<div class='text-center pt-4'>\n";
		$html .=   	      "<a href='privacy.php'>Privacy Policy</a>\n";
		$html .=   	      "<p>&copy;" . date("Y") . " Group Four.</p>\n";
		$html .=   	  "</div>\n";
		$html .=   "</footer>\n";
		
		return $html;
	}

}
