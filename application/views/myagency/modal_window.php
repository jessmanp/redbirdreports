<!-- begin modal window area -->
<div id="myagency-popup"></div>
<div id="myagency-window">

<div class="modal-required-key"><sup>*</sup>Required Field(s)</div>

	<div id="myagency-text">
		<div class="myagency-message"></div>
		<p class="myagency-text-box"></p>
<div class="myagency-edit-bar"></div>
		<button class="plain-btn-close">Close</button>
	</div>


	<div id="myagency-delete">
		<div class="myagency-message"></div>
			Are you sure you want to &quot;<strong>DEACTIVATE</strong>&quot; this Employee?<br /><br />Click &quot;<strong>Close</strong>&quot; if you want to keep this employee active.<br />
			<p class="myagency-delete-box"></p>
			<form id="employee_delete_form" name="employee_delete_form">
			<div style="margin:20px 0 25px 0;">
				You <strong>MUST</strong> transfer all policies when you deactivate an Employee.<br /><br />
				Select the <strong>EMPLOYEE</strong> you want to <strong>TRANSFER</strong> all policies to:<br /><br />
				<select id="swapid" name="swapid">
					<option value="0">- Select -</option>
				</select>
			</div>
			<input type="hidden" id="delid" name="delid" value="-2" />
			</form>
<div class="myagency-edit-bar"></div>
		<button class="plain-btn-close">Close</button>&nbsp;&nbsp;&nbsp;<button id="employee_delete" class="plain-btn">Yes</button>
	</div>
	
	<div id="myagency-undelete">
		<div class="myagency-message"></div>
			Are you sure you want to &quot;<strong>REACTIVATE</strong>&quot; this Employee?<br /><br />Click &quot;<strong>Close</strong>&quot; if you want to keep this employee inactive.<br />
			<p class="myagency-delete-box"></p>
			<form id="employee_undelete_form" name="employee_undelete_form">
			<input type="hidden" id="udelid" name="udelid" value="-2" />
			</form>
<div class="myagency-edit-bar"></div>
		<button class="plain-btn-close">Close</button>&nbsp;&nbsp;&nbsp;<button id="employee_undelete" class="plain-btn">Yes</button>
	</div>
	
	<div id="myagency-save-employee">
		<div class="myagency-message"></div>
			<strong>NOTICE:</strong> Commission changes will only effect open and future periods.<br /><br />
			Do you want to close out any periods before you &quot;<strong>UPDATE</strong>&quot; this Employee?<br /><br />
			Click &quot;<strong>No</strong>&quot; if you want to update this Employee.<br />
<div class="myagency-edit-bar"></div>
		<button id="employee_update" class="plain-btn">No</button>&nbsp;&nbsp;&nbsp;<button id="employee_close_periods" class="plain-btn">Yes</button>
	</div>
	
	
	<div id="employee-invite">
		<div style="clear:both;"><br /></div>
		<img src="/public/img/employee_edit_icon.png" class="employee-icon" style="margin:-5px 0 0 230px;" alt=""><div class="employee-title">Add / Invite New Employee</div>
		<div style="clear:both;"><br /></div>
			
		<div style="text-align:right;margin:0 172px 0 0;">
			<!-- form for adding employees -->
			<form method="post" action="/home/inviteEmployeeSetup" id="agency_invite_employee" name="agency_invite_employee">

				<input type="hidden" id="agency_id" name="agency_id" value="<?php echo $agency_id; ?>" />

				<label for="employee_first_name">First Name<sup>*</sup></label>
				<input id="employee_first_name" style="width:135px;" type="text" name="employee_first_name" maxlength="64" placeholder="Enter First Name" required />
				&nbsp;
				<label for="employee_last_name">Last Name<sup>*</sup></label>
				<input id="employee_last_name" style="width:130px;" type="text" name="employee_last_name" maxlength="64" placeholder="Enter Last Name" required />
				<br />
				<label for="employee_email">Email<sup>*</sup></label>
				<input id="employee_email" style="width:380px;" type="email" name="employee_email" maxlength="64" placeholder="Enter Email" required />
				<br />
				<label for="employee_email_verify">Verify Email<sup>*</sup></label>
				<input id="employee_email_verify" style="width:380px;" type="email" name="employee_email_verify" maxlength="64" placeholder="Enter Email Again" required />
				<br /><br />
			</div>
				<label for="employee_type">User Type<sup>*</sup></label>
				<select class="main-select" id="employee_type" name="employee_type" required>
					<option value="">- Select -</option>
					<option value="0">Employee</option>
					<option value="1">Manager</option>
					<!--<option value="2">Administrator</option>-->
				</select>
				<br /><br /><br />
				<button id="close-add-employee-btn" class="plain-btn-close">Close</button>&nbsp;&nbsp;&nbsp;<button id="add-employee-btn" class="plain-btn">Add / Invite Employee</button>
				<br />
			</form>
	</div>

<br />
</div>
<!-- end modal window area -->