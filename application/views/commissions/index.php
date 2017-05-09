<!-- begin content area -->
<div id="commissions-content">
<h1><strong>Report Period:</strong> <span id="com_year"></span> - <span class="current-period" id="com_range"></span> (<span id="com_period">Current</span> Period)</h1>
<div class="commission-table">

<div class="commission-left-cell">
	<div class="commission-special">
		<div class="com-title">Special Commissions</div>
		<div class="com-holder">
		<button id="update-com-bonus" class="update-com-bonus">Update Bonus&nbsp;&nbsp;<img src="/public/img/btn_com_bonus.png" class="search-btn-icon" alt="" width="33" height="28"></button>
		<button id="update-com-other" class="update-com-other">Update Other&nbsp;&nbsp;<img src="/public/img/btn_com_bonus.png" class="search-btn-icon" alt="" width="33" height="28"></button>
	<div class="com-special-all">
<form id="com_update_special_bonus" name="com_update_special_bonus">
	<input type="hidden" id="bonus_period" name="bonus_period" value="" />
	<input type="hidden" id="bonus_employee_id" name="bonus_employee_id" value="-2" />
<!-- begin form -->
		<div class="table-container">
			<div class="table-row">
				<div class="col" style="width:40%;"><div class="com-special">Bonus</div></div>
				<div class="col" style="width:60%;">
					<span style="font-size:12px;font-weight:bold;">$</span>
					<input type="text" maxlength="10" style="width:100px;" id="commissions_bonus" name="commissions_bonus" placeholder="0.00" value="">
				</div>
			</div>
		</div>
		<input type="text" maxlength="100" style="width:215px;margin:7px 0 0 10px;" id="com_bonus_description" name="com_bonus_description" placeholder="Enter a Brief Description" value="">
<!-- end form -->
</form>
<form id="com_update_special_other" name="com_update_special_other">
	<input type="hidden" id="other_period" name="other_period" value="" />
	<input type="hidden" id="other_employee_id" name="other_employee_id" value="-2" />
<!-- begin form -->
		<div class="table-container">
			<div class="table-row">
				<div class="col" style="width:40%;"><div class="com-special">Other</div></div>
				<div class="col" style="width:60%;">
					<span style="font-size:12px;font-weight:bold;">$</span>
					<input type="text" maxlength="10" style="width:100px;" id="commissions_other" name="commissions_other" placeholder="0.00" value="">
				</div>
			</div>
		</div>
		<input type="text" maxlength="100" style="width:215px;margin:7px 0 0 10px;" id="com_other_description" name="com_other_description" placeholder="Enter a Brief Description" value="">
		<!-- end form -->
</form>
	</div>
		</div>
		<div class="commission-text-footer">
			<div class="table-container">
				<div class="table-row">
					<div class="col" style="width:60%;text-align:left;padding:0 10px 0 10px;">Total</div>
					<div class="col" style="width:40%;text-align:right;padding:0 10px 0 10px;">$<span id="special_total">0.00</span></div>
				</div>
			</div>
		</div>
	</div>
	<div class="commission-earned">
		<div class="com-title">Commissions Earned</div>
		<div class="com-holder">
		  <div class="table-container">
			<div class="table-row">
				<div class="col" style="width:60%;"><div class="com-earned">New Policies</div></div>
				<div class="col" style="width:40%;"><div class="com-earned-amount">$<span id="new_policies_total">0.00</span></div></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:60%;"><div class="com-earned">Renewals</div></div>
				<div class="col" style="width:40%;"><div class="com-earned-amount">$<span id="renewals_total">0.00</span></div></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:60%;"><div class="com-earned">Bonus</div></div>
				<div class="col" style="width:40%;"><div class="com-earned-amount">$<span id="bonus_total">0.00</span></div></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:60%;"><div class="com-earned">Other</div></div>
				<div class="col" style="width:40%;"><div class="com-earned-amount">$<span id="other_total">0.00</span></div></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:60%;"><div class="com-earned">Charge Backs</div></div>
				<div class="col" style="width:40%;"><div class="com-earned-chargeback">($<span id="chargebacks_total">0.00</span>)</div></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:60%;"><div class="com-earned-bold">Total Commissions</div></div>
				<div class="col" style="width:40%;"><div class="com-earned-amount-bold">$<span id="com_total">0.00</span></div></div>
			</div>
		  </div>
		</div>
		<div class="commission-text-footer">&nbsp;</div>
	</div>
	<div class="commission-trends">
		<div class="com-title">Commissions Trends (Trailing 12 Months)</div>
		<div class="com-holder">
		  <div class="table-container">
<!-- begin row -->
				<canvas id="compensationChart" width="620" height="160" style="margin:10px 0 0 30px;width:620px; height:160px;"></canvas>
<!-- end row -->
		  </div>
		</div>
		<div class="commission-text-footer">&nbsp;</div>
	</div>
</div>

<div class="commission-right-cell">
	<div class="commission-new-policies">
		<div class="com-title">New Policies</div>
		<div class="com-holder">
		  <div class="table-container">
			<div class="table-row">
				<div class="col" style="width:16%;">&nbsp;</div>
				<div class="col" style="width:28%;"><div class="com-caption">Policies<br />Issued</div></div>
				<div class="col" style="width:28%;"><div class="com-caption">Issued<br />Premiums</div></div>
				<div class="col" style="width:28%;"><div class="com-caption">Commissions<br />Earned</div></div>
			</div>
<!-- begin rows -->
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Auto</span></div>
				<div class="col" style="width:28%;padding:5px;"><span id="auto_count_new">0</span></div>
				<div class="col" style="width:28%;padding:5px;">$<span id="auto_premium_new">0.00</span></div>
				<div class="col" style="width:28%;padding:5px;">$<span id="auto_commission_new">0.00</span></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Fire</span></div>
				<div class="col" style="width:28%;padding:5px;"><span id="fire_count_new">0</span></div>
				<div class="col" style="width:28%;padding:5px;">$<span id="fire_premium_new">0.00</span></div>
				<div class="col" style="width:28%;padding:5px;">$<span id="fire_commission_new">0.00</span></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Life</span></div>
				<div class="col" style="width:28%;padding:5px;"><span id="life_count_new">0</span></div>
				<div class="col" style="width:28%;padding:5px;">$<span id="life_premium_new">0.00</span></div>
				<div class="col" style="width:28%;padding:5px;">$<span id="life_commission_new">0.00</span></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Health</span></div>
				<div class="col" style="width:28%;padding:5px;"><span id="health_count_new">0</span></div>
				<div class="col" style="width:28%;padding:5px;">$<span id="health_premium_new">0.00</span></div>
				<div class="col" style="width:28%;padding:5px;">$<span id="health_commission_new">0.00</span></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Bank</span></div>
				<div class="col" style="width:28%;padding:5px;"><span id="bank_count_new">0</span></div>
				<div class="col" style="width:28%;padding:5px;">-</div>
				<div class="col" style="width:28%;padding:5px;">$<span id="bank_commission_new">0.00</span></div>
			</div>
<!-- end rows -->
		  </div>
		</div>
		<div class="commission-text-footer">
		  <div class="table-container">
			<div class="table-row">
				<div class="col" style="width:16%;">Total</div>
				<div class="col" style="width:28%;"><span id="new_policy_count_total">0</span></div>
				<div class="col" style="width:28%;">$<span id="new_policy_premium_total">0.00</span></div>
				<div class="col" style="width:28%;">$<span id="new_policy_commission_total">0.00</span></div>
			</div>
		  </div>
		</div>
	</div>
	<div class="commission-renewals">
		<div class="com-title">Renewals</div>
		<div class="com-holder">
		  <div class="table-container">
			<div class="table-row">
				<div class="col" style="width:16%;">&nbsp;</div>
				<div class="col" style="width:28%;"><div class="com-caption">Policies<br />Renewed</div></div>
				<div class="col" style="width:28%;"><div class="com-caption">Renewal<br />Premiums</div></div>
				<div class="col" style="width:28%;"><div class="com-caption">Commissions<br />Earned</div></div>
			</div>
<!-- begin rows -->
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Auto</span></div>
				<div class="col" style="width:28%;padding:5px;"><span id="auto_count_renew">0</span></div>
				<div class="col" style="width:28%;padding:5px;">$<span id="auto_premium_renew">0.00</span></div>
				<div class="col" style="width:28%;padding:5px;">$<span id="auto_commission_renew">0.00</span></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Fire</span></div>
				<div class="col" style="width:28%;padding:5px;"><span id="fire_count_renew">0</span></div>
				<div class="col" style="width:28%;padding:5px;">$<span id="fire_premium_renew">0.00</span></div>
				<div class="col" style="width:28%;padding:5px;">$<span id="fire_commission_renew">0.00</span></div>
			</div>
<!-- end rows -->
		  </div>
		</div>
		<div class="commission-text-footer">
		  <div class="table-container">
			<div class="table-row">
				<div class="col" style="width:16%;">Total</div>
				<div class="col" style="width:28%;"><span id="renew_policy_count_total">0</span></div>
				<div class="col" style="width:28%;">$<span id="renew_policy_premium_total">0.00</span></div>
				<div class="col" style="width:28%;">$<span id="renew_policy_commission_total">0.00</span></div>
			</div>
		  </div>
		</div>
	</div>
</div>

<div style="clear:both;">&nbsp;</div>

</div>

</div>
<!-- end content area -->
<script>
/* <![CDATA[ */


// LOAD
$(document).ready(function() {
	
});

/* ]]> */
</script>