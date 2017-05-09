<!-- begin content area -->
<div id="policy-content">
		<div id="listing-table" class="table-container">
<?php
	$url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
	
	$rowcnt = 1;
	$totalwritten = 0;
	$issued = 0;
	$notissued = 0;
	$totpending = 0;
	$totcanceled = 0;
	$avgdti = 0;
	$rowswithdays = 0;
	$totalpremium = 0;
	$rowswithpremium = 0;
	$avgpremium = 0;
  if ($policy_data) {
	foreach ($policy_data as $policy) {
	
			$cancellationvalue = 0;
			$chargebackvalue = 0;
			
///////////////////////////////////  END CALCS  ///////////////////////////////////

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
		
		// calculate cancellation value
		if ($policy->date_effective != null && $policy->length_type_id != 0 && $policy->date_canceled != null && $policy->premium > 0) {
			// do days in policy
			if ($policy->length_type_id == 1) {
				$pterm = strtotime('+6 months', strtotime($policy->date_effective)); // effective date + 6 months
			} else if ($policy->length_type_id == 2) {
				$pterm = strtotime('+12 months', strtotime($policy->date_effective)); // effective date + 12 months
			}
			$date1 = new DateTime($policy->date_effective);
			$date2 = new DateTime(date('Y-m-d h:m:s',$pterm));
			$interval1 = $date1->diff($date2);
			// total amount of days
			$daysinpolicy = $interval1->days;
			
			// do days in effect
			$date3 = new DateTime($policy->date_effective);
			$date4 = new DateTime($policy->date_canceled);
			$interval2 = $date3->diff($date4);
			// total amount of days
			$daysineffect = $interval2->days;
			
			// do premium per day
			$premiumperday = round($policy->premium / $daysinpolicy);
			
			// do cancellation value
			$cancellationvalue = round($premiumperday * $daysineffect);
			
			// do chargeback value
			$chargebackvalue = round($policy->premium - $cancellationvalue);
		}
		
		// calculate total premium
		if ($policy->premium != null && $policy->status < 3) {
			$rowswithpremium++;
			if ($cancellationvalue > 0) {
				$totalpremium = ($totalpremium+$cancellationvalue);
			} else {
				$totalpremium = ($totalpremium+$policy->premium);
			}
		}
		// do average calc
		@$avgpremium = round(($totalpremium/$rowswithpremium));

		// policy counts
		if ($policy->renewal == 0) {
			// do written count
			$totalwritten++;
			if ($policy->status == 1) {
				// do NOT issued count
				$notissued++;
			}
			if ($policy->status == 2) {
				// do IS issued count
				$issued++;
			}
		} else {
			// do pending renewal count
			$totpending++;
		}
		if ($policy->status == 4) {
			// do canceled policy count
			$totcanceled++;
		}
		
///////////////////////////////////  END CALCS  ///////////////////////////////////

		switch ($policy->status) {
    		case 1: 
				$statusname = "Unissued";
				break;
			case 2: 
				$statusname = "Issued";
				break;
			case 3: 
				$statusname = "Declined";
				break;
			case 4: 
				$statusname = "Canceled";
				break;
			default:
				$statusname = "";
		}
		
		if ($policy->renewal == 1) {
			$statusname = "Pending";
		}
	
		if ($rowcnt & 1) {
			$rowclass = "table-row";
		} else {
			$rowclass = "table-row-alt";
		}

		if ($policy->status == 4) {
			// cancelled
			$addStyle = 'text-decoration:line-through;color:#666666;font-style:italic;';
		} else if ($policy->status == 3) {
			// declined
			$addStyle = 'color:#666666;font-style:italic;';
		} else {
			$addStyle = "";
		}
		$fullname = $policy->user_first_name." ".$policy->user_last_name;
?>
			<div class="<?php echo $rowclass; ?>">
				<div class="col" style="width:1%;">&nbsp;<em><?php echo $rowcnt; ?></em></div>
<?php if ($policy->renewal == 1) { ?>
				<div class="col" style="width:4%;<?php echo $addStyle; ?>"><a class="policy-renewal-action" data-renewal="<?php echo $policy->id."','".$policy->first."','".$policy->last."','".$policy->description; ?>"><img src="/public/img/policy_edit_btn.png" class="policy-listing-button-edit" alt="Renew" /></a></div>
<?php } elseif ($policy->status == 4) { ?>
				<div class="col" style="width:4%;<?php echo $addStyle; ?>"><a class="policy-reinstate-action" data-id="<?php echo $policy->id; ?>"><img src="/public/img/policy_edit_btn.png" class="policy-listing-button-edit" alt="Reinstate" /></a></div>
<?php } else { ?>
				<div class="col" style="width:4%;<?php echo $addStyle; ?>"><a class="policy-edit-action" data-info="<?php echo $policy->id."','".$policy->renewal."','".$policy->first."','".$policy->last."','".$policy->description."','".$policy->category_id."-".$policy->cat_pid."','".$policy->premium."','".$policy->business_type_id."','".$policy->user_id."','".$policy->source_type_id."','".$policy->length_type_id."','".$policy->notes."','".$policy->policy_number."','".$policy->date_written."','".$policy->date_issued."','".$policy->date_effective."','".$policy->date_canceled."','".$policy->zip_code."','".$policy->status; ?>"><img src="/public/img/policy_edit_btn.png" class="policy-listing-button-edit" alt="Edit" /></a></div>
<?php } ?>
				<div class="col" style="width:4%;"><?php echo $statusname; ?></div>
				<div class="col" style="width:10%;<?php echo $addStyle; ?>"><?php echo $policy->first; ?></div>
				<div class="col" style="width:10%;<?php echo $addStyle; ?>"><?php echo $policy->last; ?></div>
				<div class="col" style="width:10%;"><?php if (strlen($policy->description) > 12) { echo '<a class="policy-desc-action" data-desc="'.$policy->description.'">'.substr($policy->description, 0, 12).'</a>&hellip;'; } else { echo $policy->description; } ?></div>
				<div class="col" style="width:10%;<?php echo $addStyle; ?>"><?php echo $policy->cat_name; ?></div>
<?php if ($cancellationvalue > 0) { ?>
				<div class="col" style="width:9%;font-size:11px;font-style:italic;"><?php echo '$'.number_format($cancellationvalue, 2); if ($chargebackvalue > 0) { echo '&nbsp;<span class="chargeback">($'.number_format($chargebackvalue, 2).')</span>'; } ?></div>
<?php } else { ?>
				<div class="col" style="width:9%;"><?php if ($policy->status == 3) { echo '<span class="chargeback">($'.number_format(($policy->premium*-1), 2).')</span>'; } else { echo '$'.number_format($policy->premium, 2); } ?></div>
<?php } ?>
				<div class="col" style="width:6%;<?php echo $addStyle; ?>"><?php echo $policy->busi_name; ?></div>
				<div class="col" style="width:8%;<?php echo $addStyle; ?>"><?php if (strlen($fullname) > 14) { echo substr($fullname, 0, 14)."&hellip;"; } else { echo $fullname; } ?></div>
				<div class="col" style="width:6%;<?php echo $addStyle; ?>"><?php echo $policy->src_name; ?></div>
				<div class="col" style="width:7%;<?php echo $addStyle; ?>"><?php echo $policy->len_name; ?></div>
				<div class="col" style="width:4%;<?php echo $addStyle; ?>"><a class="policy-note-action" data-notes="<?php echo $policy->notes; ?>"><img src="/public/img/policy_note_btn.png" class="policy-listing-button-note" alt="Notes" /></a></div>
				<div class="col" style="width:5%;"><?php if ($policy->date_written) { echo date('m/d/y',strtotime($policy->date_written)); } else { echo "&nbsp;";} ?></div>
				<div class="col" style="width:5%;"><?php if ($policy->date_effective) { echo date('m/d/y',strtotime($policy->date_effective)); } else { echo "&nbsp;";} ?></div>
				<div class="col" style="width:1%;<?php echo $addStyle; ?>"></div>
			</div>
<?php
		$rowcnt++;
		
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
</div>
<script>
/* <![CDATA[ */

// LOAD
$(document).ready(function() {

	$("#datepick1").val(setClientDate('first'));
	$("#datepick2").val(setClientDate('last'));
	$("#field").val('');
	$(".date-pickers").html("This Month:");

	/*
	var url =  "<?php echo $url; ?>";
	$("#policy-edit #edit_path").val(url);
	$("#policy-delete #delete_path").val(url);
	$("#policy-do-renew #renew_path").val(url);
	$("#policy-reinstate #reinstate_path").val(url);
	$("#policy-renew-cancel #renew_cancel_path").val(url);
	*/
	
	var sdate = $("#datepick1").val().replace(/\//g, "-");
	var edate = $("#datepick2").val().replace(/\//g, "-");
	if (sdate != '' && edate != '') {
		dateRange = sdate+"."+edate+".a";
	} else {
		dateRange = 'any';
	}
	// add date to edit path
	var appendedEditPath = "app/policies/listall/default/"+dateRange;
	$("#policy-edit #edit_path").val(appendedEditPath);
	$("#policy-delete #delete_path").val(appendedEditPath);
	$("#policy-do-renew #renew_path").val(appendedEditPath);
	$("#policy-reinstate #reinstate_path").val(appendedEditPath);
	$("#policy-renew-cancel #renew_cancel_path").val(appendedEditPath);

	/*
		$("#policy-edit #edit_path").val("app/policies/listall");
		$("#policy-delete #delete_path").val("app/policies/listall");
		$("#policy-do-renew #renew_path").val("app/policies/listall");
		$("#policy-reinstate #reinstate_path").val("app/policies/listall");
		$("#policy-renew-cancel #renew_cancel_path").val("app/policies/listall");
	*/

	$("#rowcnt").text('<?php echo ($rowcnt-1); ?>');
	$("#totwritten").text('<?php echo $totalwritten; ?>');
	$("#totissued").text('<?php echo $issued; ?>');
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
		info = info.split("','");
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
		var pnum = info[12];
		var dw = info[13];
		var di = info[14];
		var de = info[15];
		var dc = info[16];
		var zip = info[17];
		var stat = info[18];
		// do edit
		openPolicyEditWindow('listall',id,text,pnum,fname,lname,desc,prem,zip,cat,busi,sold,src,len,dw,di,de,dc,renewal,stat);
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
		var fields = $(this).data('delete');
		fields = fields.split("','");
		var id = fields[0];
		var first = fields[1];
		var last = fields[2];
		var desc = fields[3];
    		doPolicyDelete(id,first,last,desc);
	});
	
	// RENEW POLICY
	$('.policy-renewal-action').click(function(){
		var fields = $(this).data('renewal');
		fields = fields.split("','");
		var id = fields[0];
		var first = fields[1];
		var last = fields[2];
		var desc = fields[3];
    		doPolicyRenewal(id,first,last,desc);
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