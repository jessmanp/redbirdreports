<?php

class SetupModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

	/**
     * Generate random password function
     */
	private function rand_string($length) {
		// will create a random password based on acceptable characters
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		return substr(str_shuffle($chars),0,$length);
	}


    /**
     * Get Agency ID from database based on Owner ID
     */
    public function getOwnerAgencyID($user_id)
    {
		// query agency ID for new owner
        $sql = 'SELECT id FROM agencies WHERE agency_owner_id = '.$user_id;
        $query = $this->db->prepare($sql);
        $query->execute();
		return $query->fetch()->id;

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        //return $query->fetchAll();
    }

	/**
     * Add/Update agency info to database
     */
    public function updateAgencyInfo($agency_name, $agency_address, $agency_city, $agency_state, $agency_zip_code, $agency_phone, $agency_id)
    {

		// write new data into database
		$query_update_agency = $this->db->prepare('UPDATE agencies SET agency_name = :agency_name, agency_address = :agency_address, agency_city = :agency_city, agency_state = :agency_state, agency_zip = :agency_zip_code, agency_phone = :agency_phone WHERE id = :agency_id');
		$query_update_agency->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
		$query_update_agency->bindValue(':agency_name', $agency_name, PDO::PARAM_STR);
		$query_update_agency->bindValue(':agency_address', $agency_address, PDO::PARAM_STR);
		$query_update_agency->bindValue(':agency_city', $agency_city, PDO::PARAM_STR);
		$query_update_agency->bindValue(':agency_state', $agency_state, PDO::PARAM_STR);
		$query_update_agency->bindValue(':agency_zip_code', $agency_zip_code, PDO::PARAM_STR);
		$query_update_agency->bindValue(':agency_phone', $agency_phone, PDO::PARAM_STR);
		$query_update_agency->execute();
    }

	/**
     * Add/Invite employee
     */
    public function inviteEmployee($employee_first_name, $employee_last_name, $employee_email, $employee_type, $agency_id)
    {
		// run insert new user function with email and send invite	
		// set username and password automatically and include them in the invite
		$auto_username = $employee_first_name.$employee_last_name.$agency_id;
		$auto_password = $this->rand_string(8);

            // check if username or email already exists
            $query_check_user_name = $this->db->prepare('SELECT user_name, user_email FROM users WHERE user_name=:user_name OR user_email=:user_email');
            $query_check_user_name->bindValue(':user_name', $auto_username, PDO::PARAM_STR);
            $query_check_user_name->bindValue(':user_email', $employee_email, PDO::PARAM_STR);
            $query_check_user_name->execute();
            $result = $query_check_user_name->fetchAll();

            // if username or/and email find in the database
            if (count($result) > 0) {

				// AUTO GEN ERROR THE USER EXISTS
				// DO SOMETHING?

            } else {

                // check if we have a constant HASH_COST_FACTOR defined (in config/hashing.php),
                // if so: put the value into $hash_cost_factor, if not, make $hash_cost_factor = null
                $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);

                // crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 character hash string
                // the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4, by the password hashing
                // compatibility library. the third parameter looks a little bit shitty, but that's how those PHP 5.5 functions
                // want the parameter: as an array with, currently only used with 'cost' => XX.
                $user_password_hash = password_hash($auto_password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
                // generate random hash for email verification (40 char string)
                $user_activation_hash = sha1(uniqid(mt_rand(), true));

                // write new users data into database
                $query_invite_user_insert = $this->db->prepare('INSERT INTO users (user_first_name, user_last_name, user_name, user_password_hash, user_email, user_level, user_activation_hash, user_registration_ip, user_registration_datetime) VALUES(:user_first_name, :user_last_name, :user_name, :user_password_hash, :user_email, :user_level, :user_activation_hash, :user_registration_ip, now())');
                $query_invite_user_insert->bindValue(':user_first_name', $employee_first_name, PDO::PARAM_STR);
                $query_invite_user_insert->bindValue(':user_last_name', $employee_last_name, PDO::PARAM_STR);
                $query_invite_user_insert->bindValue(':user_name', $auto_username, PDO::PARAM_STR);
                $query_invite_user_insert->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);
                $query_invite_user_insert->bindValue(':user_email', $employee_email, PDO::PARAM_STR);
                $query_invite_user_insert->bindValue(':user_level', $employee_type, PDO::PARAM_INT);
                $query_invite_user_insert->bindValue(':user_activation_hash', $user_activation_hash, PDO::PARAM_STR);
                $query_invite_user_insert->bindValue(':user_registration_ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
                $query_invite_user_insert->execute();

                // id of new user
                $invite_user_id = $this->db->lastInsertId();

				// link this user to the agency
                $query_agency_user_insert = $this->db->prepare('INSERT INTO agencies_users (agency_id,user_id) VALUES (:agency_id,:user_id)');
				$query_agency_user_insert->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
                $query_agency_user_insert->bindValue(':user_id', $invite_user_id, PDO::PARAM_INT);
                $query_agency_user_insert->execute();

				// create compensation data for this user
                $query_user_compensation_insert = $this->db->prepare('INSERT INTO compensation_plans (user_id) VALUES (:user_id)');
                $query_user_compensation_insert->bindValue(':user_id', $invite_user_id, PDO::PARAM_INT);
                $query_user_compensation_insert->execute();

                if ($query_invite_user_insert) {
                    // send a verification email
                    if ($this->sendVerificationEmail($invite_user_id, $employee_email, $user_activation_hash, $auto_username, $auto_password)) {
                        // when mail has been send successfully set user id
                        // return the new user ID, but ONLY if user was successfully invited
						return $invite_user_id;
                    } else {
                        // delete this users account immediately, as we could not send a verification email
                        $query_delete_user = $this->db->prepare('DELETE FROM users WHERE user_id = :user_id');
                        $query_delete_user->bindValue(':user_id', $invite_user_id, PDO::PARAM_INT);
                        $query_delete_user->execute();
                        // delete user linked agency data
						$query_delete_user_agency = $this->db->prepare("DELETE FROM agencies_users WHERE user_id = :user_id");
						$query_delete_user_agency->bindValue(':user_id', $invite_user_id, PDO::PARAM_INT);
						$query_delete_user_agency->execute();
						// delete user linked compensation data
						$query_delete_user_comp = $this->db->prepare("DELETE FROM compensation_plans WHERE user_id = :user_id");
						$query_delete_user_agency->bindValue(':user_id', $invite_user_id, PDO::PARAM_INT);
						$query_delete_user_comp->execute();
                        
                    }
                }

            }

	}

    /*
     * sends an email to the provided email address
     * @return boolean gives back true if mail has been sent, gives back false if no mail could been sent
     */
    public function sendVerificationEmail($user_id, $user_email, $user_activation_hash, $auto_username, $auto_password)
    {
        $mail = new PHPMailer;

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
<title>Red Bird Reports - Invite New Member Email</title>
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
<h1 style="margin:5px 0 0 0;font-size:22px;font-weight:normal;">You have been invited to Red Bird Reports!</h1>
<br />
Please confirm your email by clicking the link below. Once you have clicked the link below your account will be confirmed and you can complete the setup process.
<br /><br />
';
        $link = EMAIL_VERIFICATION_URL.'&id='.urlencode($user_id).'&verification_code='.urlencode($user_activation_hash);
	    $body .= EMAIL_VERIFICATION_CONTENT.' <a href="'.$link.'">'.$link.'</a><br /><br />';
		$body .= 'You will need to use the login information below to activate your new account.<br /><br /><strong>Temporary Username:</strong> '.$auto_username.'<br /><strong>Temporary Password:</strong> '.$auto_password;
	    $body .= '
<br /><br />
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
<span style="font-weight:bold; color:#000000;">Red Bird Repots</span>&trade; is easy to use and can be set up in minutes. There is no annual contract or set up fee. Cancel at any time.<br /><br />
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
            // error occured when trying to send email
            return false;
        } else {
            return true;
        }
    }
    
    /*
     * re-sends an email to the provided email address
     * invited employee id is passed in to query user info
     */
    public function resendInviteVerificationEmail($user_id)
    {	

		// check if user id already exists
		$query_check_user_id = $this->db->prepare('SELECT user_activation_hash, user_email, user_name FROM users WHERE user_id = :user_id');
		$query_check_user_id->bindValue(':user_id', $user_id, PDO::PARAM_INT);
		$query_check_user_id->execute();
		$result = $query_check_user_id->fetchAll();

		// if user id is NOT found in the database pass error
		if (count($result) > 0) {
			$rs_user_id = $user_id;
			$rs_user_email = $result[0]->user_email;
			$rs_user_activation_hash = $result[0]->user_activation_hash;
			$rs_auto_username = $result[0]->user_name;
			
			// generate new temp password and update in database
			$hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);
			$rs_auto_password = $this->rand_string(8);
			$rs_password_hash = password_hash($rs_auto_password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
			
			$sql = "UPDATE users SET user_password_hash = :user_password_hash WHERE user_id = :user_id";
			$query_new_password = $this->db->prepare($sql);
			$query_new_password->bindValue(':user_password_hash', $rs_password_hash, PDO::PARAM_STR);
			$query_new_password->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			$query_new_password->execute();
			
			 if ($this->sendVerificationEmail($rs_user_id, $rs_user_email, $rs_user_activation_hash, $rs_auto_username, $rs_auto_password)) {
				// SUCCESS
				return true;
			}
		} else {
			// ERROR
			return false;
		}

	}

    /**
     * Get Employees from database based on Agency ID
     */
    public function getInvitedEmployees($agency_id)
    {
		// query agency ID for new owner
        $sql = 'SELECT users.user_id,users.user_level,users.user_first_name,users.user_last_name FROM users, agencies, agencies_users WHERE agencies_users.user_id = users.user_id AND agencies_users.agency_id = agencies.id AND agencies.id = '.$agency_id.' AND users.user_level < 3';
        $query = $this->db->prepare($sql);
        $query->execute();
		return $query->fetchAll();
    }


	/**
     * Insert employee compensation
     */
    public function saveEmployeeCompensation($employee_id, $compensation_type, $compensation_rate, $compensation_other, $comp_draw, $commission_auto_new, $commission_auto_renew, $commission_fire_new, $commission_fire_renew, $commission_life, $commission_life_renew, $commission_health, $commission_health_renew)
    {

		// update compensation data for employee
		if (empty($compensation_other)) {
			$compensation_other = 0;
		}

		// query to update comp plan
		$query_update_employee_compensation = $this->db->prepare('UPDATE compensation_plans SET active = 1, effective_date = now(), rate_type = :rate_type, rate = :rate, other = :other, draw = :draw, commission_auto_new = :commission_auto_new, commission_auto_renew = :commission_auto_renew, commission_fire_new = :commission_fire_new, commission_fire_renew = :commission_fire_renew, commission_life = :commission_life, commission_life_renew = :commission_life_renew, commission_health = :commission_health, commission_health_renew = :commission_health_renew WHERE user_id = :employee_id');

		$query_update_employee_compensation->bindValue(':rate_type', $compensation_type, PDO::PARAM_INT);
		$query_update_employee_compensation->bindValue(':rate', $compensation_rate, PDO::PARAM_STR);
		$query_update_employee_compensation->bindValue(':other', $compensation_other, PDO::PARAM_STR);
		$query_update_employee_compensation->bindValue(':draw', $comp_draw, PDO::PARAM_INT);
		$query_update_employee_compensation->bindValue(':commission_auto_new', $commission_auto_new, PDO::PARAM_STR);
		$query_update_employee_compensation->bindValue(':commission_auto_renew', $commission_auto_renew, PDO::PARAM_STR);
		$query_update_employee_compensation->bindValue(':commission_fire_new', $commission_fire_new, PDO::PARAM_STR);
		$query_update_employee_compensation->bindValue(':commission_fire_renew', $commission_fire_renew, PDO::PARAM_STR);
		$query_update_employee_compensation->bindValue(':commission_life', $commission_life, PDO::PARAM_STR);
		$query_update_employee_compensation->bindValue(':commission_life_renew', $commission_life_renew, PDO::PARAM_STR);
		$query_update_employee_compensation->bindValue(':commission_health', $commission_health, PDO::PARAM_STR);
		$query_update_employee_compensation->bindValue(':commission_health_renew', $commission_health_renew, PDO::PARAM_STR);
		$query_update_employee_compensation->bindValue(':employee_id', $employee_id, PDO::PARAM_INT);
		$query_update_employee_compensation->execute();

		if ($query_update_employee_compensation) {
			$updated_employee_id = $employee_id;
			return $updated_employee_id;
		}

	}

	/**
     * Query employee compensation data to populate form
     */
    public function getEmployeeCompensationData($employee_id)
    {

		// query to get employee data
		$query_get_employee_compensation = $this->db->prepare('SELECT * FROM compensation_plans WHERE user_id = :employee_id');
		$query_get_employee_compensation->bindValue(':employee_id', $employee_id, PDO::PARAM_INT);
		$query_get_employee_compensation->execute();
		return $query_get_employee_compensation->fetchAll();

	}

	/**
     * Check Employees compensation from database based on Agency ID
     */
    public function checkEmployeeCompensation($agency_id)
    {
		// query agency ID for new owner
        $sql = 'SELECT users.user_id,users.user_level,users.user_first_name,users.user_last_name FROM users, agencies, agencies_users, compensation_plans WHERE agencies_users.user_id = users.user_id AND agencies_users.agency_id = agencies.id AND compensation_plans.user_id = users.user_id AND agencies.id = '.$agency_id.' AND users.user_level < 3 AND compensation_plans.rate != 0';
        $query = $this->db->prepare($sql);
        $query->execute();
		return $query->fetchAll();
    }

	/**
     * Get Agency Info from database based on Agency ID
     */
    public function getAgencyInfo($agency_id)
    {
		// query agency ID for new owner
        $sql = 'SELECT * FROM agencies WHERE id = '.$agency_id;
        $query = $this->db->prepare($sql);
        $query->execute();
		return $query->fetchAll();
    }


// EOF
}
