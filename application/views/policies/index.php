<!-- begin content area -->
<div id="policy-content">
		<div class="table-container">
<?php
	$rowcnt = 1;
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
	}
?>
		</div>
</div>
<!-- end content area -->