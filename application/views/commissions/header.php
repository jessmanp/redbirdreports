<?php
if ($frequency == 1) {
	$cf = "Monthly";
} else {
	$cf = "Bi-Monthly";
}
?>
<!-- begin sub header area -->
<div id="commissions-header">
	<div id="sub-menu">
		<div id="commission-container">
			<div id="commission-employee-box">
				<strong>View Employee</strong><br />
				<div class="agency-employee-name">
					<div id="emp_default_label">No Employee Selected</div>
					<span id="emp_first_label"></span><br />
					<span id="emp_last_label"></span><br />
				</div>
				<select id="commission_employees" name="commission_employees" class="policy-entry-select">
					<option value="0">- Select -</option>
				</select>
			</div>
			<div id="commission-period-box">
				This Period is<br />
				<img src="/public/img/period_open.png" class="period-open" />
				<span class="period-bold">OPEN</span>
				<form id="close_current_period" name="close_current_period">
					<input type="hidden" id="user_id" name="user_id" value="-1" />
					<input type="hidden" id="period" name="period" value="" />
					<input type="hidden" id="lifetime" name="lifetime" value="" />
					<input type="hidden" id="last_year" name="last_year" value="" />
					<input type="hidden" id="last_ytd" name="last_ytd" value="" />
					<input type="hidden" id="current_ytd" name="current_ytd" value="" />
					<input type="hidden" id="last_month" name="last_month" value="" />
					<input type="hidden" id="new_policies" name="new_policies" value="" />
					<input type="hidden" id="renewals" name="renewals" value="" />
					<input type="hidden" id="charge_backs" name="charge_backs" value="" />
					<input type="hidden" id="auto_policies_issued" name="auto_policies_issued" value="" />
					<input type="hidden" id="fire_policies_issued" name="fire_policies_issued" value="" />
					<input type="hidden" id="life_policies_issued" name="life_policies_issued" value="" />
					<input type="hidden" id="health_policies_issued" name="health_policies_issued" value="" />
					<input type="hidden" id="bank_policies_issued" name="bank_policies_issued" value="" />
					<input type="hidden" id="auto_issued_premiums" name="auto_issued_premiums" value="" />
					<input type="hidden" id="fire_issued_premiums" name="fire_issued_premiums" value="" />
					<input type="hidden" id="life_issued_premiums" name="life_issued_premiums" value="" />
					<input type="hidden" id="health_issued_premiums" name="health_issued_premiums" value="" />
					<input type="hidden" id="bank_issued_premiums" name="bank_issued_premiums" value="" />
					<input type="hidden" id="auto_commissions" name="auto_commissions" value="" />
					<input type="hidden" id="fire_commissions" name="fire_commissions" value="" />
					<input type="hidden" id="life_commissions" name="life_commissions" value="" />
					<input type="hidden" id="health_commissions" name="health_commissions" value="" />
					<input type="hidden" id="bank_commissions" name="bank_commissions" value="" />
					<input type="hidden" id="auto_policies_renewed" name="auto_policies_renewed" value="" />
					<input type="hidden" id="fire_policies_renewed" name="fire_policies_renewed" value="" />
					<input type="hidden" id="auto_renewal_premiums" name="auto_renewal_premiums" value="" />
					<input type="hidden" id="fire_renewal_premiums" name="fire_renewal_premiums" value="" />
					<input type="hidden" id="auto_renewal_commissions" name="auto_renewal_commissions" value="" />
					<input type="hidden" id="fire_renewal_commissions" name="fire_renewal_commissions" value="" />
					<input type="hidden" id="trailing_chart_totals" name="trailing_chart_totals[]" value="" />
					<input type="hidden" id="trailing_chart_extra_month" name="trailing_chart_extra_month" value="" />
				</form>
				<button id="close-period">Close This Period&nbsp;&nbsp;<img src="/public/img/btn_close.png" class="search-btn-icon" alt=""></button>
			</div>
			<div id="commission-period-box-closed">
				This Period is<br />
				<br />
				<img src="/public/img/period_closed.png" class="period-closed" />
				<span class="period-bold">CLOSED</span>
			</div>
			<div class="sub-title">Commissions Frequency is <span id="commission_frequency"><?php echo $cf; ?></span></div>
			<div class="commission-search-area">
			<div class="commission-search-title">Search Commission Period</div>
				<form id="search_period_form" name="search_period_form">
					<input id="the_frequency" name="the_frequency" type="hidden" value="<?php echo $frequency; ?>" />
					<input type="radio" id="period1" name="period" value="1" checked /><span class="search-text">Current</span> 
					<input type="radio" id="period2" name="period" value="2" /><span class="search-text">Previous</span>
					&nbsp;
					<span class="search-text">Year:</span>
					<select id="commission_year" name="commission_year" class="short-select">
<?php
$currYear = date('Y');
for ($i=0; $i<10; ++$i) {
	$displayYear = $currYear-$i;
	echo '						<option value="'.$displayYear.'">'.$displayYear.'</option>';
}
?>
					</select>
					&nbsp;
					<span id="period_type" class="search-text">Month:</span>
					<select id="commission_period" name="commission_period" class="short-select"></select>
					<button id="dosubmit2"><img src="/public/img/btn_search.png" class="search-btn-icon" alt="Search" /></button>
				</form>
			</div>
			<div class="commission-status-area">
				<div class="status-table-left">
					<div class="status-text-left">Name: <span id="cname" class="status-item"></span></div>
					<div class="status-text-left">Title: <span id="ctitle" class="status-item"></span></div>
					<div class="status-text-left">Hire Date: <span id="chired" class="status-item"></span></div>
				</div>
				<div class="status-table-right">
					<span class="status-item">Commission History</span><br />
					<div class="status-cell">Lifetime<br /><span id="clifetime" class="status-item"></span></div>
					<div class="status-cell">Last Year<br /><span id="clastyear" class="status-item"></span></div>
					<div class="status-cell">Last YTD<br /><span id="clastytd" class="status-item"></span></div>
					<div class="status-cell">Current YTD<br /><span id="ccurrentytd" class="status-item"></span></div>
					<div class="status-cell">Last Month<br /><span id="clastmonth" class="status-item"></span></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end sub header area -->