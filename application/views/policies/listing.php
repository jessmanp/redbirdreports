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
				<div class="col" style="width:3%;"><a href=""><img src="/public/img/policy_edit_btn.png" class="policy-listing-button" alt="" data-id="<?php echo $policy->id; ?>" /></a></div>
				<div class="col" style="width:10%;"><?php echo $policy->first; ?></div>
				<div class="col" style="width:10%;"><?php echo $policy->last; ?></div>
				<div class="col" style="width:10%;"><?php echo $policy->description; ?></div>
				<div class="col" style="width:6%;"><?php echo $policy->cat_name; ?></div>
				<div class="col" style="width:6%;"><?php echo $policy->premium; ?></div>
				<div class="col" style="width:6%;"><?php echo $policy->busi_name; ?></div>
				<div class="col" style="width:8%;"><?php echo $policy->user_first_name." ".$policy->user_last_name; ?></div>
				<div class="col" style="width:6%;"><?php echo $policy->src_name; ?></div>
				<div class="col" style="width:9%;"><?php echo $policy->len_name; ?></div>
				<div class="col" style="width:4%;"><img src="/public/img/policy_note_btn.png" class="policy-listing-button" alt=""></div>
				<div class="col" style="width:6%;"><?php if ($policy->date_written) { echo date('m/d/y',strtotime($policy->date_written)); } else { echo "&nbsp;";} ?></div>
				<div class="col" style="width:6%;"><?php if ($policy->date_issued) { echo date('m/d/y',strtotime($policy->date_issued)); } else { echo "&nbsp;";} ?></div>
				<div class="col" style="width:6%;"><?php if ($policy->date_effective) { echo date('m/d/y',strtotime($policy->date_effective)); } else { echo "&nbsp;";} ?></div>
				<div class="col" style="width:1%;"><a href="#"><img src="/public/img/policy_delete_btn.png" class="policy-listing-button" alt=""></a></div>
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
No Results Found.
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

});
</script>