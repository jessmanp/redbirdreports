<?php $css = 'setup_style.css'; ?>
<?php include('../application/views/_templates/header.php'); ?>
<header>
	<img id="settings-logo" src="<?php echo URL; ?>public/img/redbird_logo_sm.png" class="home-logo" alt="" />
</header>
<div style="background-color:#eeeeee;">
<br />

<div id="modal"></div>
<div id="popupmessage">
	<div id="message"></div>
	<button class="plain-btn">OK</button>
	<br /><br />
</div>

<?php if (!$registration->registration_successful && !$registration->verification_successful) { ?>
<div id="register">

<h1>New User Registration</h1>
<br />

<form method="post" action="/login/?register" id="registerform" name="registerform">
	<input type="hidden" id="register" name="register" value="1" />
	
	<label for="user_first_name">First Name<span class="small">*Required</span></label>
    <input id="user_first_name" type="text" pattern="[a-zA-Z0-9]{2,64}" oninvalid="setCustomValidity('You must use only letters.')" name="user_first_name" placeholder="Enter First Name" value="<?php if (isset($registration->temp_user_first_name)) { echo $registration->temp_user_first_name; } ?>" required />
	
	<label for="user_last_name">Last Name<span class="small">*Required</span></label>
    <input id="user_last_name" type="text" pattern="[a-zA-Z0-9]{2,64}"  oninvalid="setCustomValidity('You must use only letters.')" name="user_last_name" placeholder="Enter Last Name" value="<?php if (isset($registration->temp_user_last_name)) { echo $registration->temp_user_last_name; } ?>" required />
	
    <label for="user_name">Username<span class="small">*Required</span></label>
    <input id="user_name" type="text" pattern="[a-zA-Z0-9]{2,64}" oninvalid="setCustomValidity('You must use only letters or numbers and at least 6 characters total.')" name="user_name" placeholder="Enter Username" value="<?php if (isset($registration->temp_user_name)) { echo $registration->temp_user_name; } ?>" required />
	
    <label for="user_email">Email<span class="small">*Valid e-mail only</span></label>
    <input id="user_email" type="email" name="user_email" placeholder="Enter Email" value="<?php if (isset($registration->temp_user_email)) { echo $registration->temp_user_email; } ?>" required />
	
	<label for="user_email">Verify Email<span class="small">*Valid e-mail only</span></label>
    <input id="user_email_verfiy" type="email" name="user_email_verfiy" placeholder="Enter Email Again" value="<?php if (isset($registration->temp_user_email)) { echo $registration->temp_user_email; } ?>" required />

    <label for="user_password_new">Password<span class="small">*Minimum 6 chars</span></label>
    <input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" oninvalid="setCustomValidity('You must use at least 6 characters total.')" placeholder="Enter Password" required autocomplete="off" />

    <label for="user_password_repeat">Password<span class="small">*Required</span></label>
    <input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" oninvalid="setCustomValidity('You must use at least 6 characters total.')" placeholder="Enter Password Again" required autocomplete="off" />
	
	<br /><img id="captcha-image" src="tools/showCaptcha.php" alt="captcha" />
	<div style="clear:both;"></div>
    <label>Captcha<span class="small">*Required</span></label>
    <input type="text" id="captcha" name="captcha" required placeholder="Enter code" />
	
	<div style="clear:both;"></div>
	<br />
	<button class="plain-btn">Register</button>
	<br />
    <!-- <input type="submit" name="register" value="<?php echo WORDING_REGISTER; ?>" /> -->
</form>
<div style="clear:both;"></div>
</div>
<?php } else { ?>

<div id="register">

<h1>Welcome New User</h1>
<br />
<p>You will receive your first email with a link to activate your account and setup your agency. It only takes a few minutes to setup and start using <span style="font-weight:bold; color:#000000;">Red Bird Reports</span>&trade; to make your agency smarter!</p>
<div class="signup-icons">
<img src="<?php echo URL; ?>public/img/check_inbox_icon.png" class="signup-icon" alt="Check Your Inbox" />
<img src="<?php echo URL; ?>public/img/setup_agency_icon.png" class="signup-icon" alt="Setup Your Agency" />
<img src="<?php echo URL; ?>public/img/test_drive_icon.png" class="signup-icon" alt="Test Drive the App" />
<div style="clear:both;"></div>
</div>
<p>If you need help you can email us at <a href="mailto:support@redbirdreports.com">support@redbirdreports.com</a> or use the support section of our application to get more details and instructions on how to get started. You will need to activate your account, login and complete the setup to use our online support and how-to videos. Check your email for further instructions on how to activate your new account.</p>
<p>If you have not received your activation email from us please check your &quot;spam&quot; or &quot;junk&quot; folder in your email and add our support email address (support@redbirdreports.com) to your email contacts. You can also try to resend the activation email below.</p>
<div id="resend">
<form method="post" action="/login/?register" id="resendform" name="resendform">
<input type="hidden" id="resend" name="resend" value="1" />
<input type="hidden" id="tuid" name="tuid" value="<?php echo $registration->temp_user_id; ?>" />
<input type="submit" class="plain-btn" value="Resend Email">
</form>
</div>
<br /><br />
</div>

<?php } ?>

<br />
</div>

<?php
$msg = '';
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
           $msg .= $error." ";
        }
		echo "<script>openModal('error','".$msg."')</script>";
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            $msg .= $message." ";
        }
		echo "<script>openModal('info','".$msg."')</script>";
    }
}
?>

<?php include('../application/views/_templates/footer.php'); ?>
