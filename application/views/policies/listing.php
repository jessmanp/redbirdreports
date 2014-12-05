<div id="listing-table" class="table-container">
<?php
	$url = filter_var($_GET['url'], FILTER_SANITIZE_URL);

	$totalwritten = 0;
	$notissued = 0;
	$totpending = 0;
	$totcanceled = 0;
	$avgdti = 0;
	$rowswithdays = 0;
	$totalpremium = 0;
	$rowswithpremium = 0;
	$avgpremium = 0;
	$rowcnt = 1;
  if ($policy_data) {
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
				<div class="col" style="width:3%;<?php echo $addStyle; ?>"><a class="policy-edit-action" data-info="<?php echo $policy->id."','".$policy->first."','".$policy->last."','".$policy->description."','".$policy->category_id."','".$policy->premium."','".$policy->business_type_id."','".$policy->user_id."','".$policy->source_type_id."','".$policy->length_type_id."','".$policy->notes."','".$policy->date_written."','".$policy->date_issued."','".$policy->date_effective."','".$policy->date_canceled."','".$policy->zip_code; ?>"><img src="/public/img/policy_edit_btn.png" class="policy-listing-button" alt="Edit" /></a></div>
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
				<div class="col" style="width:6%;"><?php if ($policy->date_issued) { echo date('m/d/y',strtotime($policy->date_issued)); } else { echo "<a class=\"policy-edit-action\" data-info=\"".$policy->id."','".$policy->first."','".$policy->last."','".$policy->description."','".$policy->category_id."','".$policy->premium."','".$policy->business_type_id."','".$policy->user_id."','".$policy->source_type_id."','".$policy->length_type_id."','".$policy->notes."','".$policy->date_written."','".$policy->date_issued."','".$policy->date_effective."','".$policy->date_canceled."','".$policy->zip_code."\">+&nbsp;</a>";} ?></div>
				<div class="col" style="width:6%;"><?php if ($policy->date_effective) { echo date('m/d/y',strtotime($policy->date_effective)); } else { echo "<a class=\"policy-edit-action\" data-info=\"".$policy->id."','".$policy->first."','".$policy->last."','".$policy->description."','".$policy->category_id."','".$policy->premium."','".$policy->business_type_id."','".$policy->user_id."','".$policy->source_type_id."','".$policy->length_type_id."','".$policy->notes."','".$policy->date_written."','".$policy->date_issued."','".$policy->date_effective."','".$policy->date_canceled."','".$policy->zip_code."\">+&nbsp;&nbsp;</a>";} ?></div>
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
		}
		if (isset($totaldays) && $totaldays != 0) {
			// do average calc
			$avgdti = round(($totaldays/$rowswithdays));
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

  } else {
?>
<br /><br />
No Policies Found.
<br /><br />
<?php
}
// do dollar formats
$avgpremium = '$'.number_format($avgpremium, 2);
$totalpremium = '$'.number_format($totalpremium, 2);
?>
</div>
<script>
/* <![CDATA[ */

// LOAD
$(document).ready(function() {

	var url =  "<?php echo $url; ?>";
	$("#policy-edit #path").val(url);

	var currcat = url.split('/');
	currcat = currcat[2];

	$("#rowcnt").text('<?php echo ($rowcnt-1); ?>');
	$("#totwritten").text('<?php echo $totalwritten; ?>');
	$("#totnotissued").text('<?php echo $notissued; ?>');
	$("#totcanceled").text('<?php echo $totcanceled; ?>');
	$("#totpending").text('<?php echo $totpending; ?>');
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
		var fname = info[1];
		var lname = info[2];
		var desc = info[3];
		var cat = info[4];
		var prem = info[5];
		var busi = info[6];
		var sold = info[7];
		var src = info[8];
		var len = info[9];
		var text = info[10];
		var dw = info[11];
		var di = info[12];
		var de = info[13];
		var dc = info[14];
		var zip = info[15];
		// do edit
		openPolicyEditWindow(currcat,id,text,fname,lname,desc,prem,zip,cat,busi,sold,src,len,dw,di,de,dc,zip);
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

// =============== END LISTING ACTIONS =============== //

});

/* ]]> */
</script>