<?php

/**
 * Please note: we can use unencoded characters like ö, é etc here as we use the html5 doctype with utf8 encoding
 * in the application's header (in views/_header.php). To add new languages simply copy this file,
 * and create a language switch in your root files.
 */

// login & registration classes
define("MESSAGE_ACCOUNT_NOT_ACTIVATED", "Your account is not activated yet. Please click on the confirmation link your received in your mail.");
define("MESSAGE_CAPTCHA_WRONG", "Captcha was wrong! Please try again.");
define("MESSAGE_COOKIE_INVALID", "ERROR: Invalid cookie. Please email us so that we may further assist you.");
define("MESSAGE_DATABASE_ERROR", "ERROR: Database connection problem. Please email us so that we may further assist you.");
define("MESSAGE_EMAIL_ALREADY_EXISTS", "Sorry, that email address is already registered. Please use the &quot;Reset Password&quot; page if you don&rsquo;t remember your password.");
define("MESSAGE_EMAIL_CHANGE_FAILED", "Sorry, the attempt to update your email failed.");
define("MESSAGE_EMAIL_CHANGED_SUCCESSFULLY", "Success, Your email address has been changed successfully. The new email address is: ");
define("MESSAGE_EMAIL_EMPTY", "Sorry, the email field cannot be empty.");
define("MESSAGE_EMAIL_NO_MATCH", "Sorry, the email address does not match. Please verify the email address and enter it again.");
define("MESSAGE_EMAIL_INVALID", "Your email address is not in a valid email format.");
define("MESSAGE_EMAIL_SAME_LIKE_OLD_ONE", "Sorry, that email address is the same as your current one. Please choose another one.");
define("MESSAGE_EMAIL_TOO_LONG", "Sorry, the email address cannot be longer than 64 characters");
define("MESSAGE_LINK_PARAMETER_EMPTY", "ERROR: Empty link parameter data. Please email us so that we may further assist you.");
define("MESSAGE_LOGGED_OUT", "You have been logged out.");
define("MESSAGE_LOGIN_FAILED", "Login failed. The information you entered was incorrect. Please use the &quot;Reset Password&quot; page if you don&rsquo;t remember your password.");
define("MESSAGE_OLD_PASSWORD_WRONG", "Sorry, your OLD password was wrong.");
define("MESSAGE_PASSWORD_BAD_CONFIRM", "Sorry, password and password repeat are not the same.");
define("MESSAGE_PASSWORD_CHANGE_FAILED", "Sorry, the attempt to update your password failed.");
define("MESSAGE_PASSWORD_CHANGED_SUCCESSFULLY", "Success, password successfully changed!");
define("MESSAGE_PASSWORD_EMPTY", "Password field was empty");
define("MESSAGE_PASSWORD_RESET_MAIL_FAILED", "Sorry, your password reset email was NOT successfully sent! Error: ");
define("MESSAGE_PASSWORD_RESET_MAIL_SUCCESSFULLY_SENT", "Success, your password reset email was successfully sent!");
define("MESSAGE_PASSWORD_TOO_SHORT", "Sorry, the password must be a minimum length of 6 characters.");
define("MESSAGE_PASSWORD_WRONG", "Sorry, wrong password. Please try again.");
define("MESSAGE_PASSWORD_WRONG_3_TIMES", "Sorry, you have entered an incorrect password 3 or more times. Please wait 30 seconds to try again.");
define("MESSAGE_REGISTRATION_ACTIVATION_NOT_SUCCESSFUL", "ERROR: No such id/verification code combination. Please email us so that we may further assist you.");
define("MESSAGE_REGISTRATION_ACTIVATION_SUCCESSFUL", "Activation was successful! You can now log in!");
define("MESSAGE_REGISTRATION_FAILED", "Sorry, your registration failed. Please go back and try again.");
define("MESSAGE_RESET_LINK_HAS_EXPIRED", "Your reset link has expired. Please use the reset link within one hour.");
define("MESSAGE_VERIFICATION_MAIL_ERROR", "Sorry, we could not send you an verification mail. Your account has NOT been created.");
define("MESSAGE_VERIFICATION_MAIL_NOT_SENT", "Sorry, your verification email was NOT successfully sent! Error: ");
define("MESSAGE_VERIFICATION_MAIL_SENT", "Your account has been created successfully and we have sent you an email. Please click the VERIFICATION LINK within that email to continue.");
define("MESSAGE_USER_DOES_NOT_EXIST", "Sorry, the username you entered does not exist. If you do not remember your username please email us so that we may further assist you.");
define("MESSAGE_USERNAME_BAD_LENGTH", "Sorry, username cannot be shorter than 2 characters or longer than 64 characters.");
define("MESSAGE_USERNAME_CHANGE_FAILED", "Sorry, the attempt to update your username failed.");
define("MESSAGE_USERNAME_CHANGED_SUCCESSFULLY", "Your username has been changed successfully. Your new username is: ");
define("MESSAGE_USERNAME_EMPTY", "Sorry, the username field was empty. Please enter a username.");
define("MESSAGE_USERNAME_EXISTS", "Sorry, that username is already taken. Please choose a different username.");
define("MESSAGE_USERNAME_INVALID", "Sorry, that username does not fit our requirements. Only Letters A-Z (upper or lower case) and numbers are allowed, and it must be at least 2 characters to 64 characters long.");
define("MESSAGE_USERNAME_SAME_LIKE_OLD_ONE", "Sorry, that username is the same as your current one. Please choose a different username.");
define("MESSAGE_USER_INFO_CHANGED_SUCCESSFULLY", "Success, your personal information has been updated.");
define("MESSAGE_USER_INFO_CHANGED_FAILED", "Sorry, your personal information was NOT updated.");

// views
define("WORDING_BACK_TO_LOGIN", "Back to Menu");
define("WORDING_CHANGE_EMAIL", "Update Email");
define("WORDING_CHANGE_PASSWORD", "Update Password");
define("WORDING_CHANGE_USERNAME", "Update Username");
define("WORDING_CURRENTLY", "Currently");
define("WORDING_EDIT_USER_DATA", "Edit user data");
define("WORDING_EDIT_YOUR_CREDENTIALS", "Edit your user credentials and personal information below.");
define("WORDING_FORGOT_MY_PASSWORD", "I forgot my password");
define("WORDING_LOGIN", "Log in");
define("WORDING_LOGOUT", "Log out");
define("WORDING_NEW_EMAIL", "NEW email");
define("WORDING_NEW_PASSWORD", "NEW Password");
define("WORDING_NEW_PASSWORD_REPEAT", "NEW Password");
define("WORDING_NEW_USERNAME", "NEW Username");
define("WORDING_OLD_PASSWORD", "OLD Password");
define("WORDING_PASSWORD", "Password");
define("WORDING_PROFILE_PICTURE", "Your profile picture (from gravatar):");
define("WORDING_REGISTER", "Register");
define("WORDING_REGISTER_NEW_ACCOUNT", "Register new account");
define("WORDING_REGISTRATION_CAPTCHA", "Please enter these characters");
define("WORDING_REGISTRATION_EMAIL", "User's email (please provide a real email address, you'll get a verification mail with an activation link)");
define("WORDING_REGISTRATION_PASSWORD", "Password (min. 6 characters!)");
define("WORDING_REGISTRATION_PASSWORD_REPEAT", "Password repeat");
define("WORDING_REGISTRATION_USERNAME", "Username (only letters and numbers, 2 to 64 characters)");
define("WORDING_REMEMBER_ME", "Keep me logged in (for 2 weeks)");
define("WORDING_REQUEST_PASSWORD_RESET", "Request a password reset. Enter your username and you'll get a mail with instructions:");
define("WORDING_RESET_PASSWORD", "Reset my password");
define("WORDING_SUBMIT_NEW_PASSWORD", "Submit new password");
define("WORDING_USERNAME", "Username");
define("WORDING_YOU_ARE_LOGGED_IN_AS", "You are logged in as ");
define("WORDING_FIRST_NAME", "First Name");
define("WORDING_LAST_NAME", "Last Name");
define("WORDING_JOB_TITLE", "Job Title");
define("WORDING_PHONE", "Phone");
define("WORDING_MOBILE", "Mobile");
define("WORDING_ZIP_CODE", "Zip Code");
define("WORDING_CHANGE_INFO", "Update Info");
