<?php

/**
 * A simple PHP Login Script / ADVANCED VERSION
 * For more versions (one-file, minimal, framework-like) visit http://www.php-login.net
 *
 * @author Panique
 * @link http://www.php-login.net
 * @link https://github.com/panique/php-login-advanced/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// check for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('libraries/password_compatibility_library.php');
}

// include the config
require_once('config/config.php');

// include the to-be-used language, english by default. feel free to translate your project and include something else
require_once('translations/en.php');

// include the PHPMailer library
require_once('libraries/PHPMailer.php');

// load the registration class
require_once('classes/Registration.php');

// create the registration object. when this object is created, it will do all registration stuff automatically
// so this single line handles the entire registration process.
$registration = new Registration();

// load the login class
require_once('classes/Login.php');

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

if (isset($_GET['register'])) {

	// ... check if we are new and verified
	if ($registration->verification_successful == true) {
		// the user is verified pass to setup screen
		header("location: /home/setup");
	} else {
		// load registeration form
		include("views/register.php");	
	}

// check if we are logged in
} else if ($login->isUserLoggedIn() == true) {

    // the user is logged in
	if (isset($_GET['edit'])) {
		$user = $login->getUserInfo();
    		include("views/edit.php");
	} else {
		header("location: /app/dashboard");
	}

} else if (isset($_GET['reset'])) {

	// load reset password form
	include("views/password_reset.php");

} else {

	// pass potential errors / feedback (from login object) via session variables

    if ($login->errors) {
		$_SESSION['login_errors'] = $login->errors;
    }
    if ($login->messages) {
		$_SESSION['login_messages'] = $login->messages;
    }

    // the user is not logged in show login form
	header("location: /");
}
