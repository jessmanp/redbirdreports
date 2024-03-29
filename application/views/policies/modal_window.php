<!-- begin modal window area -->
<div id="policy-popup"></div>
<div id="policy-window">


	<div id="policy-text">
		<div class="policy-message"></div>
		<p class="policy-text-box"></p>
<div class="policy-edit-bar"></div>
		<button class="plain-btn-close">Close</button>
	</div>


	<div id="policy-delete">
		<div class="policy-message"></div>
			Are you sure you want to &quot;<strong>ERASE</strong>&quot; this Policy?<br /><br /><em><strong>Warning:</strong> This will permanently erase this policy.</em><br /><br />Click &quot;<strong>Cancel</strong>&quot; if you want to keep this policy.<br />
			<p class="policy-delete-box"></p>
			<form id="policy_delete_form" name="policy_delete_form">
			<input type="hidden" id="delete_path" name="delete_path" value="" />
			<input type="hidden" id="delid" name="delid" value="-2" />
			</form>
<div class="policy-edit-bar"></div>
		<button class="plain-btn-close">Cancel</button>&nbsp;&nbsp;&nbsp;<button id="policy-disable" class="plain-btn">Yes</button>
	</div>


	<div id="policy-renewal">
		<div class="policy-message"></div>
			This policy is up for &quot;<strong>RENEWAL</strong>&quot;. Do you want to &quot;<strong>RENEW</strong>&quot; this Policy?<br /><br />Click &quot;<strong>Close</strong>&quot; if you DO NOT want to renew this policy. Click &quot;<strong>No</strong>&quot; if you want to cancel this policy.<br />
			<form id="policy_renewal_form" name="policy_renewal_form">
			<input type="hidden" id="renid" name="renid" value="-2" />
			<input type="hidden" id="renew_cancel_info" name="renew_cancel_info" value="" />
			</form>
<div class="policy-edit-bar"></div>
		<button class="plain-btn-close">Close</button>&nbsp;&nbsp;&nbsp;<button id="policy-cancel" class="plain-btn">No</button>&nbsp;&nbsp;&nbsp;<button id="policy-renew" class="plain-btn">Yes</button>
	</div>
	
	
	<div id="policy-do-renew">
	<div class="policy-required-key"><sup>*</sup> Denotes Required Field(s)</div>
		<div class="policy-message"></div>
			This Policy has been &quot;<strong>RENEWED</strong>&quot; successfully. Enter the new &quot;<strong>PREMIUM</strong>&quot; for this Policy.<br />
			<p class="policy-delete-box"></p>
			<form id="policy_renew_premium_form" name="policy_renew_premium_form">
			<input type="hidden" id="renew_path" name="renew_path" value="" />
			<input type="hidden" id="renpid" name="renpid" value="-2" />
			Premium<sup>*</sup>:
			<span style="font-size:12px;font-weight:bold;">$</span> <input style="width:75px;" type="text" maxlength="20" id="renew_premium" name="renew_premium" placeholder="0.00" value="" />
			</form>
<div class="policy-edit-bar"></div>
		<button id="policy-renew-save" class="plain-btn">Save</button>
	</div>

	
	<div id="policy-renew-cancel">
		<div class="policy-message"></div>
			This Policy needs to be &quot;<strong>CANCELED</strong>&quot;. Enter the &quot;<strong>CANCEL DATE</strong>&quot; for this Policy.<br />
			<p class="policy-delete-box"></p>
			<form id="policy_renew_cancel_form" name="policy_renew_cancel_form">
			<input type="hidden" id="renew_cancel_path" name="renew_cancel_path" value="" />
			<input type="hidden" id="rencid" name="rencid" value="-2" />
			Cancel Date<sup>*</sup>:<input id="renew_canceleddate" name="renew_canceleddate" value="" placeholder="" readonly />
			</form>
<div class="policy-edit-bar"></div>
		<button id="policy-renew-cancel-save" class="plain-btn">Save</button>
	</div>



	<div id="policy-reinstate">
		<div class="policy-message"></div>
			This policy is &quot;<strong>CANCELED</strong>&quot;. Do you want to &quot;<strong>REINSTATE</strong>&quot; this Policy?<br /><br />Click &quot;<strong>Cancel</strong>&quot; if you DO NOT want to reinstate this policy.<br />
			<form id="policy_reinstate_form" name="policy_reinstate_form">
			<input type="hidden" id="reinstate_path" name="reinstate_path" value="" />
			<input type="hidden" id="uncid" name="uncid" value="-2" />
			</form>
<div class="policy-edit-bar"></div>
		<button class="plain-btn-close">Cancel</button>&nbsp;&nbsp;&nbsp;<button id="policy-uncancel" class="plain-btn">Yes</button>
	</div>
	
	
	<div id="policy-issued-premium"></div>
	<div id="issued-premium">
			Enter the &quot;<strong>ISSUED</strong>&quot; Premium Amount
<div class="policy-edit-bar"></div>
			Written Premium: <strong>$<span id="written_premium"></span></strong><br />
			Issued Premium: <span style="font-size:12px;font-weight:bold;">$</span> <input style="width:75px;" type="text" maxlength="20" id="policy_issued_amount" name="policy_issued_amount" placeholder="0.00" value="" />
<div class="policy-edit-bar"></div>
		<button id="policy-issued-cancel" class="plain-btn">Cancel</button>&nbsp;&nbsp;&nbsp;<button id="policy-issued-save" class="plain-btn">Continue</button>
	</div>


	<div id="policy-edit">
<div class="policy-required-key"><sup>*</sup> Denotes Required Field(s)</div>
		<div class="policy-message"></div>
			<form id="policy_entry_form" name="policy_entry_form">
			<input type="hidden" id="edit_path" name="edit_path" value="" />
			<input type="hidden" id="id" name="id" value="-2" />
			<input type="hidden" id="status" name="status" value="-2" />
			<input type="hidden" id="captionsmain" name="captionsmain" value='<option value="0">- Select -</option><?php foreach ($policy_categories_main as $category) { ?><option value="<?php echo $category->id; ?>"><?php if ($category->parent_id == 0) { echo $category->name; } else { echo "&nbsp;&nbsp;-".$category->name; } ?></option><?php } ?>' />
			<input type="hidden" id="captionsall" name="captionsall" value='<option value="0">- Select -</option><?php foreach ($policy_categories_all as $category) { ?><option value="<?php echo $category->id; ?>"><?php if ($category->parent_id == 0) { echo $category->name; } else { echo "&nbsp;&nbsp;-".$category->name; } ?></option><?php } ?>' />
			<input type="hidden" id="captionsauto" name="captionsauto" value='<?php foreach ($policy_categories_auto as $category) { ?><option value="<?php echo $category->id; ?>"<?php if ($category->parent_id == 0) { echo " selected"; } ?>><?php if ($category->parent_id == 0) { echo $category->name; } else { echo "&nbsp;&nbsp;-".$category->name; } ?></option><?php } ?>' />
			<input type="hidden" id="captionsfire" name="captionsfire" value='<?php foreach ($policy_categories_fire as $category) { ?><option value="<?php echo $category->id; ?>"<?php if ($category->parent_id == 0) { echo " selected"; } ?>><?php if ($category->parent_id == 0) { echo $category->name; } else { echo "&nbsp;&nbsp;-".$category->name; } ?></option><?php } ?>' />
			<input type="hidden" id="captionslife" name="captionslife" value='<?php foreach ($policy_categories_life as $category) { ?><option value="<?php echo $category->id; ?>"<?php if ($category->parent_id == 0) { echo " selected"; } ?>><?php if ($category->parent_id == 0) { echo $category->name; } else { echo "&nbsp;&nbsp;-".$category->name; } ?></option><?php } ?>' />
			<input type="hidden" id="captionshealth" name="captionshealth" value='<?php foreach ($policy_categories_health as $category) { ?><option value="<?php echo $category->id; ?>"<?php if ($category->parent_id == 0) { echo " selected"; } ?>><?php if ($category->parent_id == 0) { echo $category->name; } else { echo "&nbsp;&nbsp;-".$category->name; } ?></option><?php } ?>' />
			<input type="hidden" id="captionsdeposit" name="captionsdeposit" value='<?php foreach ($policy_categories_deposit as $category) { ?><option value="<?php echo $category->id; ?>"<?php if ($category->parent_id == 0) { echo " selected"; } ?>><?php if ($category->parent_id == 0) { echo $category->name; } else { echo "&nbsp;&nbsp;-".$category->name; } ?></option><?php } ?>' />
			<input type="hidden" id="captionsloan" name="captionsloan" value='<?php foreach ($policy_categories_loan as $category) { ?><option value="<?php echo $category->id; ?>"<?php if ($category->parent_id == 0) { echo " selected"; } ?>><?php if ($category->parent_id == 0) { echo $category->name; } else { echo "&nbsp;&nbsp;-".$category->name; } ?></option><?php } ?>' />
			<input type="hidden" id="captionsfund" name="captionsfund" value='<?php foreach ($policy_categories_fund as $category) { ?><option value="<?php echo $category->id; ?>"<?php if ($category->parent_id == 0) { echo " selected"; } ?>><?php if ($category->parent_id == 0) { echo $category->name; } else { echo "&nbsp;&nbsp;-".$category->name; } ?></option><?php } ?>' />
<!-- begin edit left box -->
		<div class="edit-left-box">
			<div class="policy-entry-field">
				First Name<sup>*</sup>: 
				<input type="text" maxlength="40" style="width:115px;" id="policy_first_name" name="policy_first_name" placeholder="Customer First" value="" />
				&nbsp;
				Last Name<sup>*</sup>: 
				<input type="text" maxlength="40" style="width:115px;" id="policy_last_name" name="policy_last_name" placeholder="Customer Last" value="" />
			</div>
			<div class="policy-entry-field">
				Description: 
				<input type="text" maxlength="100" style="width:345px;" id="policy_description" name="policy_description" placeholder="Enter a Brief Description" value="" />
			</div>
			<div class="policy-entry-field">
				<div id="policy-premium-cover"></div>
				Premium<sup>*</sup>: 
				<span style="font-size:12px;font-weight:bold;">$</span> <input style="width:75px;" type="text" maxlength="20" id="policy_premium" name="policy_premium" placeholder="0.00" value="" />
				<div class="policy-new-premium">
				New Premium Date:
				<input id="premiumdate" name="premiumdate" value="" placeholder="" readonly />
				<input type="hidden" id="policy_premium_org" name="policy_premium_org" value="0" />
				</div>
			</div>	
			<div class="policy-entry-field">
				Policy Number: 
				<input type="text" maxlength="40" style="width:155px;" id="policy_number" name="policy_number" placeholder="Enter Policy Number" value="" />
				<div class="policy-zip">
				Zip Code: 
				<input style="width:75px;" type="text" maxlength="11" id="policy_zip" name="policy_zip" placeholder="90210" value="" />
				</div>
			</div>
			<div class="policy-entry-field">
				Notes:<br />
				<textarea style="width:425px;height:145px;" id="policy_notes" name="policy_notes" placeholder="Describe this policy or add keywords"></textarea>
			</div>
		</div>
<!-- end edit left box -->
<!-- begin edit right box -->
	<div class="edit-right-box">
	<div id="policy_dropdown_cover"></div>
		<div class="edit-table-container">
			<div class="edit-heading">
				<div class="edit-col">Policy Type<sup>*</sup>:</div>
				<div id="typeselect" class="edit-col">
					<select class="policy-type-select" id="policy_type" name="policy_type"></select>
				</div>
			</div>
			<div class="edit-heading">
				<div class="edit-col">Category<sup>*</sup>:</div>
				<div id="catselect" class="edit-col">
					<select class="policy-entry-select" id="policy_sub_category" name="policy_sub_category"></select>
				</div>
			</div>
			<div class="edit-table-row">
				<div class="edit-col">Business Type<sup>*</sup>:</div>
				<div class="edit-col">
					<select class="policy-entry-select" id="policy_business_type" name="policy_business_type">
						<option value="0">- Select -</option>
<?php foreach ($policy_business_types as $business_types) { ?>
                			<option value="<?php echo $business_types->id; ?>" id="<?php echo 'policy_business_type_'.$business_types->id; ?>"><?php echo $business_types->name; ?></option>
<?php } ?>
					</select>
				</div>
			</div>
			<div class="edit-table-row">
				<div class="edit-col">Sold By<sup>*</sup>:</div>
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
				<div class="edit-col">Lead Source<sup>*</sup>:</div>
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
				<div class="edit-col">Policy Length<sup>*</sup>:</div>
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
		<div class="policy-status">
			<div class="status-col">Policy Status</div>
			<div class="policy-date-fields">
			<div class="policy-state">
			<input type="radio" id="status_pending" name="policy_status" value="1" checked />Unissued<br /><br />
			<input type="radio" id="status_issued" name="policy_status" value="2" />Issued<br /><br />
			<input type="radio" id="status_declined" name="policy_status" value="3" />Declined<br /><br />
			<input type="radio" id="status_canceled" name="policy_status" value="4" />Canceled<br />
			</div>
			Written<sup>*</sup>:<input id="writtendate" name="writtendate" value="" placeholder="" /><br />
			<input type="hidden" id="issueddate" name="issueddate" value="" />
			Effective:<input id="effectivedate" name="effectivedate" value="" placeholder="" /><br />
			Canceled:<input id="canceleddate" name="canceleddate" value="" placeholder="" /><br />
			</div>
		</div>
	</div>
<!-- end edit right box -->
			</form>
<div class="policy-edit-bar"></div>
		<button class="plain-btn-close">Cancel</button>&nbsp;&nbsp;&nbsp;<button id="policy-add" data-type="add" class="plain-btn">Add</button><button id="policy-save" data-type="edit" class="plain-btn">Save</button>&nbsp;&nbsp;&nbsp;<button id="policy-erase" data-type="delete" class="plain-btn-erase">Erase</button>
	</div>

<br />
</div>
<!-- end modal window area -->