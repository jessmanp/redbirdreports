<?php include('../application/views/_templates/header.php'); ?>

<div id="user-panel">
	<div class="user-box-settings">
		<div id="menu-link" class="button-normal">
			<div class="icon-home">Menu</div>
		</div>
		<div id="settings-link" class="button-select">
			<div class="icon-gears">Settings</div>
		</div>
		<div id="logout-link" class="button-normal">
			<div class="icon-logout">Logout</div>
		</div>
	</div>
</div>
<header>
	<img src="<?php echo URL; ?>public/img/agency_nerd_app_logo.png" class="home-logo" alt="" />
 	<div class="button-right"><div class="icon-user"></div></div>
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

<h1>Edit User Settings</h1>
<br />

<?php echo WORDING_EDIT_YOUR_CREDENTIALS; ?>

<br />
<!-- backlink -->
	<div style="clear:both;"></div>

<div style="clear:both;">
<!-- clean separation of HTML and PHP -->
<div class="settings-title"><em>Update Username:</em> <strong><?php echo $_SESSION['user_name']; ?></strong></div>
<!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
<form method="post" action="/login/?edit=username" name="user_edit_form_name">
	<input type="hidden" id="user_edit_submit_name" name="user_edit_submit_name" value="1" />
    <label for="user_name"><?php echo WORDING_NEW_USERNAME; ?><span class="small">*Required</span></label>
    <input id="user_name" type="text" name="user_name" pattern="[a-zA-Z0-9]{2,64}" required />
	<div style="clear:both;"></div>
	<span style="font-style:italic;font-size:12px;">(Username cannot be empty and must be 2-64 characters long)</span>
	</div>
	<br />
	<button class="plain-btn"><?php echo WORDING_CHANGE_USERNAME; ?></button>
	<br />
    <!-- <input type="submit" name="user_edit_submit_name" value="<?php echo WORDING_CHANGE_USERNAME; ?>" /> -->
</form>

<div class="settings-title"><em>Update Email:</em> <strong><?php echo $_SESSION['user_email']; ?></strong></div>
<!-- edit form for user email / this form uses HTML5 attributes, like "required" and type="email" -->
<form method="post" action="/login/?edit=email" name="user_edit_form_email">
	<input type="hidden" id="user_edit_submit_email" name="user_edit_submit_email" value="1" />
    <label for="user_email"><?php echo WORDING_NEW_EMAIL; ?><span class="small">*Valid e-mail only</span></label>
    <input id="user_email" type="email" name="user_email" required />
	<div style="clear:both;"></div>
	<br />
	<button class="plain-btn"><?php echo WORDING_CHANGE_EMAIL; ?></button>
	<br />
    <!-- <input type="submit" name="user_edit_submit_email" value="<?php echo WORDING_CHANGE_EMAIL; ?>" /> -->
</form>

<div class="settings-title"><em>Update Password</em></div>
<!-- edit form for user's password / this form uses the HTML5 attribute "required" -->
<form method="post" action="/login/?edit=password" name="user_edit_form_password">
	<input type="hidden" id="user_edit_submit_password" name="user_edit_submit_password" value="1" />
    <label for="user_password_old"><?php echo WORDING_OLD_PASSWORD; ?><span class="small">*Required</span></label>
    <input id="user_password_old" type="password" name="user_password_old" required autocomplete="off" />

    <label for="user_password_new"><?php echo WORDING_NEW_PASSWORD; ?><span class="small">Minimum 6 chars</span></label>
    <input id="user_password_new" type="password" name="user_password_new" required autocomplete="off" />

    <label for="user_password_repeat"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?><span class="small">*Required</span></label>
    <input id="user_password_repeat" type="password" name="user_password_repeat" required autocomplete="off" />

	<div style="clear:both;"></div>
	<br />
	<button class="plain-btn"><?php echo WORDING_CHANGE_PASSWORD; ?></button>
	<br />

    <!-- <input type="submit" name="user_edit_submit_password" value="<?php echo WORDING_CHANGE_PASSWORD; ?>" /> -->
</form>

<div class="settings-title"><em>Update Personal Info</em></div>
<!-- edit form for user's info / this form uses the HTML5 attribute "required" -->
<form method="post" action="/login/?edit=info" name="user_edit_form_info">
	<input type="hidden" id="user_edit_submit_info" name="user_edit_submit_info" value="1" />
    <label for="user_first_name"><?php echo WORDING_FIRST_NAME; ?><span class="small">*Optional</span></label>
    <input id="user_first_name" type="text" name="user_first_name" maxlength="64" value="<?php if (isset($user->user_first_name)) echo $user->user_first_name; ?>" />

	<label for="user_last_name"><?php echo WORDING_LAST_NAME; ?><span class="small">*Optional</span></label>
    <input id="user_last_name" type="text" name="user_last_name" maxlength="64" value="<?php if (isset($user->user_last_name)) echo $user->user_last_name; ?>" />

    <label for="user_job_title"><?php echo WORDING_JOB_TITLE; ?><span class="small">*Optional</span></label>
    <input id="user_job_title" type="text" name="user_job_title" maxlength="64" value="<?php if (isset($user->user_job_title)) echo $user->user_job_title; ?>" />

    <label for="user_phone"><?php echo WORDING_PHONE; ?><span class="small">*Optional</span></label>
    <input id="user_phone" type="text" name="user_phone" maxlength="20" value="<?php if (isset($user->user_phone)) echo $user->user_phone; ?>" />

	<label for="user_mobile"><?php echo WORDING_MOBILE; ?><span class="small">*Optional</span></label>
    <input id="user_mobile" type="text" name="user_mobile" maxlength="20" value="<?php if (isset($user->user_mobile)) echo $user->user_mobile; ?>" />

	<label for="user_zip_code"><?php echo WORDING_ZIP_CODE; ?><span class="small">*Optional</span></label>
    <input id="user_zip_code" type="text" name="user_zip_code" maxlength="10" value="<?php if (isset($user->user_zip_code)) echo $user->user_zip_code; ?>" />

	<div style="clear:both;"></div>
	<br />
	<button class="plain-btn"><?php echo WORDING_CHANGE_INFO; ?></button>
	<br />

    <!-- <input type="submit" name="user_edit_submit_info" value="<?php echo WORDING_CHANGE_PASSWORD; ?>" /> -->
</form>

<br /><br />
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
