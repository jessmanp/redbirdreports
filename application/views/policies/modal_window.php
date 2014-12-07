<!-- begin modal window area -->
<div id="policy-popup"></div>
<div id="policy-window">
	<div id="policy-text">
		<div class="policy-message"></div>
		<p class="policy-text-box"></p>
<div class="policy-edit-bar"></div>
		<button class="plain-btn-close">Close</button>
	</div>
	<div id="policy-edit">
<div style="margin:60px 0 0 20px;position:absolute;font-size:11px;font-weight:bold;"><sup>*</sup> Denotes Required Field(s)</div>
		<div class="policy-message"></div>
			<form id="policy_entry_form" name="policy_entry_form">
			<input type="hidden" id="path" name="path" value="" />
			<input type="hidden" id="id" name="id" value="-2" />
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
				Premium<sup>*</sup>: 
				<span style="font-size:12px;font-weight:bold;">$</span> <input style="width:75px;" type="text" maxlength="20" id="policy_premium" name="policy_premium" placeholder="0.00" value="" />
				<div class="policy-zip">
				Zip Code: 
				<input style="width:75px;" type="text" maxlength="11" id="policy_zip" name="policy_zip" placeholder="90210" value="" />
				</div>
			</div>
			<div class="policy-entry-field">
				Notes:<br />
				<textarea style="width:425px;height:45px;" id="policy_notes" name="policy_notes" placeholder="Describe this policy or add keywords"></textarea>
			</div>
		</div>
<!-- end edit left box -->
<!-- begin edit right box -->
	<div class="edit-right-box">
		<div class="edit-table-container">
			<div class="edit-heading">
				<div class="edit-col">Category<sup>*</sup>:</div>
				<div id="catselect" class="edit-col">
					<select class="policy-entry-select" id="policy_sub_category" name="policy_sub_category">
					</select>
				</div>
			</div>
			<div class="edit-table-row">
				<div class="edit-col">Business Type<sup>*</sup>:</div>
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
	</div>
<!-- end edit right box -->
	<div class="policy-date-fields">
		Written<sup>*</sup>:<input id="writtendate" name="writtendate" value="" placeholder="" readonly />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Issued:<input id="issueddate" name="issueddate" value="" placeholder="" readonly />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Effective:<input id="effectivedate" name="effectivedate" value="" placeholder="" readonly />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Canceled:<input id="canceleddate" name="canceleddate" value="" placeholder="" readonly />&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
			</form>
<div class="policy-edit-bar"></div>
		<button class="plain-btn-close">Cancel</button>&nbsp;&nbsp;&nbsp;<button id="policy-add" data-type="add" class="plain-btn">Add</button><button id="policy-save" data-type="edit" class="plain-btn">Save</button>
	</div>
	<div id="policy-delete">
		<div class="policy-message"></div>
			Are you sure you want to &quot;<strong>ERASE</strong>&quot; this Policy?<br /><br />Click &quot;<strong>Cancel</strong>&quot; if you want to keep this policy.<br />
			<form id="policy_delete_form" name="policy_delete_form">
			<input type="hidden" id="delid" name="delid" value="-2" />
			</form>
<div class="policy-edit-bar"></div>
		<button class="plain-btn-close">Cancel</button>&nbsp;&nbsp;&nbsp;<button id="policy-disable" class="plain-btn">Erase</button>
	</div>
	<br /><br />
</div>
<!-- end modal window area -->