<!-- begin content area -->
<div id="commissions-content">
<h1><strong>Report Period:</strong> <span id="com_year"></span> - <span id="com_range"></span> (<span id="com_period">Current</span> Period)</h1>
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
		<input type="text" maxlength="100" style="width:215px;margin:7px 0 0 10px;" id="com_bonus_description" name="com_bonus_description" placeholder="Enter a Brief Description" value="">
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
		<input type="text" maxlength="100" style="width:215px;margin:7px 0 0 10px;" id="com_other_description" name="com_other_description" placeholder="Enter a Brief Description" value="">
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
				<div class="col" style="width:60%;"><div class="com-earned">New Policies</div></div>
				<div class="col" style="width:40%;"><div class="com-earned-amount">$2,696.33</div></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:60%;"><div class="com-earned">Renewals</div></div>
				<div class="col" style="width:40%;"><div class="com-earned-amount">$4,139.00</div></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:60%;"><div class="com-earned">Bonus</div></div>
				<div class="col" style="width:40%;"><div class="com-earned-amount">$100.00</div></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:60%;"><div class="com-earned">Other</div></div>
				<div class="col" style="width:40%;"><div class="com-earned-amount">$50.00</div></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:60%;"><div class="com-earned">Charge Backs</div></div>
				<div class="col" style="width:40%;"><div class="com-earned-chargeback">($655.12)</div></div>
			</div>
			<div class="table-row">
				<div class="col" style="width:60%;"><div class="com-earned-bold">Total Commissions</div></div>
				<div class="col" style="width:40%;"><div class="com-earned-amount-bold">$6,330.21</div></div>
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
				<div class="col" style="width:28%;"><div class="com-caption">Compensation<br />Earned</div></div>
			</div>
<!-- begin rows -->
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Auto</span></div>
				<div class="col" style="width:28%;padding:5px;">22</div>
				<div class="col" style="width:28%;padding:5px;">$12,100.34</div>
				<div class="col" style="width:28%;padding:5px;">$968.03</div>
			</div>
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Fire</span></div>
				<div class="col" style="width:28%;padding:5px;">18</div>
				<div class="col" style="width:28%;padding:5px;">$14,422.73</div>
				<div class="col" style="width:28%;padding:5px;">$1,153.82</div>
			</div>
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Life</span></div>
				<div class="col" style="width:28%;padding:5px;">5</div>
				<div class="col" style="width:28%;padding:5px;">$5,032.11</div>
				<div class="col" style="width:28%;padding:5px;">$402.57</div>
			</div>
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Health</span></div>
				<div class="col" style="width:28%;padding:5px;">1</div>
				<div class="col" style="width:28%;padding:5px;">$898.91</div>
				<div class="col" style="width:28%;padding:5px;">$71.91</div>
			</div>
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Bank</span></div>
				<div class="col" style="width:28%;padding:5px;">2</div>
				<div class="col" style="width:28%;padding:5px;">-</div>
				<div class="col" style="width:28%;padding:5px;">$100.00</div>
			</div>
<!-- end rows -->
		  </div>
		</div>
		<div class="commission-text-footer">
		  <div class="table-container">
			<div class="table-row">
				<div class="col" style="width:16%;">Total</div>
				<div class="col" style="width:28%;">48</div>
				<div class="col" style="width:28%;">$32,454.09</div>
				<div class="col" style="width:28%;">$2,696.33</div>
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
				<div class="col" style="width:28%;padding:5px;">179</div>
				<div class="col" style="width:28%;padding:5px;">$98,450.00</div>
				<div class="col" style="width:28%;padding:5px;">$2,170.00</div>
			</div>
			<div class="table-row">
				<div class="col" style="width:16%;padding:5px;"><span class="com-type">Fire</span></div>
				<div class="col" style="width:28%;padding:5px;">155</div>
				<div class="col" style="width:28%;padding:5px;">$108,500.00</div>
				<div class="col" style="width:28%;padding:5px;">$1,969.00</div>
			</div>
<!-- end rows -->
		  </div>
		</div>
		<div class="commission-text-footer">
		  <div class="table-container">
			<div class="table-row">
				<div class="col" style="width:16%;">Total</div>
				<div class="col" style="width:28%;">334</div>
				<div class="col" style="width:28%;">$206,950.00</div>
				<div class="col" style="width:28%;">$4,139.00</div>
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

function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return '$' + x1 + x2;
}

// LOAD
$(document).ready(function() {

	var data = {
		labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan"],
		datasets: [
			{
				label: "Monthly",
				fillColor: "#ba0000",
				data: [4501.00, 4607.00, 4789.00, 4728.00, 5021.00, 4887.00, 5255.00, 5487.00, 5301.00, 5699.00, 5781.00, 5998.00, 6330.00]
			}
		]
	};
 
    var ctx = $("#compensationChart").get(0).getContext("2d");
    var compensationChart = new Chart(ctx).Bar(data, {
    	barShowStroke : true,
    	animation: false,
    	scaleLabel : "<%=addCommas(value)%>",
    	tooltipTemplate : function (label) {
			return label.label + ': ' + '$' + label.value.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		}
	});
	
	
});

/* ]]> */
</script>