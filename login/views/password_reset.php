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

<div id="register">

<h1>Password Reset</h1>
<br />

<?php if ($login->passwordResetLinkIsValid() == true) { ?>
<form method="post" action="/login/?reset" name="new_password_form">
	<input type="hidden" id="submit_new_password" name="submit_new_password" value="1" />
    <input type='hidden' name='user_name' value='<?php echo $_GET['user_name']; ?>' />
    <input type='hidden' name='user_password_reset_hash' value='<?php echo $_GET['verification_code']; ?>' />

    <label for="user_password_new"><?php echo WORDING_NEW_PASSWORD; ?><span class="small">*Required</span></label>
    <input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />

    <label for="user_password_repeat"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?><span class="small">*Required</span></label>
    <input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
	<div style="clear:both;"></div>
	<br />
	<button class="plain-btn">Update Password</button>
	<br /><br /><br />
	<span style="font-size:12px;"><strong>NOTE:</strong> Passwords must be 2-64 characters and can only contain letters and numbers.</span>
    <!-- <input type="submit" name="submit_new_password" value="<?php echo WORDING_SUBMIT_NEW_PASSWORD; ?>" /> -->
</form>
<!-- no data from a password-reset-mail has been provided, so we simply show the request-a-password-reset form -->
<?php } else { ?>
<form method="post" action="/login/?reset" name="password_reset_form">
	<input type="hidden" id="request_password_reset" name="request_password_reset" value="1" />
	<!-- <?php echo WORDING_REQUEST_PASSWORD_RESET; ?> -->
	Please enter your username below to reset your password.<br />You will receive an email with further instructions on how to reset your password.<br /><br /><br />
    <label for="user_name">Username<span class="small">*Required</span></label>
    <input id="user_name" type="text" name="user_name" required />
	<div style="clear:both;"></div>
	<br />
	<button class="plain-btn">Reset Password</button>
	<br /><br /><br />
	<span style="font-size:12px;"><strong>NOTE:</strong> If you do not remember your Username you can email us at <a href="mailto:support@redbirdreports.com">support@redbirdreports.com</a> for instructions on how to reset your password.</span>
    <!-- <input type="submit" name="request_password_reset" value="<?php echo WORDING_RESET_PASSWORD; ?>" /> -->
</form>
<?php } ?>

<!-- <a href="/menu/"><?php echo WORDING_BACK_TO_LOGIN; ?></a> -->
</div>

<br />
</div>

<?php
$msg = '';
// show potential errors / feedback (from login object)
    if ($login->errors) {
        foreach ($login->errors as $error) {
            $msg .= $error." ";
        }
		echo "<script>openModal('error','".$msg."')</script>";
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            $msg .= $message." ";
        }
		echo "<script>openModal('info','".$msg."')</script>";
    }
?>

<?php include('../application/views/_templates/footer.php'); ?>
