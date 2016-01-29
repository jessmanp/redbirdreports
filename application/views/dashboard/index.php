<!-- begin sub header area -->
<div id="sub-header"></div>
<!-- begin sub header area -->

<!-- begin content area -->
<div id="dashboard-content">

	<div id="dashboard-container">

		<div id="policy-chart-container">
			<div class="com-title">Policy Type</div>
			<div style="background-color:#ffffff;padding:20px 0 15px 0;">
				<div class="chart-center">59</div>
				<canvas id="policyTypeChart" width="190" height="190" style="width:190px; height:190px;"></canvas>
				<div id="policy_legend" class="chart-legend"></div>
			</div>
		</div>
		
		<div id="source-chart-container">
			<div class="com-title">Source</div>
			<div style="background-color:#ffffff;padding:20px 0 15px 0;">
				<div class="chart-center">59</div>
				<canvas id="sourceChart" width="190" height="190" style="width:190px; height:190px;"></canvas>
				<div id="source_legend" class="chart-legend"></div>
			</div>
		</div>
		
		<div id="policies-chart-container">
			<div class="com-title">Policies</div>
			<div style="background-color:#ffffff;padding:20px 0 15px 0;">
				<canvas id="policiesChart" width="590" height="190" style="width:590px; height:190px;"></canvas>
				<div id="policies_legend" class="chart-legend"></div>
			</div>
		</div>
		
		<div style="clear:both;">&nbsp;</div>
		
	</div>

</div>
<!-- end content area -->
<!-- Scripts -->
<script>
/* <![CDATA[ */

// LOAD
$(document).ready(function() {

	var colors = [
		'#fccbcc',
		'#fda2a4',
		'#ff676b', 
		'#e42b30',
		'#c50509',
		'#a20004',
		'#831a1d',
		'#6e1316'
		/*
		'#76bc49', 
		'#55813d',
		'#6aa443',
		'#5c8c3d',
		'#679a43',
		'#374b2a',
		'#466232',
		'#242f22'
		
		'#bca4e7',
		'#fbffe9',
		'#8ce898',
		'#fdfea1',
		'#febe6f',
		'#fbc3e9', 
		'#b0f9f8',
		'#aabbc8'
		*/
	];

    var data = [
		{ label: 'Auto', value: 21, color: colors[0] },
		{ label: 'Fire', value: 17, color: colors[1] },
		{ label: 'Life', value: 3, color: colors[2] },
		{ label: 'Health', value: 7, color: colors[3] },
		{ label: 'Bank', value: 2, color: colors[4] },
		{ label: 'Other', value: 9, color: colors[5] }
	]
 
    var ctx = $("#policyTypeChart").get(0).getContext("2d");
    var policyTypeChart = new Chart(ctx).Doughnut(data, {
    	segmentStrokeColor : "#000000",
		animateRotate: false,
		tooltipTemplate : function (label) {
			return label.label + ': ' + label.value.toString();
		}
	});
	
	$("#policy_legend").html(policyTypeChart.generateLegend());
	
	var data = [
		{ label: 'Referral', value: 5, color: colors[0] },
		{ label: 'Cold Call', value: 25, color: colors[1] },
		{ label: 'Internet Lead', value: 7, color: colors[2] },
		{ label: 'Direct Mail', value: 6, color: colors[3] },
		{ label: 'Call In', value: 2, color: colors[4] },
		{ label: 'Website', value: 7, color: colors[5] },
		{ label: 'Walk In', value: 3, color: colors[6] },
		{ label: 'Other', value: 4, color: colors[7] }
	]
 
    var ctx = $("#sourceChart").get(0).getContext("2d");
    var sourceChart = new Chart(ctx).Doughnut(data, {
    	segmentStrokeColor : "#000000",
		animateRotate: false,
		tooltipTemplate : function (label) {
			return label.label + ': ' + label.value.toString();
		}
	});
	
	$("#source_legend").html(sourceChart.generateLegend());
	
	var data = {
		labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
		datasets: [
			{
				label: "Policies (2015)",
				fillColor: "#ba0000",
				data: [55, 51, 73, 70, 65, 81, 77, 72, 62, 90, 92, 71]
			},
			{
				label: "Policies (2016)",
				fillColor: "#fe8484",
				data: [68, 78]
			}
		]
	};
 
    var ctx = $("#policiesChart").get(0).getContext("2d");
    var policiesChart = new Chart(ctx).Bar(data, {
    	barShowStroke : true,
    	animation: false,
	});
	
	$("#policies_legend").html(policiesChart.generateLegend());
	
});

/* ]]> */
</script>