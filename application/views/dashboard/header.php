<?php

?>
<!-- begin sub header area -->
<div id="dashboard-header">
	<div id="sub-menu-mid">
		<div id="dashboard-container">
			<div id="dashboard-employee-box">
				<strong>View Report</strong><br /><br />
				<select id="dashboard_employees" name="dashboard_employees" class="policy-entry-select">
					<option value="0">Agency</option>
				</select>
			</div>
			<div id="dashboard-period-box">
			<div id="dashboard-type-box">
				<strong>Report Type</strong>
				<br /><br />
				<input type="radio" name="dash_type" value="1" checked /><span class="search-text">&nbsp;Policy&nbsp;&nbsp;&nbsp;</span>
				<input type="radio" name="dash_type" value="2" /><span class="search-text">&nbsp;Premium</span>
				<input id="date_range" type="hidden" name="date_range" value="" />
				<input id="date_title" type="hidden" name="date_title" value="" />
			</div>
			<div id="this_month" class="sub-button-big">
				<div id="dash_this_month" class="on-btn-text"></div>
				<img src="/public/img/btn_calendar.png" class="sub-btn-icon" alt="This Month" width="120" height="92">
				<div class="sub-btn-text">This Month</div>
			</div>
			<div id="last_month" class="sub-button-big">
				<div id="dash_last_month" class="on-btn-text"></div>
				<img src="/public/img/btn_calendar.png" class="sub-btn-icon" alt="Last Month" width="120" height="92">
				<div class="sub-btn-text">Last Month</div>
			</div>
			<div id="this_year" class="sub-button-big">
				<div id="dash_this_year" class="on-btn-text"></div>
				<img src="/public/img/btn_calendar.png" class="sub-btn-icon" alt="This Year" width="120" height="92">
				<div class="sub-btn-text">This Year</div>
			</div>
			<div id="last_year" class="sub-button-big">
				<div id="dash_last_year" class="on-btn-text"></div>
				<img src="/public/img/btn_calendar.png" class="sub-btn-icon" alt="Last Year" width="120" height="92">
				<div class="sub-btn-text">Last Year</div>
			</div>
			
			</div>
		</div>
	</div>
</div>
<!-- end sub header area -->