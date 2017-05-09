<?php

/**
 * Handles the user registration
 * @author Panique
 * @link http://www.php-login.net
 * @link https://github.com/panique/php-login-advanced/
 * @license http://opensource.org/licenses/MIT MIT License
 */
class Registration
{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection            = null;
    /**
     * @var bool success state of registration
     */
    public  $registration_successful  = false;
    /**
     * @var bool success state of verification
     */
    public  $verification_successful  = false;
    /**
     * @var bool login new
     */
    public  $login_new  = false;
    /**
     * @var array collection of error messages
     */
    public  $errors                   = array();
    /**
     * @var array collection of success / neutral messages
     */
    public  $messages                 = array();

	public  $temp_user_id 			= 0;

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
		// create/read session
		//session_start();

        // if we have such a POST request, call the registerNewUser() method
        if (isset($_POST["register"])) {
            $this->registerNewUser($_POST['user_first_name'], $_POST['user_last_name'], $_POST['user_name'], $_POST['user_email'], $_POST['user_email_verfiy'], $_POST['user_password_new'], $_POST['user_password_repeat'], $_POST["captcha"]);
        // if we have such a GET request, call the verifyNewUser() method
        } else if (isset($_GET["register"]) && isset($_GET["id"]) && isset($_GET["verification_code"])) {
            $this->verifyNewUser($_GET["register"], $_GET["id"], $_GET["verification_code"]);
		// if we have a POST request to resend verification email, call sendVerificationEmail() method
        } else if (isset($_POST["resend"])) {
			$this->resendVerificationEmail($_POST["tuid"]);
			//$this->registration_successful = true;
        }
    }

    /**
     * Checks if database connection is opened and open it if not
     */
    private function databaseConnection()
    {
        // connection already opened
        if ($this->db_connection != null) {
            return true;
        } else {
            // create a database connection, using the constants from config/config.php
            try {
                // Generate a database connection, using the PDO connector
                // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
                // Also important: We include the charset, as leaving it out seems to be a security issue:
                // @see http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers#Connecting_to_MySQL says:
                // "Adding the charset to the DSN is very important for security reasons,
                // most examples you'll see around leave it out. MAKE SURE TO INCLUDE THE CHARSET!"
                $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
                return true;
            // If an error is catched, database connection failed
            } catch (PDOException $e) {
                $this->errors[] = MESSAGE_DATABASE_ERROR;
                return false;
            }
        }
    }

    /**
     * handles the entire registration process. checks all error possibilities, and creates a new user in the database if
     * everything is fine
     */
    private function registerNewUser($user_first_name, $user_last_name, $user_name, $user_email, $user_email_verify, $user_password, $user_password_repeat, $captcha)
    {
        // we just remove extra space on first, last, username and email
        $user_first_name  = trim($user_first_name);
        $user_last_name  = trim($user_last_name);
        $user_name  = trim($user_name);
        $user_email = trim($user_email);

		$this->temp_user_first_name = $user_first_name;
		$this->temp_user_last_name = $user_last_name;
		$this->temp_user_name = $user_name;
		$this->temp_user_email = $user_email;

        // check provided data validity
        // TODO: check for "return true" case early, so put this first
        if (strtolower($captcha) != strtolower($_SESSION['captcha'])) {
            $this->errors[] = MESSAGE_CAPTCHA_WRONG;
        } elseif (empty($user_first_name)) {
            $this->errors[] = MESSAGE_FIRSTNAME_EMPTY;
        } elseif (strlen($user_first_name) > 64 || strlen($user_first_name) < 2) {
            $this->errors[] = MESSAGE_FIRSTNAME_BAD_LENGTH;
        } elseif (empty($user_last_name)) {
            $this->errors[] = MESSAGE_LASTNAME_EMPTY;
        } elseif (strlen($user_last_name) > 64 || strlen($user_last_name) < 2) {
            $this->errors[] = MESSAGE_LASTNAME_BAD_LENGTH;
        } elseif (empty($user_name)) {
            $this->errors[] = MESSAGE_USERNAME_EMPTY;
        } elseif (empty($user_password) || empty($user_password_repeat)) {
            $this->errors[] = MESSAGE_PASSWORD_EMPTY;
        } elseif ($user_password !== $user_password_repeat) {
            $this->errors[] = MESSAGE_PASSWORD_BAD_CONFIRM;
        } elseif (strlen($user_password) < 6) {
            $this->errors[] = MESSAGE_PASSWORD_TOO_SHORT;
        } elseif (strlen($user_name) > 64 || strlen($user_name) < 2) {
            $this->errors[] = MESSAGE_USERNAME_BAD_LENGTH;
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $user_name)) {
            $this->errors[] = MESSAGE_USERNAME_INVALID;
        } elseif (empty($user_email)) {
            $this->errors[] = MESSAGE_EMAIL_EMPTY;
        } elseif ($user_email != $user_email_verify) {
            $this->errors[] = MESSAGE_EMAIL_NO_MATCH;
        } elseif (strlen($user_email) > 64) {
            $this->errors[] = MESSAGE_EMAIL_TOO_LONG;
        } elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = MESSAGE_EMAIL_INVALID;

        // finally if all the above checks are ok
        } else if ($this->databaseConnection()) {
            // check if username or email already exists
            $query_check_user_name = $this->db_connection->prepare('SELECT user_name, user_email FROM users WHERE user_name=:user_name OR user_email=:user_email');
            $query_check_user_name->bindValue(':user_name', $user_name, PDO::PARAM_STR);
            $query_check_user_name->bindValue(':user_email', $user_email, PDO::PARAM_STR);
            $query_check_user_name->execute();
            $result = $query_check_user_name->fetchAll();

            // if username or/and email find in the database
            // TODO: this is really awful!
            if (count($result) > 0) {
                for ($i = 0; $i < count($result); $i++) {
                    $this->errors[] = ($result[$i]['user_name'] == $user_name) ? MESSAGE_USERNAME_EXISTS : MESSAGE_EMAIL_ALREADY_EXISTS;
                }
            } else {
                // check if we have a constant HASH_COST_FACTOR defined (in config/hashing.php),
                // if so: put the value into $hash_cost_factor, if not, make $hash_cost_factor = null
                $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);

                // crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 character hash string
                // the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4, by the password hashing
                // compatibility library. the third parameter looks a little bit odd, but that's how those PHP 5.5 functions
                // want the parameter: as an array with, currently only used with 'cost' => XX.
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
                // generate random hash for email verification (40 char string)
                $user_activation_hash = sha1(uniqid(mt_rand(), true));
			   // set new registration user level as 3 = Owner/Agency level
			   $user_level = 3;

                // write new users data into database
                $query_new_user_insert = $this->db_connection->prepare('INSERT INTO users (user_first_name, user_last_name, user_name, user_password_hash, user_email, user_level, user_activation_hash, user_registration_ip, user_registration_datetime) VALUES (:user_first_name, :user_last_name, :user_name, :user_password_hash, :user_email, :user_level, :user_activation_hash, :user_registration_ip, now())');

				$query_new_user_insert->bindValue(':user_first_name', $user_first_name, PDO::PARAM_STR);
				$query_new_user_insert->bindValue(':user_last_name', $user_last_name, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_name', $user_name, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_email', $user_email, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_level', $user_level, PDO::PARAM_INT);
                $query_new_user_insert->bindValue(':user_activation_hash', $user_activation_hash, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_registration_ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
                $query_new_user_insert->execute();

                // id of new user
                $user_id = $this->db_connection->lastInsertId();

                if ($query_new_user_insert) {
                    // send a verification email
                    if ($this->sendVerificationEmail($user_id, $user_email, $user_name, $user_password, $user_activation_hash)) {
                        // when mail has been send successfully
                        $this->messages[] = MESSAGE_VERIFICATION_MAIL_SENT;
					   $this->temp_user_id = $user_id;
                        $this->registration_successful = true;
                    } else {
                        // delete this users account immediately, as we could not send a verification email
                        $query_delete_user = $this->db_connection->prepare('DELETE FROM users WHERE user_id=:user_id');
                        $query_delete_user->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                        $query_delete_user->execute();
                        $this->errors[] = MESSAGE_VERIFICATION_MAIL_ERROR;
                    }
                } else {
                    $this->errors[] = MESSAGE_REGISTRATION_FAILED;
                }
            }
        }
    }

    /*
     * sends an email to the provided email address
     * @return boolean gives back true if mail has been sent, gives back false if no mail could been sent
     */
    //public function sendVerificationEmail($user_id, $user_email, $user_activation_hash)
    public function sendVerificationEmail($user_id, $user_email, $user_name, $user_password, $user_activation_hash)
    {
        $mail = new PHPMailer;

        // please look into the config/config.php for much more info on how to use this!
        // use SMTP or use mail()
        if (EMAIL_USE_SMTP) {
            // Set mailer to use SMTP
            $mail->IsSMTP();
            //useful for debugging, shows full SMTP errors
            //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            // Enable SMTP authentication
            $mail->SMTPAuth = EMAIL_SMTP_AUTH;
            // Enable encryption, usually SSL/TLS
            if (defined(EMAIL_SMTP_ENCRYPTION)) {
                $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
            }
            // Specify host server
            $mail->Host = EMAIL_SMTP_HOST;
            $mail->Username = EMAIL_SMTP_USERNAME;
            $mail->Password = EMAIL_SMTP_PASSWORD;
            $mail->Port = EMAIL_SMTP_PORT;
        } else {
            $mail->IsMail();
        }

        $mail->From = EMAIL_VERIFICATION_FROM;
        $mail->FromName = EMAIL_VERIFICATION_FROM_NAME;
        $mail->AddAddress($user_email);
        $mail->Subject = EMAIL_VERIFICATION_SUBJECT;


        $body = '
<html>
<head>
<title>Red Bird Reports - Welcome New Member Email</title>
<!-- css -->
<style>
	html {
		font-size: 100%;
		-webkit-text-size-adjust: 100%;
	}
	::-ms-clear { display: none; }
</style>
</head>
<body style="margin:0;padding:0;border:0;background-color:#ffffff;font-family: Calibri, Helvetica, Arial, Verdana, sans-serif;font-size:16px;color:#000000;">
<div style="width:100%;min-height:100%;overflow-x:hidden;position:absolute;">
<div style="padding:10px 0 0 10px;height:55px;background-color:#ffffff;border-bottom:2px solid #ff0000;color:#333333;">
	<img src="http://dev.redbirdreports.com/public/img/redbird_logo_sm.png" class="home-logo" alt="" />
</div>
<div style="background-color:#eeeeee;">
<br /><br />
<div style="margin:0 10px 0 10px;background-color:#ffffff;border:2px solid #ff0000;-webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px;font-size:16px;text-align:left;line-height:22px;padding:15px;">
<h1 style="margin:5px 0 0 0;font-size:22px;font-weight:normal;">Welcome to Red Bird Reports!</h1>
<br />
You will be asked to setup your agency information and employee compensation when you first log in.
<br /><br />
Please confirm your email by clicking the link below. Once you have clicked the link below your account will be activated and you will be logged in and asked to complete the setup process.
<br /><br />
';
        $link = EMAIL_VERIFICATION_URL.'&id='.urlencode($user_id).'&verification_code='.urlencode($user_activation_hash);
	    $body .= EMAIL_VERIFICATION_CONTENT.' <a href="'.$link.'">'.$link.'</a><br /><br />';
		$body .= 'You will need to use the login information below to activate your new account.<br /><br /><strong>Username:</strong> '.$user_name.'<br /><strong>Password:</strong> '.$user_password;
	    $body .= '
Thanks! We look forward to making your agency smarter!
<div style="clear:both;"></div>
</div>
<br /><br />
</div>
<div style="clear:both;text-align:center;padding:5px;font-size:12px;height:45px;background-color:#ffffff;border-top:2px solid #ff0000;color:#333333;">
	&copy; 2016 Red Bird Reports. All Rights Reserved.
</div>
<div style="clear:both;font-size:14px;padding:10px;">
<span style="font-weight:bold; color:#000000;">Red Bird Reports</span>&trade; is Your Agency&rsquo;s Solution.<br />
<span style="color:#ff0000; text-shadow:none; font-weight:bold;">We make your agency smarter</span><br /><br />
<span style="font-weight:bold; color:#000000;">Red Bird Reports</span>&trade; is easy to set up in minutes. There is no annual contract or set up fee. Cancel at any time.<br /><br />
If you do not wish to receive email from <span style="font-weight:bold; color:#000000;">Red Bird Reports</span>&trade; in the future, please <a href="http://www.redbirdreports.com/unsubscribe">UNSUBSCRIBE</a>.
<br /><br />
</div>
</div>
</body>
</html>
';

        // the link to your register.php, please set this value in config/email_verification.php
        $mail->Body = $body;
	    $mail->AltBody = "Welcome to Red Bird Reports! ".EMAIL_VERIFICATION_CONTENT." ".$link; // optional, text alternative content
	    //$mail->MsgHTML($body);

        if(!$mail->Send()) {
            $this->errors[] = MESSAGE_VERIFICATION_MAIL_NOT_SENT . $mail->ErrorInfo;
            return false;
        } else {
            return true;
        }
    }

    /**
     * checks the id/verification code combination and set the user's activation status to true (=1) in the database
     *** TO DO *** posibly use the register type to specify job title, but is not secure
     */
    public function verifyNewUser($register_type, $user_id, $user_activation_hash)
    {
        // if database connection opened
        if ($this->databaseConnection()) {
            // try to update user with specified information
            $query_update_user = $this->db_connection->prepare('UPDATE users SET user_active = 1, user_activation_hash = NULL WHERE user_id = :user_id AND user_activation_hash = :user_activation_hash');
            $query_update_user->bindValue(':user_id', intval(trim($user_id)), PDO::PARAM_INT);
            $query_update_user->bindValue(':user_activation_hash', $user_activation_hash, PDO::PARAM_STR);
            $query_update_user->execute();

            if ($query_update_user->rowCount() > 0) {

		    		// if user has a valid ID , we identify them with the ID from verification
            		if ($this->databaseConnection()) {

                		// database query, getting all the info of the selected user
                		$query_user = $this->db_connection->prepare('SELECT * FROM users WHERE user_id = :user_id');
                		$query_user->bindValue(':user_id', $user_id, PDO::PARAM_STR);
                		$query_user->execute();
                		
                		// get result row (as an object)
                		$result_row = $query_user->fetchObject();

					if ($result_row->user_level == 3) {
					
						// create a new agency as this new user has been verified as level 3, make the selected user the owner
                			$query_agency_owner_insert = $this->db_connection->prepare('INSERT INTO agencies (agency_owner_id) VALUES (:user_id)');
                			$query_agency_owner_insert->bindValue(':user_id', $user_id, PDO::PARAM_STR);
                			$query_agency_owner_insert->execute();

						// set id of new agency
                			$agency_id = $this->db_connection->lastInsertId();
                			
                		// add default settings
                			$query_agency_settings_insert = $this->db_connection->prepare('INSERT INTO agencies_settings (agency_id) VALUES (:agency_id)');
                			$query_agency_settings_insert->bindValue(':agency_id', $agency_id, PDO::PARAM_STR);
                			$query_agency_settings_insert->execute();
                			
                		// create compensation data for this owner
							$query_user_compensation_insert = $this->db_connection->prepare('INSERT INTO compensation_plans (user_id) VALUES (:user_id)');
							$query_user_compensation_insert->bindValue(':user_id', $user_id, PDO::PARAM_INT);
							$query_user_compensation_insert->execute();
                
					} else {
					
						// find what agency this user belongs to since they are not an owner (less than level 3)
							$query_get_user_agency = $this->db_connection->prepare('SELECT agency_id FROM agencies_users WHERE user_id = :user_id');
                			$query_get_user_agency->bindValue(':user_id', $user_id, PDO::PARAM_STR);
                			$query_get_user_agency->execute();
                			
                		// get result row (as an object)
                			$result2_row = $query_get_user_agency->fetchObject();

						// id of existing agency
							$agency_id = $result2_row->agency_id;
					}

					// link this user to the agency
                		$query_agency_user_insert = $this->db_connection->prepare('INSERT INTO agencies_users (agency_id,user_id) VALUES (:agency_id,:user_id)');
						$query_agency_user_insert->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
                		$query_agency_user_insert->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                		$query_agency_user_insert->execute();

            		}

			   // do auto login since its a new user - set login sessions
			   // write user data into PHP SESSION [a file on your server]
                $_SESSION['user_id'] = $result_row->user_id;
                $_SESSION['agency_id'] = $agency_id;
                $_SESSION['user_name'] = $result_row->user_name;
                $_SESSION['user_email'] = $result_row->user_email;
                $_SESSION['user_logged_in'] = 1;

                $this->verification_successful = true;
                if ($result_row->user_level == 3) {
                	$this->login_new = true;
                }
                $this->messages[] = MESSAGE_REGISTRATION_ACTIVATION_SUCCESSFUL;
            } else {
                $this->errors[] = MESSAGE_REGISTRATION_ACTIVATION_NOT_SUCCESSFUL;
            }
        }
    }

	/*
     * sends an email to the provided email address
     * @return boolean gives back true if mail has been sent, gives back false if no mail could been sent
     */
    public function resendVerificationEmail($user_id)
    {	
		if ($this->databaseConnection()) {
            // check if user id already exists
            $query_check_user_id = $this->db_connection->prepare('SELECT user_activation_hash, user_email FROM users WHERE user_id=:user_id');
            $query_check_user_id->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $query_check_user_id->execute();
            $result = $query_check_user_id->fetchAll();

            // if user id is NOT found in the database pass error
            if (count($result) > 0) {
				$rs_user_id = $user_id;
				$rs_user_email = $result[0]['user_email'];
				$rs_user_activation_hash = $result[0]['user_activation_hash'];
                 if ($this->sendVerificationEmail($rs_user_id, $rs_user_email, $rs_user_activation_hash)) {
					$this->messages[] = MESSAGE_VERIFICATION_MAIL_SENT;
                    $this->registration_successful = true;
				}
            } else {
				$this->errors[] = MESSAGE_VERIFICATION_MAIL_ERROR;
		    }
			
		}

	}

	// EOF

}

