<!-- begin content area -->
<div id="policy-content">
		<div id="listing-table" class="table-container">
<?php
	$rowcnt = 1;
	$totalwritten = 0;
	$notissued = 0;
	$totpending = 0;
	$totcanceled = 0;
	$avgdti = 0;
	$rowswithdays = 0;
	$totalpremium = 0;
	$rowswithpremium = 0;
	$avgpremium = 0;
	foreach ($policy_data as $policy) {
		if ($rowcnt & 1) {
			$rowclass = "table-row";
		} else {
			$rowclass = "table-row-alt";
		}

		if ($policy->date_canceled != null) {
			$addStyle = 'text-decoration:line-through;color:#666666;font-style:italic;';
		} else {
			$addStyle = "";
		}
?>
			<div class="<?php echo $rowclass; ?>">
				<div class="col" style="width:2%;">&nbsp;<em><?php echo $rowcnt; ?></em></div>
<?php if ($policy->renewal == 1) { ?>
				<div class="col" style="width:3%;<?php echo $addStyle; ?>"><a class="policy-renewal-action" data-id="<?php echo $policy->id; ?>"><img src="/public/img/policy_edit_btn.png" class="policy-listing-button" alt="Renew" /></a></div>
<?php } elseif ($policy->date_canceled != null) { ?>
				<div class="col" style="width:3%;<?php echo $addStyle; ?>"><a class="policy-reinstate-action" data-id="<?php echo $policy->id; ?>"><img src="/public/img/policy_edit_btn.png" class="policy-listing-button" alt="Reinstate" /></a></div>
<?php } else { ?>
				<div class="col" style="width:3%;<?php echo $addStyle; ?>"><a class="policy-edit-action" data-info="<?php echo $policy->id."','".$policy->renewal."','".$policy->first."','".$policy->last."','".$policy->description."','".$policy->category_id."','".$policy->premium."','".$policy->business_type_id."','".$policy->user_id."','".$policy->source_type_id."','".$policy->length_type_id."','".$policy->notes."','".$policy->date_written."','".$policy->date_issued."','".$policy->date_effective."','".$policy->date_canceled."','".$policy->zip_code; ?>"><img src="/public/img/policy_edit_btn.png" class="policy-listing-button" alt="Edit" /></a></div>
<?php } ?>
				<div class="col" style="width:6%;<?php echo $addStyle; ?>"><?php echo $policy->first; ?></div>
				<div class="col" style="width:10%;<?php echo $addStyle; ?>"><?php echo $policy->last; ?></div>
				<div class="col" style="width:10%;"><?php if (strlen($policy->description) > 12) { echo '<a class="policy-desc-action" data-desc="'.$policy->description.'">'.substr($policy->description, 0, 12).'&hellip;</a>'; } else { echo $policy->description; } ?></div>
				<div class="col" style="width:10%;<?php echo $addStyle; ?>"><?php echo $policy->cat_name; ?></div>
				<div class="col" style="width:6%;<?php echo $addStyle; ?>"><?php echo '$'.number_format($policy->premium, 2); ?></div>
				<div class="col" style="width:6%;<?php echo $addStyle; ?>"><?php echo $policy->busi_name; ?></div>
				<div class="col" style="width:8%;<?php echo $addStyle; ?>"><?php echo $policy->user_first_name." ".$policy->user_last_name; ?></div>
				<div class="col" style="width:6%;<?php echo $addStyle; ?>"><?php echo $policy->src_name; ?></div>
				<div class="col" style="width:9%;<?php echo $addStyle; ?>"><?php echo $policy->len_name; ?></div>
				<div class="col" style="width:4%;<?php echo $addStyle; ?>"><a class="policy-note-action" data-notes="<?php echo $policy->notes; ?>"><img src="/public/img/policy_note_btn.png" class="policy-listing-button" alt="Notes" /></a></div>
				<div class="col" style="width:6%;"><?php if ($policy->date_written) { echo date('m/d/y',strtotime($policy->date_written)); } else { echo "&nbsp;";} ?></div>
				<div class="col" style="width:6%;"><?php if ($policy->date_issued) { echo date('m/d/y',strtotime($policy->date_issued)); } else { echo "<a class=\"policy-edit-action\" data-info=\"".$policy->id."','".$policy->renewal."','".$policy->first."','".$policy->last."','".$policy->description."','".$policy->category_id."','".$policy->premium."','".$policy->business_type_id."','".$policy->user_id."','".$policy->source_type_id."','".$policy->length_type_id."','".$policy->notes."','".$policy->date_written."','".$policy->date_issued."','".$policy->date_effective."','".$policy->date_canceled."','".$policy->zip_code."\">+&nbsp;</a>";} ?></div>
				<div class="col" style="width:6%;"><?php if ($policy->date_effective) { echo date('m/d/y',strtotime($policy->date_effective)); } else { echo "<a class=\"policy-edit-action\" data-info=\"".$policy->id."','".$policy->renewal."','".$policy->first."','".$policy->last."','".$policy->description."','".$policy->category_id."','".$policy->premium."','".$policy->business_type_id."','".$policy->user_id."','".$policy->source_type_id."','".$policy->length_type_id."','".$policy->notes."','".$policy->date_written."','".$policy->date_issued."','".$policy->date_effective."','".$policy->date_canceled."','".$policy->zip_code."\">+&nbsp;&nbsp;</a>";} ?></div>
				<div class="col" style="width:1%;<?php echo $addStyle; ?>"><a class="policy-delete-action" data-id="<?php echo $policy->id; ?>"><img src="/public/img/policy_delete_btn.png" class="policy-listing-button" alt="Delete" /></a></div>
				<div class="col" style="width:1%;<?php echo $addStyle; ?>"></div>
			</div>
<?php
		$rowcnt++;
		// calculate average DTI
		if ($policy->date_written != null && $policy->date_issued != null) {
			// track total items for avareage
			$rowswithdays++;
			// set dates
			$first_date = new DateTime($policy->date_written);
			$second_date = new DateTime($policy->date_issued);
			// calc date diff
			$difference = $first_date->diff($second_date);
			// track total days
			$days = $difference->d;
			$totaldays = ($avgdti+$days);
			// do average calc
			$avgdti = round(($totaldays/$rowswithdays));
		} else {
			$avgdti = 0;
		}
		
		if ($policy->premium != null) {
			$rowswithpremium++;
			// calc total premium
			$totalpremium = ($totalpremium+$policy->premium);
		}
		// do average calc
		$avgpremium = round(($totalpremium/$rowswithpremium));

		if ($policy->renewal == 0) {
			// do written count
			$totalwritten++;
			if ($policy->date_issued == null) {
				// do NOT issued count
				$notissued++;
			}
		} else {
			// do pending renewal count
			$totpending++;
		}

		if ($policy->date_canceled != null) {
			// do canceled policy count
			$totcanceled++;
		}

	} // end row

// do dollar formats
$avgpremium = '$'.number_format($avgpremium, 2);
$totalpremium = '$'.number_format($totalpremium, 2);

?>
		</div>
</div>
<script>
/* <![CDATA[ */

// LOAD
$(document).ready(function() {

	$("#policy-edit #path").val("app/policies/listall");

	$("#rowcnt").text('<?php echo ($rowcnt-1); ?>');
	$("#totwritten").text('<?php echo $totalwritten; ?>');
	$("#totnotissued").text('<?php echo $notissued; ?>');
	$("#totpending").text('<?php echo $totpending; ?>');
	$("#totcanceled").text('<?php echo $totcanceled; ?>');
	$("#avgdti").text('<?php echo $avgdti; ?>');
	$("#avgprem").text('<?php echo $avgpremium; ?>');
	$("#totprem").text('<?php echo $totalpremium; ?>');

// =============== BEGIN LISTING ACTIONS =============== //

	// OPEN EDIT POLICY WINDOW
	$('.policy-edit-action').click(function(){
		var info = $(this).data('info');
		var info = info.split("','");
		// assign values to pass to edit window
		var id = info[0];
		var renewal = info[1];
		var fname = info[2];
		var lname = info[3];
		var desc = info[4];
		var cat = info[5];
		var prem = info[6];
		var busi = info[7];
		var sold = info[8];
		var src = info[9];
		var len = info[10];
		var text = info[11];
		var dw = info[12];
		var di = info[13];
		var de = info[14];
		var dc = info[15];
		var zip = info[16];
		// do edit
		openPolicyEditWindow('listall',id,text,fname,lname,desc,prem,zip,cat,busi,sold,src,len,dw,di,de,dc,renewal);
	});

	// OPEN DESCRIPTION TEXT WINDOW
	$('.policy-desc-action').click(function(){
		var text = $(this).data('desc');
    		openPolicyDescWindow(text);
	});

	// OPEN NOTES TEXT WINDOW
	$('.policy-note-action').click(function(){
		var text = $(this).data('notes');
    		openPolicyTextWindow(text);
	});

	// DELETE POLICY
	$('.policy-delete-action').click(function(){
		var id = $(this).data('id');
    		doPolicyDelete(id);
	});

	// RENEW POLICY
	$('.policy-renewal-action').click(function(){
		var id = $(this).data('id');
    		doPolicyRenewal(id);
	});

	// REINSTATE POLICY
	$('.policy-reinstate-action').click(function(){
		var id = $(this).data('id');
    		doPolicyReinstate(id);
	});

// =============== END LISTING ACTIONS =============== //

});

/* ]]> */
</script>
<!-- end content area -->