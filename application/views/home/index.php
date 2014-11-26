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

<?php
$msg = '';
// show potential errors / feedback (from login object)
    if (isset($_SESSION['login_errors'])) {
        foreach ($_SESSION['login_errors'] as $error) {
            $msg .= $error." ";
        }
		echo "<script>openModal('error','".$msg."')</script>";
    }
    if (isset($_SESSION['login_messages'])) {
        foreach ($_SESSION['login_messages'] as $message) {
            $msg .= $message." ";
        }
		echo "<script>openModal('info','".$msg."')</script>";
    }
?>

	<div id="login">
		<h1>Application Login</h1>
		<br />
		<form name="login" action="/login/index.php" method="post">
			<input id="username" name="user_name" type="text" placeholder="Enter Username" required />
			<br />
			<input id="password" name="user_password" type="password" placeholder="Enter Password" autocomplete="off" required />
			<br /><br />
			<input type="checkbox" id="remember-me" name="user_rememberme" value="1" />
			<label for="remember-me"><span><span></span></span>Remember Me<!-- <em>(for 2 weeks)</em>--></label>
			<br /><br />
			<!-- <input id="login-btn" name="login" type="submit" value="Login" /> -->
			<input name="login" type="hidden" value="1" />
			<button id="login-btn">Login<img src="/public/img/btn_login.png" style="width:40px;height:40px;border:0;vertical-align:middle;margin:-6px 0 0 10px;" /></button>
		</form>
		<br />
		Not a member? <a href="/login/?register" class="content-link">Register Now</a>.<br />
		Forgot password? <a href="/login/?reset" class="content-link">Reset Password</a>.
	</div>
	<br />
</div>

