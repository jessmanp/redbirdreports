/* <![CDATA[ */

// OPEN/CLOSE MESSAGE WINDOW
function openModal(type,message) {
			
	var winh = $(window).height();
	var doch = $(document).height();
	if (winh > doch) {
		$("#modal").height(winh);
	} else {
		$("#modal").height(doch);
	}
	$("#modal").fadeIn();
				
	var winw = $(window).width();
	if (winw < 840) {
		var neww = (winw/2)-152;
	} else {
		var neww = (winw/2)-298;
	}
	//var scrolled_val = $(document).scrollTop().valueOf();
	var newh = -172;
	$("#popupmessage").css({ "margin-left": neww+"px", "margin-top": newh+"px" });
	$("#popupmessage").fadeIn();
	$("#message").fadeIn();
	$("#message").html(message);
			
}

function closeModal() {
	$("#modal").fadeOut();
	$("#popupmessage").fadeOut();
	$("#message").fadeOut();
}

// populate dates
function populateDates() {
	// setup month abbreviated array
	var abrvmonths = new Array("JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC");
	var now = new Date();
	var curryear = now.getFullYear();
	var lastyear = now.getFullYear()-1;
	var currmonth = now.getMonth();
	var lastmonth = now.getMonth()-1;
	$("#date_range").val(date_range);
	$("#dash_this_month").text(abrvmonths[currmonth]);
	$("#dash_last_month").text(abrvmonths[lastmonth]);
	$("#dash_this_year").text(curryear);
	$("#dash_last_year").text(lastyear);
	// update report period title
	$("#date_title").val("Policies This Month");
}

// get number of days in a given month/year
function numberOfDays(year,month) {
    var d = new Date(year, month, 0);
    return d.getDate();
}

// add commas to chart values
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

	// CLOSE MODAL WINDOW
	$("#popupmessage").find(".plain-btn").on("click", function() {
		closeModal();
	});

	// HIGHLIGHT MAIN SECTION
	$("#dashboard").closest(".main-button").css("background-color","#cccccc");
	
	// HIGHLIGHT RANGE
	$("#dash_this_month").closest(".sub-button-big").css("background-color","#000000");

	// UPDATE MAIN BUTTONS
	populateDates();

	// LOAD EMPLOYEES AND UPDATE DROPDOWN
	function updateEmployeeList() {
		$.ajax({
				type: "POST",
				url: "/app/dashboard/getEmployeeList",
				data: $(this).serialize(),
				dataType: "json",
				cache: false,
					async: true,
				success: function (data) {
					console.log(data);
					if (data.error == true) {
						// show returned error msg here
						//openModal('error',data.msg);
					} else {
						// populate employee drop down
						$("#dashboard_employees").empty();
						$("#dashboard_employees").append(
							$("<option></option>").val("0").html("Agency")
						);
						// loop over employees and add each to dropdown
						$.each(data, function(key, value) {
							if (value.user_active == 1) {
								$("#dashboard_employees").append(
									$("<option></option>").val(value.user_id).html(value.user_first_name+" "+value.user_last_name)
								);
							} else if (value.user_active == 2) {
								$("#dashboard_employees").append(
									$("<option></option>").val(value.user_id).html("* INACTIVE* ("+value.user_first_name+" "+value.user_last_name+")")
								);
							} else {
								$("#dashboard_employees").append(
									$("<option></option>").val(value.user_id).html("* INVITED * ("+value.user_first_name+" "+value.user_last_name+")")
								);
							}
						});
					}	
				},
				error: function (request, status, error) {
						console.log(error);
				}
		});
	}
	
	// LOAD EMPLOYEE DATA ON CHANGE
	$("#dashboard_employees").on("change", function(event) {
		event.preventDefault();
		loadUserData($(this).val());
	});
	
	// LOAD EMPLOYEES
	updateEmployeeList();
	
	// LOAD CHARTS DATA
	function loadUserData(user_id) {
		if ($("#dashboard-type-box input[type='radio']:checked").val() === "1") {
		  var ptype = "policy";
		} else if ($("#dashboard-type-box input[type='radio']:checked").val() === "2") {
		  var ptype = "premium";
		}
		var date_range = $("#date_range").val();
		$("#dash_date").text($("#date_title").val());
		//if (user_id > 0) {
			// update employee info into form
			$.ajax({
					type: "GET",
					url: "/app/dashboard/getChartData/?eid="+user_id+"&type="+ptype+"&date="+date_range,
					data: $(this).serialize(),
					dataType: "json",
					cache: false,
						async: true,
					success: function (data) {
						console.log(data);
						if (data.error == true) {
							// show returned error msg here
							openModal('error',data.msg);
						} else {
							$.each(data, function(key, value) {
								if (ptype == 'policy') {
									popPolicyChart(value.ppolicy_chart);
									popSourceChart(value.psource_chart);
								}
								if (ptype == 'premium') {
									popPolicyPremiumChart(value.mpolicy_chart);
									popSourcePremiumChart(value.msource_chart);
								}
							});
							loadYoYData(user_id);
						}	
					},
					error: function (request, status, error) {
							console.log(error);
					}
			});
		//}
	}
	
	// LOAD YEAR OVER YEAR CHART DATA
	function loadYoYData(user_id) {
		if ($("#dashboard-type-box input[type='radio']:checked").val() === "1") {
		  var ptype = "policy";
		} else if ($("#dashboard-type-box input[type='radio']:checked").val() === "2") {
		  var ptype = "premium";
		}
		var now = new Date();
		var curryear = now.getFullYear();
			// update employee info into form
			$.ajax({
					type: "GET",
					url: "/app/dashboard/getBarData/?eid="+user_id+"&type="+ptype+"&year="+curryear,
					data: $(this).serialize(),
					dataType: "json",
					cache: false,
						async: true,
					success: function (data) {
						console.log(data);
						if (data.error == true) {
							// show returned error msg here
							openModal('error',data.msg);
						} else {
							$.each(data, function(key, value) {
								if (ptype == 'policy') {
									popYoYChart(value.count_last_yoy,value.count_this_yoy);
								}
								if (ptype == 'premium') {
									popYoYPremiumChart(value.money_last_yoy,value.money_this_yoy);
								}
							});
						}	
					},
					error: function (request, status, error) {
							console.log(error);
					}
			});
	}
	
	// LOAD POLICY TYPE
	$("#dashboard-type-box input:radio").click(function() {
		// find/replace the type in the title
		var str = $("#date_title").val();
		// update report period title
		if ($(this).val() === "1") {
			var res = str.replace("Premiums", "Policies");
		} else if ($(this).val() === "2") {
			var res = str.replace("Policies", "Premiums");
		}
		$("#date_title").val(res);
		loadUserData($("#dashboard_employees option:selected").val());
	});
	
	// LOAD THIS MONTH RANGE
	$("#this_month").click(function() {
		event.preventDefault();
		$(this).closest(".sub-button-big").css("background-color","#000000");
		$("#last_month").closest(".sub-button-big").removeAttr("style");
		$("#this_year").closest(".sub-button-big").removeAttr("style");
		$("#last_year").closest(".sub-button-big").removeAttr("style");
		var now = new Date();
		var curryear = now.getFullYear();
		var currmonth = now.getMonth()+1;
		var nod = numberOfDays(curryear,currmonth);
		// SET DEFAULT DATE RANGE
		var date_range = currmonth+":1-"+nod+":"+curryear+".";
		$("#date_range").val(date_range);
		// update report period title
		if ($("#dashboard-type-box input[type='radio']:checked").val() === "1") {
			$("#date_title").val("Policies This Month");
		} else if ($("#dashboard-type-box input[type='radio']:checked").val() === "2") {
			$("#date_title").val("Premiums This Month");
		}
		loadUserData($("#dashboard_employees option:selected").val());
	});
	
	// LOAD LAST MONTH RANGE
	$("#last_month").click(function() {
		$(this).closest(".sub-button-big").css("background-color","#000000");
		$("#this_month").closest(".sub-button-big").removeAttr("style");
		$("#this_year").closest(".sub-button-big").removeAttr("style");
		$("#last_year").closest(".sub-button-big").removeAttr("style");
		var now = new Date();
		var curryear = now.getFullYear();
		var lastmonth = now.getMonth();
		var nod = numberOfDays(curryear,lastmonth);
		// SET DEFAULT DATE RANGE
		var date_range = lastmonth+":1-"+nod+":"+curryear+".";
		$("#date_range").val(date_range);
		// update report period title
		if ($("#dashboard-type-box input[type='radio']:checked").val() === "1") {
			$("#date_title").val("Policies Last Month");
		} else if ($("#dashboard-type-box input[type='radio']:checked").val() === "2") {
			$("#date_title").val("Premiums Last Month");
		}
		loadUserData($("#dashboard_employees option:selected").val());
	});
	
	// LOAD THIS YEAR RANGE
	$("#this_year").click(function() {
		$(this).closest(".sub-button-big").css("background-color","#000000");
		$("#this_month").closest(".sub-button-big").removeAttr("style");
		$("#last_month").closest(".sub-button-big").removeAttr("style");
		$("#last_year").closest(".sub-button-big").removeAttr("style");
		var now = new Date();
		var curryear = now.getFullYear();
		// SET DEFAULT DATE RANGE
		var date_range = "1:1-31:"+curryear+"."+"12:1-31:"+curryear;
		$("#date_range").val(date_range);
		// update report period title
		if ($("#dashboard-type-box input[type='radio']:checked").val() === "1") {
			$("#date_title").val("Policies This Year");
		} else if ($("#dashboard-type-box input[type='radio']:checked").val() === "2") {
			$("#date_title").val("Premiums This Year");
		}
		loadUserData($("#dashboard_employees option:selected").val());
	});
	
	// LOAD LAST YEAR RANGE
	$("#last_year").click(function() {
		$(this).closest(".sub-button-big").css("background-color","#000000");
		$("#this_month").closest(".sub-button-big").removeAttr("style");
		$("#last_month").closest(".sub-button-big").removeAttr("style");
		$("#this_year").closest(".sub-button-big").removeAttr("style");
		var now = new Date();
		var lastyear = now.getFullYear()-1;
		// SET DEFAULT DATE RANGE
		var date_range = "1:1-31:"+lastyear+"."+"12:1-31:"+lastyear;
		$("#date_range").val(date_range);
		// update report period title
		if ($("#dashboard-type-box input[type='radio']:checked").val() === "1") {
			$("#date_title").val("Policies Last Year");
		} else if ($("#dashboard-type-box input[type='radio']:checked").val() === "2") {
			$("#date_title").val("Premiums Last Year");
		}
		loadUserData($("#dashboard_employees option:selected").val());
	});
	
	// SET DEFAULT DATE RANGE
	var now = new Date();
	var thisyear = now.getFullYear();
	var thismonth = now.getMonth()+1;
	var nod = numberOfDays(thisyear,thismonth);
	// SET DEFAULT DATE RANGE
	var date_range = thismonth+":1-"+nod+":"+thisyear;
	$("#date_range").val(date_range);
	
	// POPULATE POLICY COUNT CHART FUNCTION
	function popPolicyChart(pvalues) {
	
		var ptotal = 0;
		for (var i = 0; i < pvalues.length; i++) {
			ptotal = (ptotal+pvalues[i]);
		}
	
		if (ptotal === 0) {
			$("#policy_blank_circle").show();
		} else {
			$("#policy_blank_circle").hide();
		}

		// CLEAR CANVAS
		$('#policyTypeChart').replaceWith('<canvas id="policyTypeChart" width="190" height="190" style="width:190px; height:190px;"></canvas>');
	
		// SET COLORS
		var colors = [
			'#fccbcc',
			'#fda2a4',
			'#ff676b', 
			'#e42b30',
			'#c50509',
			'#a20004',
			'#831a1d',
			'#6e1316'
		];

		var data = [
			{ label: 'Auto', value: pvalues[0], color: colors[0] },
			{ label: 'Fire', value: pvalues[1], color: colors[1] },
			{ label: 'Life', value: pvalues[2], color: colors[2] },
			{ label: 'Health', value: pvalues[3], color: colors[3] },
			{ label: 'Bank', value: pvalues[4], color: colors[4] },
			{ label: 'Other', value: pvalues[5], color: colors[5] }
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
		
		// populate total
		$("#policy_total").text(ptotal);
		
	}
	
	// POPULATE POLICY PREMIUM CHART FUNCTION
	function popPolicyPremiumChart(pvalues) {
	
		var ptotal = 0;
		for (var i = 0; i < pvalues.length; i++) {
			ptotal = (ptotal+pvalues[i]);
		}
	
		if (ptotal === 0) {
			$("#policy_blank_circle").show();
		} else {
			$("#policy_blank_circle").hide();
		}

		// CLEAR CANVAS
		$('#policyTypeChart').replaceWith('<canvas id="policyTypeChart" width="190" height="190" style="width:190px; height:190px;"></canvas>');
	
		// SET COLORS
		var colors = [
			'#fccbcc',
			'#fda2a4',
			'#ff676b', 
			'#e42b30',
			'#c50509',
			'#a20004',
			'#831a1d',
			'#6e1316'
		];

		var data = [
			{ label: 'Auto', value: pvalues[0], color: colors[0] },
			{ label: 'Fire', value: pvalues[1], color: colors[1] },
			{ label: 'Life', value: pvalues[2], color: colors[2] },
			{ label: 'Health', value: pvalues[3], color: colors[3] },
			{ label: 'Bank', value: pvalues[4], color: colors[4] },
			{ label: 'Other', value: pvalues[5], color: colors[5] }
		]
 
		var ctx = $("#policyTypeChart").get(0).getContext("2d");
		var policyTypeChart = new Chart(ctx).Doughnut(data, {
			segmentStrokeColor : "#000000",
			animateRotate: false,
			tooltipTemplate : function (label) {
				return label.label + ': $' + label.value.toLocaleString();
			}
		});
		
		$("#policy_legend").html(policyTypeChart.generateLegend());
		
		// populate total
		$("#policy_total").text('$'+ptotal.toLocaleString());
		
	}
	
	// POPULATE SOURCE CHART FUNCTION
	function popSourceChart(svalues) {
	
		var stotal = 0;
		for (var i = 0; i < svalues.length; i++) {
			stotal = (stotal+svalues[i]);
		}
	
		if (stotal === 0) {
			$("#source_blank_circle").show();
		} else {
			$("#source_blank_circle").hide();
		}

		// CLEAR CANVAS
		$('#sourceChart').replaceWith('<canvas id="sourceChart" width="190" height="190" style="width:190px; height:190px;"></canvas>');
		
		// SET COLORS
		var colors = [
			'#fccbcc',
			'#fda2a4',
			'#ff676b', 
			'#e42b30',
			'#c50509',
			'#a20004',
			'#831a1d',
			'#6e1316'
		];
		
		var data = [
			{ label: 'Internet', value: svalues[0], color: colors[0] },
			{ label: 'Referral', value: svalues[1], color: colors[1] },
			{ label: 'Call In', value: svalues[2], color: colors[2] },
			{ label: 'Walk In', value: svalues[3], color: colors[3] },
			{ label: 'Direct Mail', value: svalues[4], color: colors[4] },
			{ label: 'Networking', value: svalues[5], color: colors[5] },
			{ label: 'Cold Call', value: svalues[6], color: colors[6] },
			{ label: 'Other', value: svalues[7], color: colors[7] }
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
	
		// populate total
		$("#source_total").text(stotal);
		
	}
	
	// POPULATE SOURCE CHART FUNCTION
	function popSourcePremiumChart(svalues) {
	
		var stotal = 0;
		for (var i = 0; i < svalues.length; i++) {
			stotal = (stotal+svalues[i]);
		}
	
		if (stotal === 0) {
			$("#source_blank_circle").show();
		} else {
			$("#source_blank_circle").hide();
		}

		// CLEAR CANVAS
		$('#sourceChart').replaceWith('<canvas id="sourceChart" width="190" height="190" style="width:190px; height:190px;"></canvas>');
		
		// SET COLORS
		var colors = [
			'#fccbcc',
			'#fda2a4',
			'#ff676b', 
			'#e42b30',
			'#c50509',
			'#a20004',
			'#831a1d',
			'#6e1316'
		];
		
		var data = [
			{ label: 'Internet', value: svalues[0], color: colors[0] },
			{ label: 'Referral', value: svalues[1], color: colors[1] },
			{ label: 'Call In', value: svalues[2], color: colors[2] },
			{ label: 'Walk In', value: svalues[3], color: colors[3] },
			{ label: 'Direct Mail', value: svalues[4], color: colors[4] },
			{ label: 'Networking', value: svalues[5], color: colors[5] },
			{ label: 'Cold Call', value: svalues[6], color: colors[6] },
			{ label: 'Other', value: svalues[7], color: colors[7] }
		]
 
		var ctx = $("#sourceChart").get(0).getContext("2d");
		var sourceChart = new Chart(ctx).Doughnut(data, {
			segmentStrokeColor : "#000000",
			animateRotate: false,
			tooltipTemplate : function (label) {
				return label.label + ': $' + label.value.toLocaleString();
			}
		});
	
		$("#source_legend").html(sourceChart.generateLegend());
	
		// populate total
		$("#source_total").text('$'+stotal.toLocaleString());
		
	}
	
	// POPULATE POLICES YEARLY SOURCES CHART FUNCTION
	function popYoYChart(thisyear,lastyear) {
	
		// CLEAR CANVAS
		$('#policiesChart').replaceWith('<canvas id="policiesChart" width="590" height="190" style="width:590px; height:190px;"></canvas>');

		var curryear = now.getFullYear();
		var prevyear = now.getFullYear()-1;
	
		var data = {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			datasets: [
				{
					label: "Policies ("+prevyear+")",
					fillColor: "#ba0000",
					data: lastyear
				},
				{
					label: "Policies ("+curryear+")",
					fillColor: "#fe8484",
					data: thisyear
				}
			]
		};
 
		var ctx = $("#policiesChart").get(0).getContext("2d");
		var policiesChart = new Chart(ctx).Bar(data, {
			barShowStroke : true,
			animation: false,
		});
	
		$("#policies_legend").html(policiesChart.generateLegend());
	
	}
	
	// POPULATE POLICES YEARLY PREMIUMS CHART FUNCTION
	function popYoYPremiumChart(thisyear,lastyear) {
	
		// CLEAR CANVAS
		$('#policiesChart').replaceWith('<canvas id="policiesChart" width="590" height="190" style="width:590px; height:190px;"></canvas>');

		var curryear = now.getFullYear();
		var prevyear = now.getFullYear()-1;
	
		var data = {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			datasets: [
				{
					label: "Policies ("+prevyear+")",
					fillColor: "#ba0000",
					data: lastyear
				},
				{
					label: "Policies ("+curryear+")",
					fillColor: "#fe8484",
					data: thisyear
				}
			]
		};
 
		var ctx = $("#policiesChart").get(0).getContext("2d");
		
		var policiesChart = new Chart(ctx).Bar(data, {
			barShowStroke : true,
			animation: false,
			scaleLabel : "<%=addCommas(value)%>",
			tooltipTemplate : function (label) {
				return label.label + ': ' + '$' + label.value.toLocaleString();
			}
		});
	
		$("#policies_legend").html(policiesChart.generateLegend());
	
	}
	
	// LOAD INFO TABLE
	loadUserData(0);

});

/* ]]> */