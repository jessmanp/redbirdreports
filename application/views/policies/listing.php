<div id="listing-table" class="table-container">
<?php
	$totalwritten = 0;
	$notissued = 0;
	$totpending = 0;
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
?>
			<div class="<?php echo $rowclass; ?>">
				<div class="col" style="width:2%;">&nbsp;<em><?php echo $rowcnt; ?></em></div>
				<div class="col" style="width:3%;"><a class="policy-edit-action" data-id="<?php echo $policy->id; ?>"><img src="/public/img/policy_edit_btn.png" class="policy-listing-button" alt="Edit" /></a></div>
				<div class="col" style="width:10%;"><?php echo $policy->first; ?></div>
				<div class="col" style="width:10%;"><?php echo $policy->last; ?></div>
				<div class="col" style="width:10%;"><?php if (strlen($policy->description) > 12) { echo '<a class="policy-desc-action" data-desc="'.$policy->description.'">'.substr($policy->description, 0, 12).'&hellip;</a>'; } else { echo $policy->description; } ?></div>
				<div class="col" style="width:6%;"><?php echo $policy->cat_name; ?></div>
				<div class="col" style="width:6%;"><?php echo '$'.number_format($policy->premium, 2); ?></div>
				<div class="col" style="width:6%;"><?php echo $policy->busi_name; ?></div>
				<div class="col" style="width:8%;"><?php echo $policy->user_first_name." ".$policy->user_last_name; ?></div>
				<div class="col" style="width:6%;"><?php echo $policy->src_name; ?></div>
				<div class="col" style="width:9%;"><?php echo $policy->len_name; ?></div>
				<div class="col" style="width:4%;"><a class="policy-note-action" data-notes="<?php echo $policy->notes; ?>"><img src="/public/img/policy_note_btn.png" class="policy-listing-button" alt="Notes" /></a></div>
				<div class="col" style="width:6%;"><?php if ($policy->date_written) { echo date('m/d/y',strtotime($policy->date_written)); } else { echo "&nbsp;";} ?></div>
				<div class="col" style="width:6%;"><?php if ($policy->date_issued) { echo date('m/d/y',strtotime($policy->date_issued)); } else { echo "&nbsp;";} ?></div>
				<div class="col" style="width:6%;"><?php if ($policy->date_effective) { echo date('m/d/y',strtotime($policy->date_effective)); } else { echo "&nbsp;";} ?></div>
				<div class="col" style="width:1%;"><a class="policy-delete-action" data-id="<?php echo $policy->id; ?>"><img src="/public/img/policy_delete_btn.png" class="policy-listing-button" alt="Delete" /></a></div>
				<div class="col" style="width:1%;"></div>
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

	$("#rowcnt").text('<?php echo ($rowcnt-1); ?>');
	$("#totwritten").text('<?php echo $totalwritten; ?>');
	$("#totnotissued").text('<?php echo $notissued; ?>');
	$("#totpending").text('<?php echo $totpending; ?>');
	$("#avgdti").text('<?php echo $avgdti; ?>');
	$("#avgprem").text('<?php echo $avgpremium; ?>');
	$("#totprem").text('<?php echo $totalpremium; ?>');

// =============== BEGIN LISTING ACTIONS =============== //

	// OPEN EDIT POLICY WINDOW
	$('.policy-edit-action').click(function(){
		var id = $(this).data('id');
    		openPolicyEditWindow(id);
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

	// DELETE PLOICY
	$('.policy-delete-action').click(function(){
		var id = $(this).data('id');
    		doPolicyDelete(id);
	});

// =============== END LISTING ACTIONS =============== //

});
</script>