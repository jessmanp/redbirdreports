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
<?php
$open=1;
if ($open == 1) {
?>
				<img src="/public/img/period_open.png" class="period-open" />
				<span style="font-weight:bold;font-size:24px;line-height:36px;">OPEN</span>
				<button id="close-period">Close This Period&nbsp;&nbsp;<img src="/public/img/btn_close.png" class="search-btn-icon" alt=""></button>
<?php
} elseif ($open == 0) {
?>
				<br />
				<img src="/public/img/period_closed.png" class="period-closed" />
				<span style="font-weight:bold;font-size:24px;line-height:36px;">CLOSED</span>
<?php
}
?>
			</div>
			<div class="sub-title">Commissions Frequency is #frequency_variable#</div>
			<div class="commission-search-area">
			<div class="commission-search-title">Search Commission Period</div>
				<form id="search_text_form" name="search_text_form">
					<input type="radio" id="period" name="period" value="1" checked /><span class="search-text">Current</span> 
					<input type="radio" id="period" name="period" value="2" /><span class="search-text">Previous</span>
					&nbsp;&nbsp;
					<span class="search-text">Month:</span>
					<select id="commission_months" name="commission_months" class="short-select">
<?php
for ($i = 0; $i <= 11; ++$i) {
	$time = strtotime(sprintf('first day of -%d month', $i));
	$value = date('m', $time);
	$label = date('F', $time);
	printf('						<option value="%s">%s</option>', $value, $label);
}
?>
					</select>
					&nbsp;
					<span class="search-text">Year:</span>
					<select id="commission_years" name="commission_years" class="short-select">
<?php
$currYear = date('Y');
for ($i=0; $i<10; ++$i) {
	$displayYear = $currYear-$i;
	echo '						<option value="'.$displayYear.'">'.$displayYear.'</option>';
}
?>
					</select>
					<button id="dosubmit2"><img src="/public/img/btn_search.png" class="search-btn-icon" alt="Search" /></button>
				</form>
			</div>
			<div class="commission-status-area">
				<div class="status-table-left">
					<div class="status-text-left">Name: <span id="cname" class="status-item">John Doe</span></div>
					<div class="status-text-left">Title: <span id="ctitle" class="status-item">Account Representative</span></div>
					<div class="status-text-left">Hire Date: <span id="chired" class="status-item">2/4/2014</span></div>
				</div>
				<div class="status-table-right">
					<span class="status-item">Commission History</span><br />
					<div class="status-cell">Lifetime<br /><span id="clifetime" class="status-item">$1,000,000.00</span></div>
					<div class="status-cell">Last Year<br /><span id="clastyear" class="status-item">$1,000,000.00</span></div>
					<div class="status-cell">Last YTD<br /><span id="clastytd" class="status-item">$1,000,000.00</span></div>
					<div class="status-cell">Current YTD<br /><span id="ccurrentytd" class="status-item">$1,000,000.00</span></div>
					<div class="status-cell">Last Month<br /><span id="clastmonth" class="status-item">$1,000,000.00</span></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end sub header area -->