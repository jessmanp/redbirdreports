<!-- begin content area -->
<div id="commissions-content">
<h1><strong>Report Period:</strong> December 2015 (Current Period)</h1>
<div class="commission-table">

<div class="commission-left-cell">
	<div class="commission-special">
		<div class="com-title">Special</div>
		<div class="com-holder">
		<button id="update-com-bonus">Update Bonus&nbsp;&nbsp;<img src="/public/img/btn_com_bonus.png" class="search-btn-icon" alt="" width="33" height="28"></button>
		<button id="update-com-other">Update Other&nbsp;&nbsp;<img src="/public/img/btn_com_bonus.png" class="search-btn-icon" alt="" width="33" height="28"></button>
	<div class="com-special-all">
<form >
<!-- begin form -->
		<div class="table-container">
		  <!-- form for editing employees -->
		  <form method="post" action="/app/commissions/putCommissionSpecial" id="com_update_commission_special" name="com_update_commission_special">
			<div class="table-row">
				<div class="col" style="width:40%;"><div class="com-special">Bonus</div></div>
				<div class="col" style="width:60%;">
					<span style="font-size:12px;font-weight:bold;">$</span>
					<input type="text" maxlength="40" style="width:100px;" id="commissions_bonus" name="commissions_bonus" placeholder="0.00" value="">
				</div>
			</div>
		  </form>
		</div>
		<input type="text" maxlength="100" style="width:210px;" id="com_bonus_description" name="com_bonus_description" placeholder="Enter a Brief Description" value="">
<!-- end form -->
</form>
<form >
<!-- begin form -->
		<div class="table-container">
			<div class="table-row">
				<div class="col" style="width:40%;"><div class="com-special">Other</div></div>
				<div class="col" style="width:60%;">
					<span style="font-size:12px;font-weight:bold;">$</span>
					<input type="text" maxlength="40" style="width:100px;" id="commissions_other" name="commissions_other" placeholder="0.00" value="">
				</div>
			</div>
		</div>
		<input type="text" maxlength="100" style="width:210px;" id="com_other_description" name="com_other_description" placeholder="Enter a Brief Description" value="">
		<!-- end form -->
</form>
	</div>
		</div>
		<div class="commission-text-footer">
			<div class="table-container">
				<div class="table-row">
					<div class="col" style="width:60%;text-align:left;padding:0 10px 0 10px;">Total Special</div>
					<div class="col" style="width:40%;text-align:right;padding:0 10px 0 10px;">$100,000.00</div>
				</div>
			</div>
		</div>
	</div>
	<div class="commission-earned">
		<div class="com-title">Commissions Earned</div>
		<div class="com-holder">
		  <div class="table-container">
			<div class="table-row">
				<div class="col" style="width:60%;"><div class="com-earned-bold">New Policies</div></div>
				<div class="col" style="width:40%;"><div class="com-earned-amount">$100,000.00</div></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:60%;"><div class="com-earned-bold">Renewals</div></div>
				<div class="col" style="width:40%;"><div class="com-earned-amount">$100,000.00</div></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:60%;"><div class="com-earned-bold">Bonus</div></div>
				<div class="col" style="width:40%;"><div class="com-earned-amount">$100,000.00</div></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:60%;"><div class="com-earned-bold">Other</div></div>
				<div class="col" style="width:40%;"><div class="com-earned-amount">$100,000.00</div></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:60%;"><div class="com-earned-bold">Charge Backs</div></div>
				<div class="col" style="width:40%;"><div class="com-earned-amount">($10,000.00)</div></div>
			</div>
		  </div>
		</div>
		<div class="commission-text-footer">
			<div class="table-container">
				<div class="table-row">
					<div class="col" style="width:60%;text-align:left;padding:0 10px 0 10px;">Total Commissions</div>
					<div class="col" style="width:40%;text-align:right;padding:0 10px 0 10px;">$100,000.00</div>
				</div>
			</div>
		</div>
	</div>
	<div class="commission-trends">
		<div class="com-title">Commissions Trends - Trailing 12 Months</div>
		<div class="com-holder">
		  <div class="table-container">
<!-- begin row -->
chart here
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
				<div class="col" style="width:28%;"><div class="com-caption">Compensation<br />Earned</div></div>
			</div>
<!-- begin rows -->
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Auto</span></div>
				<div class="col" style="width:28%;padding:5px;">25,000</div>
				<div class="col" style="width:28%;padding:5px;">$100,000.00</div>
				<div class="col" style="width:28%;padding:5px;">$100,000.00</div>
			</div>
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Fire</span></div>
				<div class="col" style="width:28%;padding:5px;">25,000</div>
				<div class="col" style="width:28%;padding:5px;">$100,000.00</div>
				<div class="col" style="width:28%;padding:5px;">$100,000.00</div>
			</div>
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Life</span></div>
				<div class="col" style="width:28%;padding:5px;">25,000</div>
				<div class="col" style="width:28%;padding:5px;">$100,000.00</div>
				<div class="col" style="width:28%;padding:5px;">$100,000.00</div>
			</div>
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Health</span></div>
				<div class="col" style="width:28%;padding:5px;">25,000</div>
				<div class="col" style="width:28%;padding:5px;">$100,000.00</div>
				<div class="col" style="width:28%;padding:5px;">$100,000.00</div>
			</div>
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Bank</span></div>
				<div class="col" style="width:28%;padding:5px;">25,000</div>
				<div class="col" style="width:28%;padding:5px;">$100,000.00</div>
				<div class="col" style="width:28%;padding:5px;">$100,000.00</div>
			</div>
<!-- end rows -->
		  </div>
		</div>
		<div class="commission-text-footer">
		  <div class="table-container">
			<div class="table-row">
				<div class="col" style="width:16%;">Total</div>
				<div class="col" style="width:28%;">100,000</div>
				<div class="col" style="width:28%;">$100,000.00</div>
				<div class="col" style="width:28%;">$100,000.00</div>
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
				<div class="col" style="width:28%;"><div class="com-caption">Compensation<br />Earned</div></div>
			</div>
<!-- begin rows -->
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Auto</span></div>
				<div class="col" style="width:28%;padding:5px;">25,000</div>
				<div class="col" style="width:28%;padding:5px;">$100,000.00</div>
				<div class="col" style="width:28%;padding:5px;">$100,000.00</div>
			</div>
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Fire</span></div>
				<div class="col" style="width:28%;padding:5px;">25,000</div>
				<div class="col" style="width:28%;padding:5px;">$100,000.00</div>
				<div class="col" style="width:28%;padding:5px;">$100,000.00</div>
			</div>
<!-- end rows -->
		  </div>
		</div>
		<div class="commission-text-footer">
		  <div class="table-container">
			<div class="table-row">
				<div class="col" style="width:16%;">Total</div>
				<div class="col" style="width:28%;">100,000</div>
				<div class="col" style="width:28%;">$100,000.00</div>
				<div class="col" style="width:28%;">$100,000.00</div>
			</div>
		  </div>
		</div>
	</div>
</div>

<div style="clear:both;">&nbsp;</div>

</div>

</div>
<!-- end content area -->