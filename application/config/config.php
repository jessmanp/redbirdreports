<?php

/**
 * Configuration
 *
 * For more info about constants please @see http://php.net/manual/en/function.define.php
 * If you want to know why we use "define" instead of "const" @see http://stackoverflow.com/q/2447791/1114320
 */

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Configuration for: Project URL
 * Put your URL here, for local development "127.0.0.1" or "localhost" (plus sub-folder) is fine
 */
define('URL', 'http://dev.redbirdreports.com/');

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define("DB_NAME", "redbirdreports");
define("DB_USER", "redbird-app");
define("DB_PASS", "r3db1rdR3ports");

/*
 * This constant will be used in the login, setup and the registration classes.
 */
define("HASH_COST_FACTOR", "10");

/**
 * LIVE Configuration for: Email server credentials
*/
define("EMAIL_USE_SMTP", true);
define("EMAIL_SMTP_HOST", "ssl://smtp.zoho.com");
define("EMAIL_SMTP_AUTH", true);
define("EMAIL_SMTP_USERNAME", "support@redbirdreports.com");
define("EMAIL_SMTP_PASSWORD", "FlappyB1rd");
define("EMAIL_SMTP_PORT", 465);
define("EMAIL_SMTP_ENCRYPTION", "ssl");

/**
 * Configuration for: verification email data
 * Set the absolute URL to register.php, necessary for email verification links
 */
define("EMAIL_VERIFICATION_URL", "http://dev.redbirdreports.com/login/?register=invite");
define("EMAIL_VERIFICATION_FROM", "support@redbirdreports.com");
define("EMAIL_VERIFICATION_FROM_NAME", "Red Bird Reports");
define("EMAIL_VERIFICATION_SUBJECT", "Account activation for Red Bird Reports");
define("EMAIL_VERIFICATION_CONTENT", "Please click on this link to activate your account:");

/**
 * FILES Configuration for: Control D Upload
*/
define("FILE_UPLOAD_PATH", "/var/www/html/dev.redbirdreports.com/files/");

