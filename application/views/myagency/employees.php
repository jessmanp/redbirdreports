<!-- begin content area -->
<div id="myagency-content">
	<div id="myagency-container">
	
		<button id="invite-employee">Add / Invite Employee&nbsp;&nbsp;<img src="/public/img/btn_invite.png" class="search-btn-icon" alt=""></button>
		<!-- form to resend invite email -->
		<form id="reinvite_employee" name="reinvite_employee">
			<input type="hidden" id="reinvite_employee_id" name="reinvite_employee_id" value="-2" />
			<button id="resend-invite-employee">Resend Invitation Email&nbsp;&nbsp;<img src="/public/img/btn_reinvite.png" class="search-btn-icon" alt=""></button>
		</form>
		<!-- form to remove invited employee -->
		<form id="remove_employee" name="remove_employee">
			<input type="hidden" id="remove_employee_id" name="remove_employee_id" value="-2" />
			<button id="remove-invite-employee">Erase Invited Employee</button>
		</form>

		<div id="agency-employee-box">
			<strong>Modify Employee</strong><br />
			<div class="agency-employee-name">
				<div id="emp_default_label">No Employee Selected</div>
				<span id="emp_first_label"></span><br />
				<span id="emp_last_label"></span><br />
			</div>
			<select id="agency_employees" name="agency_employees" class="policy-entry-select">
				<option value="0">- Select -</option>
			</select>
		</div>
		
	</div>
	
	<div id="agency-employee-current">
			<img src="/public/img/employee_edit_icon.png" class="employee-icon" alt=""><div class="employee-title">Edit Employee</div>
			<div style="clear:both;"><br /></div>
			
			<!-- form for editing employees -->
			<form id="agency_update_employee" name="agency_update_employee">

				<input type="hidden" id="agency_id" name="agency_id" value="<?php echo $agency_id; ?>" />
				<input type="hidden" id="employee_id" name="employee_id" value="-2" />

				<label for="employee_first_name">First Name<sup>*</sup>:</label>
				<input id="employee_first_name_field" style="width:115px;" type="text" name="employee_first_name" maxlength="64" placeholder="First Name" required />
				&nbsp;
				<label for="employee_last_name">Last Name<sup>*</sup>:</label>
				<input id="employee_last_name_field" style="width:110px;" type="text" name="employee_last_name" maxlength="64" placeholder="Last Name" required />
				&nbsp;
				<label for="employee_job_title">Job Title:</label>
				<input id="employee_job_title_field" style="width:110px;" type="text" name="employee_job_title" maxlength="64" placeholder="Job Title" />
				<br />
				<label for="employee_email">Email<sup>*</sup>:</label>
				<input id="employee_email_field" style="width:205px;" type="email" name="employee_email" maxlength="64" placeholder="Email" required />
				&nbsp;
				<label for="employee_email_verify">Verify Email<sup>*</sup>:</label>
				<input id="employee_email_verify_field" style="width:208px;" type="email" name="employee_email_verify" maxlength="64" placeholder="Verfiy Email" required />
				<br />
				<label for="employee_phone">Phone:</label>
				<input id="employee_phone_field" style="width:140px;" type="text" name="employee_phone" maxlength="64" placeholder="Phone" />
				&nbsp;
				<label for="employee_mobile">Mobile:</label>
				<input id="employee_mobile_field" style="width:140px;" type="text" name="employee_mobile" maxlength="64" placeholder="Mobile" />
				&nbsp;
				<label for="employee_zip_code">Zip Code:</label>
				<input id="employee_zip_code_field" style="width:85px;" type="text" name="employee_zip_code" maxlength="64" placeholder="Zip Code" />
				<br />
				<label for="employee_username">Username<sup>*</sup>:</label>
				<input id="employee_username_field" style="width:180px;" type="text" name="employee_username" maxlength="64" placeholder="Username" />
				&nbsp;
				<label for="employee_type">User Type<sup>*</sup>:</label>
				<select class="short-select" id="employee_type_field" name="employee_type" required>
					<option value="">- Select -</option>
					<option value="0">Employee</option>
					<option value="1">Manager</option>
					<option value="2">Administrator</option>
				</select>
				&nbsp;
				Hire Date:<input id="employeehiredate" name="employee_hire_date" placeholder="01/01/2001">
				<br />
				
				<div style="text-align:center;margin:25px 0 15px 10px;padding:10px;background-color:#a20004;color:#ffffff;">
					Commission Settings
				</div>
				<div style="text-align:center;padding:0 0 0 10px;background-color:#ffffff;">
					<div class="table-container">
						<!--- begin percetage area --->
						<div class="table-row">
							<div class="col" style="width:20%;">&nbsp;</div>
							<div class="col" style="width:16%;"><strong>New</strong></div>
							<div class="col" style="width:16%;"><strong>Added</strong></div>
							<div class="col" style="width:16%;"><strong>Reinstated</strong></div>
							<div class="col" style="width:16%;"><strong>Transferred</strong></div>
							<div class="col" style="width:16%;"><strong>Renewal</strong></div>
						</div>
						<div class="table-row">
							<div class="col" style="width:20%;background-color:#cccccc;"><span class="table-title"><strong>Auto</strong><sup>*</sup></span></div>
							<div class="col" style="width:16%;background-color:#eeeeee;"><input type="text" id="employee_auto_new" name="employee_auto_new" placeholder="0%"></div>
							<div class="col" style="width:16%;background-color:#eeeeee;"><input type="text" id="employee_auto_added" name="employee_auto_added" placeholder="0%"></div>
							<div class="col" style="width:16%;background-color:#eeeeee;"><input type="text" id="employee_auto_reinstated" name="employee_auto_reinstated" placeholder="0%"></div>
							<div class="col" style="width:16%;background-color:#eeeeee;"><input type="text" id="employee_auto_transferred" name="employee_auto_transferred" placeholder="0%"></div>
							<div class="col" style="width:16%;background-color:#eeeeee;"><input type="text" id="employee_auto_renewal" name="employee_auto_renewal" placeholder="0%"></div>
						</div>
						<br />
						<div class="table-row">
							<div class="col" style="width:20%;">&nbsp;</div>
							<div class="col" style="width:16%;"><strong>New</strong></div>
							<div class="col" style="width:16%;"><strong>Added</strong></div>
							<div class="col" style="width:16%;"><strong>Reinstated</strong></div>
							<div class="col" style="width:16%;"><strong>Transferred</strong></div>
							<div class="col" style="width:16%;"><strong>Renewal</strong></div>
						</div>
						<div class="table-row">
							<div class="col" style="width:20%;background-color:#cccccc;"><span class="table-title"><strong>Fire</strong><sup>*</sup></span></div>
							<div class="col" style="width:16%;background-color:#eeeeee;"><input type="text" id="employee_fire_new" name="employee_fire_new" placeholder="0%"></div>
							<div class="col" style="width:16%;background-color:#eeeeee;"><input type="text" id="employee_fire_added" name="employee_fire_added" placeholder="0%"></div>
							<div class="col" style="width:16%;background-color:#eeeeee;"><input type="text" id="employee_fire_reinstated" name="employee_fire_reinstated" placeholder="0%"></div>
							<div class="col" style="width:16%;background-color:#eeeeee;"><input type="text" id="employee_fire_transferred" name="employee_fire_transferred" placeholder="0%"></div>
							<div class="col" style="width:16%;background-color:#eeeeee;"><input type="text" id="employee_fire_renewal" name="employee_fire_renewal" placeholder="0%"></div>
						</div>
						<br />
						<div class="table-row">
							<div class="col" style="width:20%;">&nbsp;</div>
							<div class="col" style="width:16%;"><strong>New</strong></div>
							<div class="col" style="width:16%;"><strong>$ / Policy</strong></div>
							<div class="col" style="width:16%;">&nbsp;</div>
							<div class="col" style="width:16%;">&nbsp;</div>
							<div class="col" style="width:16%;">&nbsp;</div>
						</div>
						<div class="table-row">
							<div class="col" style="width:20%;background-color:#cccccc;"><span class="table-title"><strong>Life</strong><sup>*</sup></span></div>
							<div class="col" style="width:16%;background-color:#eeeeee;"><input type="text" id="employee_life_new" name="employee_life_new" placeholder="0%"></div>
							<div class="col" style="width:16%;background-color:#eeeeee;"><strong>$</strong> <input type="text" id="employee_life_policy" name="employee_life_policy" placeholder="0.00"></div>
							<div class="col" style="width:16%;background-color:#eeeeee;">&nbsp;</div>
							<div class="col" style="width:16%;background-color:#eeeeee;">&nbsp;</div>
							<div class="col" style="width:16%;background-color:#eeeeee;">&nbsp;</div>
						</div>
						<br />
						<div class="table-row">
							<div class="col" style="width:20%;">&nbsp;</div>
							<div class="col" style="width:16%;"><strong>New</strong></div>
							<div class="col" style="width:16%;"><strong>$ / Policy</strong></div>
							<div class="col" style="width:16%;">&nbsp;</div>
							<div class="col" style="width:16%;">&nbsp;</div>
							<div class="col" style="width:16%;">&nbsp;</div>
						</div>
						<div class="table-row">
							<div class="col" style="width:20%;background-color:#cccccc;"><span class="table-title"><strong>Health</strong><sup>*</sup></span></div>
							<div class="col" style="width:16%;background-color:#eeeeee;"><input type="text" id="employee_health_new" name="employee_health_new" placeholder="0%"></div>
							<div class="col" style="width:16%;background-color:#eeeeee;"><strong>$</strong> <input type="text" id="employee_health_policy" name="employee_health_policy" placeholder="0.00"></div>
							<div class="col" style="width:16%;background-color:#eeeeee;">&nbsp;</div>
							<div class="col" style="width:16%;background-color:#eeeeee;">&nbsp;</div>
							<div class="col" style="width:16%;background-color:#eeeeee;">&nbsp;</div>
						</div>
						<br />
						<div class="table-row">
							<div class="col" style="width:20%;">&nbsp;</div>
							<div class="col" style="width:16%;"><strong>$ / Deposit</strong></div>
							<div class="col" style="width:16%;"><strong>$ / Loan</strong></div>
							<div class="col" style="width:16%;"><strong>$ / Fund</strong></div>
							<div class="col" style="width:16%;">&nbsp;</div>
							<div class="col" style="width:16%;">&nbsp;</div>
						</div>
						<div class="table-row">
							<div class="col" style="width:20%;background-color:#cccccc;"><span class="table-title"><strong>Bank</strong><sup>*</sup></span></div>
							<div class="col" style="width:16%;background-color:#eeeeee;"><strong>$</strong> <input type="text" id="employee_bank_deposit_product" name="employee_bank_deposit_product" placeholder="0.00"></div>
							<div class="col" style="width:16%;background-color:#eeeeee;"><strong>$</strong> <input type="text" id="employee_bank_loan_product" name="employee_bank_loan_product" placeholder="0.00"></div>
							<div class="col" style="width:16%;background-color:#eeeeee;"><strong>$</strong> <input type="text" id="employee_bank_fund_product" name="employee_bank_fund_product" placeholder="0.00"></div>
							<div class="col" style="width:16%;background-color:#eeeeee;">&nbsp;</div>
							<div class="col" style="width:16%;background-color:#eeeeee;">&nbsp;</div>
						</div>
						<!--- end percetage area --->
					</div>
				</div>
				
				<br /><br />
				<button id="agency_employee_save" data-type="save" class="plain-btn">Update Employee</button>&nbsp;&nbsp;&nbsp;
				<button id="agency_employee_erase" data-type="delete" class="plain-btn-erase" style="margin-right:135px;">Deactivate Employee</button>
				<button id="agency_employee_restore" data-type="restore" class="plain-btn-erase" style="margin-right:135px;">Reactivate Employee</button>
			</form>
			<div class="myagency-required-key"><sup>*</sup>Required Field(s)</div>
	</div>
	<br />
	<br />
	<div style="clear:both;">&nbsp;</div>
	
</div>
<!-- end content area -->
<script>
/* <![CDATA[ */

// LOAD
$(document).ready(function() {

	var url = "<?php echo $url; ?>";
	$("#employees").css("background-color","#000000");
	
});

/* ]]> */
</script>
