<!-- begin modal window area -->
<div id="policy-popup"></div>
<div id="policy-window">
	<div id="policy-text">
		<div class="policy-message"></div>
		<button class="plain-btn-close">Close</button>
	</div>
	<div id="policy-edit">
		<div class="policy-message"></div>
			<form id="policy_entry_form" name="policy_entry_form">
			<input type="hidden" id="id" name="id" value="-2" />
<!-- begin edit left box -->
		<div class="edit-left-box">
			<div class="policy-entry-field">
				First Name: 
				<input type="text" maxlength="40" id="policy_first_name" name="policy_first_name" placeholder="Customer First Name" value="" />
				&nbsp;&nbsp;&nbsp;
				Last Name: 
				<input type="text" maxlength="40" id="policy_last_name" name="policy_last_name" placeholder="Customer Last Name" value="" />
			</div>
			<div class="policy-entry-field">
				Description: 
				<input type="text" maxlength="100" style="width:340px;" id="policy_description" name="policy_description" placeholder="Enter a Brief Description" value="" />
			</div>
			<div class="policy-entry-field">
				Premium: 
				<span style="font-size:12px;font-weight:bold;">$</span> <input style="width:50px;" type="text" maxlength="20" id="policy_premium" name="policy_premium" placeholder="0.00" value="" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Zip Code <em>(Optional)</em>: 
				<input style="width:50px;" type="text" maxlength="11" id="policy_zip" name="policy_zip" placeholder="90210" value="" />
			</div>
			<div class="policy-entry-field">
				Notes:<br />
				<textarea style="width:420px;height:45px;" id="policy_notes" name="policy_notes" placeholder="Describe this policy or add keywords" value=""></textarea>
			</div>
		</div>
<!-- end edit left box -->
<!-- begin edit right box -->
	<div class="edit-right-box">
		<div class="edit-table-container">
			<div class="edit-heading">
				<div class="edit-col">Category:</div>
				<div class="edit-col">
					<select class="policy-entry-select" id="policy_sub_category" name="policy_sub_category">
						<option value="0">- Select -</option>
<?php foreach ($policy_categories as $category) { ?>
                			<option value="<?php echo $category->id; ?>"><?php if ($category->parent_id == 0) { echo $category->name; } else { echo '&nbsp;&nbsp;-'.$category->name; } ?></option>
<?php } ?>
					</select>
				</div>
			</div>
			<div class="edit-table-row">
				<div class="edit-col">Business Type:</div>
				<div class="edit-col">
					<select class="policy-entry-select" id="policy_business_type" name="policy_business_type">
						<option value="0">- Select -</option>
<?php foreach ($policy_business_types as $business_types) { ?>
                			<option value="<?php echo $business_types->id; ?>"><?php echo $business_types->name; ?></option>
<?php } ?>
					</select>
				</div>
			</div>
			<div class="edit-table-row">
				<div class="edit-col">Sold By:</div>
				<div class="edit-col">
					<select class="policy-entry-select" id="policy_team_member" name="policy_team_member">
						<option value="0">- Select -</option>
<?php foreach ($agency_employees as $employee) { ?>
                			<option value="<?php echo $employee->user_id; ?>"><?php echo $employee->user_first_name.' '.$employee->user_last_name; ?></option>
<?php } ?>
					</select>
				</div>
			</div>
			<div class="edit-table-row">
				<div class="edit-col">Lead Source:</div>
				<div class="edit-col">
					<select class="policy-entry-select" id="policy_source_type" name="policy_source_type">
						<option value="0">- Select -</option>
<?php foreach ($policy_source_types as $source_types) { ?>
                			<option value="<?php echo $source_types->id; ?>"><?php echo $source_types->name; ?></option>
<?php } ?>
					</select>
				</div>
			</div>
			<div class="edit-table-row">
				<div class="edit-col">Policy Length:</div>
				<div class="edit-col">
					<select class="policy-entry-select" id="policy_length_type" name="policy_length_type">
						<option value="0">- Select -</option>
<?php foreach ($policy_length_types as $length_types) { ?>
                			<option value="<?php echo $length_types->id; ?>"><?php echo $length_types->name; ?></option>
<?php } ?>
					</select>
				</div>
			</div>
		</div>
	</div>
<!-- end edit right box -->

<!--
			<div id="policy-entry-field">
				<div class="policy-left">Date Written</div>
				<div class="policy-right"><input id="policy_date_written" name="policy_date_written" class="policy-date" placeholder="" readonly /></div>
			</div>
			<div id="policy-entry-field">
				<div class="policy-left">Date Issued</div>
				<div class="policy-right"><input id="policy_date_issued" name="policy_date_issued" class="policy-date" placeholder="" readonly /></div>
			</div>
			<div id="policy-entry-field">
				<div class="policy-left">Date Effective</div>
				<div class="policy-right"><input id="policy_date_effective" name="policy_date_effective" class="policy-date" placeholder="" readonly /></div>
			</div>
-->

			<div style="clear:both;"></div>
			</form>
			<br />
		<button class="plain-btn-close">Cancel</button>&nbsp;&nbsp;&nbsp;<button id="policy-add" data-type="add" class="plain-btn">Add</button><button id="policy-save" data-type="edit" class="plain-btn">Save</button>
	</div>
	<div id="policy-delete">
		<div class="policy-message"></div>
			Are you sure you want to &quot;ERASE&quot; this Policy?<br /><br />Click &quot;Cancel&quot; if you want to keep this policy.<br /><br />
			<form id="policy_delete_form" name="policy_delete_form">
			<input type="hidden" id="id" name="id" value="-2" />
			</form>
			<br />
		<button class="plain-btn-close">Cancel</button>&nbsp;&nbsp;&nbsp;<button id="policy-disable" class="plain-btn">Erase</button>
	</div>
	<br /><br />
</div>
<!-- end modal window area -->