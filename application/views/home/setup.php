<div id="info-window">
	<div class="info-title">Account Setup Progress<div id="info-arrow" class="arrow-up-dark"></div></div>
	<div class="meter red nostripes"><span style="width:0%"></span></div>
	<div id="progress"></div>
</div>

<div id="user-panel">
	<div class="user-box-settings">
		<div id="menu-link-dead" class="button-select">
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
	<img id="settings-logo" src="<?php echo URL; ?>public/img/agency_nerd_app_logo.png" class="home-logo" alt="" />
 	<!-- <div class="button-right"><div class="icon-user"></div></div> -->
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

<h1>Account Configuration</h1>

<p>Welcome to Agency Nerd! Thank you for comfirming your registration. In order to complete your account setup we need a bit more information from you. Please take a moment to configure your account in three easy steps. If you need help you can email us at <a href="mailto:support@agencynerd.com">support@agencynerd.com</a> or <a href="#">watch our video</a> to get more details on how to complete this configuration.</p><p><strong>Open each section below to enter your information.</strong></p>

	<div class="signup">

		<div class="signup-header"><div class="step-number"><span>1</span></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agency Information<div id="setup-arrow" class="arrow-down"></div></div>
	   	<div id="signup-agency">
<br />
<!-- edit form for agency info -->
<form method="post" action="/home/saveAgencySetup" id="signup_agency_info" name="signup_agency_info">

    <label for="agency_name">Agency Name<span class="small">*Required</span></label>
    <input id="agency_name" type="text" name="agency_name" maxlength="64" placeholder="Enter Name" required />

	<label for="agancy_address">Address<span class="small">*Optional</span></label>
    <input id="agency_address" type="text" name="agency_address" maxlength="255" placeholder="Enter Address" />

	<label for="agency_city">City<span class="small">*Optional</span></label>
    <input id="agency_city" type="text" name="agency_city" maxlength="64" placeholder="Enter City" />

	<label for="agency_state">State<span class="small">*Optional</span></label>
    <input id="agency_state" type="text" name="agency_state" maxlength="4" placeholder="Enter State" />

	<label for="agency_zip_code">Zip Code<span class="small">*Required</span></label>
    <input id="agency_zip_code" type="text" name="agency_zip_code" maxlength="10" placeholder="Enter Zip Code" />

    <label for="agency_phone">Phone<span class="small">*Optional</span></label>
    <input id="agency_phone" type="text" name="agency_phone" maxlength="20" placeholder="Enter Phone" />

	<div style="clear:both;"></div>
</form>
	<br />
	<button id="next-step1" class="small-btn">Next</button>
	<br />
<br />
	   	</div>

		<div class="signup-middle"><div class="step-number"><span>2</span></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Invite Employee(s)<div id="setup-arrow" class="arrow-down"></div></div>
	   	<div id="signup-employees">
<br />
<!-- edit form for adding employees -->
<form method="post" action="/home/inviteEmployeeSetup" id="setup_invite_employee" name="setup_invite_employee">

	<input type="hidden" id="agency_id" name="agency_id" value="<?php echo $agency_id; ?>" />

	<label for="employee_first_name">First Name<span class="small">*Required</span></label>
    <input id="employee_first_name" type="text" name="employee_first_name" maxlength="64" placeholder="Enter Name" required />

	<label for="employee_last_name">Last Name<span class="small">*Required</span></label>
    <input id="employee_last_name" type="text" name="employee_last_name" maxlength="64" placeholder="Enter Surname" required />
	
    <label for="employee_email">Email<span class="small">*Valid e-mail only</span></label>
    <input id="employee_email" type="email" name="employee_email" maxlength="64" placeholder="Enter Email" required />

	<label for="employee_email_verify">Email<span class="small">*Valid e-mail again</span></label>
    <input id="employee_email_verify" type="email" name="employee_email_verify" maxlength="64" placeholder="Enter Email" required />

	<label for="employee_type">User Type<span class="small">*Required</span></label>
    <select class="main-select" id="employee_type" name="employee_type" required>
		<option value="">- Select -</option>
		<option value="0">Employee</option>
		<option value="1">Manager</option>
		<option value="2">Admin</option>
	</select><div class="main-select-after" data="user_type">&#x25Be;</div>
	
	<div style="clear:both;"></div>
	<br />
	<button class="plain-btn">Invite Employee</button>
	<br />
</form>
	<br />
	<button id="next-step2" class="small-btn">Next</button>
	<br />
<br />
	   	</div>

		<div id="signup-footer" class="signup-footer"><div class="step-number"><span>3</span></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Setup Employee(s)<div id="setup-arrow" class="arrow-down"></div></div>
	   	<div id="signup-compensation">
<br />
<!-- edit form for adding compensation plans -->
<form method="post" action="" id="setup_employee_compensation" name="setup_employee_compensation">

	<label for="employees_compensation">Employee<span class="small">*Select to Update</span></label>
    <select class="main-select" id="employees_compensation" name="employees_compensation" required>
		<option value="">- Select -</option>
	</select><div class="main-select-after" data="compensation_status">&#x25Be;</div>


<div class="settings-title"><em>Employee Rate</em></div>


	<label for="compensation_type">Hourly<span class="small">*Required</span></label><input class="input-mini" type="radio" id="compensation_type1" name="compensation_type" value="1" checked /><span><span></span></span>

	<label class="label-inline" for="compensation_type">Salary</label><input class="input-inline" type="radio" id="compensation_type2" name="compensation_type" value="2" /><span><span></span></span>

	<label for="compensation_rate">Rate<span class="small">*Required</span></label>
    <div class="input-short-before">$</div><input class="input-short" id="compensation_rate" type="text" name="compensation_rate" placeholder="0.00" required /><div id="rate-text" class="input-after">per hour</div>

	<label for="compensation_other">Other<span class="small">*Optional</span></label>
    <div class="input-short-before">$</div><input class="input-short" id="compensation_other" type="text" name="compensation_other" placeholder="0.00" /><div class="input-after">per month</div>

	<label for="compensation_draw">Draw<span class="small">*Optional</span></label>
	<input type="checkbox" id="compensation_draw" name="compensation_draw" value="1" /><span><span></span></span>


<div class="settings-title"><em>Employee Commission</em><span class="footnote"><sup>*</sup></span></div>

	<div class="commission-title">New Policies</div>

	<div class="commission-fields">

		<label for="commission_auto_new">Auto<span class="small">*Required</span></label>
    		<input class="input-percent" id="commission_auto_new" type="text" name="commission_auto_new" placeholder="0" required /><div class="input-after">&#37;</div>

		<label for="commission_fire_new">Fire<span class="small">*Required</span></label>
    		<input class="input-percent" id="commission_fire_new" type="text" name="commission_fire_new" placeholder="0" required /><div class="input-after">&#37;</div>

		<label for="commission_life">Life<span class="small">*Required</span></label>
    		<input class="input-percent" id="commission_life" type="text" name="commission_life" placeholder="0" required /><div class="input-after">&#37;</div>

		<label for="commission_health">Health<span class="small">*Required</span></label>
    		<input class="input-percent" id="commission_health" type="text" name="commission_health" placeholder="0" required /><div class="input-after">&#37;</div>
	
	</div>

	<div class="commission-inline-title">Renew Policies</div>

	<div class="commission-inline-fields">

		<label for="commission_auto_renew">Auto<span class="small">*Required</span></label>
    		<input class="input-percent" id="commission_auto_renew" type="text" name="commission_auto_renew" placeholder="0" required /><div class="input-after">&#37;</div>

		<label for="commission_fire_renew">Fire<span class="small">*Required</span></label>
    		<input class="input-percent" id="commission_fire_renew" type="text" name="commission_fire_renew" placeholder="0" required /><div class="input-after">&#37;</div>

		<label for="commission_life_renew">Life<span class="small">*Required</span></label>
    		<input class="input-percent" id="commission_life_renew" type="text" name="commission_life_renew" placeholder="0" required /><div class="input-after">&#37;</div>

		<label for="commission_health_renew">Health<span class="small">*Required</span></label>
    		<input class="input-percent" id="commission_health_renew" type="text" name="commission_health_renew" placeholder="0" required /><div class="input-after">&#37;</div>

	</div>

	<div style="clear:both;"></div>

	<span class="footnote"><sup>*</sup>Percentage of agency revenue (not premium)</span>

	<br /><br />
	<button id="update_employee" class="plain-btn">Update Compensation</button>
	<br />
</form>
	<br />
	<button id="next-step3" class="small-btn">Next</button>
	<br />
<br />
	   	</div>

	</div>


<br />
<button id="save_setup" class="plain-btn">Save &amp; Continue</button>
<br /><br />

</div>
<br />
</div>