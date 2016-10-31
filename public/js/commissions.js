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
	var newh = -300;
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

// setup month array
var months = new Array("January","February","March","April","May","June","July","August","September","October","November","December");
// setup month abbreviated array
var abrvmonths = new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

function populateDates(period,year) {
	var now = new Date();
	var curryear = now.getFullYear();
	var currmonth = now.getMonth()+1;
	var currday = now.getDate();
	$("#commission_period").empty();
	if (period == 1) {
		// check for current year and remove months not yet available
		if (curryear == $("#commission_year").val()) {
			var allmonths = currmonth;
		} else {
			var allmonths = months.length;
		}
		// fill dropdown with months based on year
		for (var i=0; i < allmonths;++i) {
			var month = (i+1);
			var nod = numberOfDays(year,month);
			$("#commission_period").append(
				$("<option></option>").val((i+1)+":1-"+nod).html(months[i])
			);
		}
		var preselmonth = currmonth+":1-"+numberOfDays(year,currmonth);
		if ($("#period1").prop("checked") && curryear == $("#commission_year").val()) {
			$("#commission_period option[value='"+preselmonth+"']").prop("selected", true);
		}
	} else if (period == 2) {
		// check for current year and remove months not yet available
		if (curryear == $("#commission_year").val()) {
			var allmonths = currmonth;
		} else {
			var allmonths = months.length;
		}
		// fill dropdown with bi-months based on year
		for (var i=0; i < allmonths;++i) {
			// calculate days and split in 2
			var month = (i+1);
			var nod = numberOfDays(year,month);
			var halfRoundedUp = (nod % 2) ? nod/2 + .5 : nod/2;
			var halfRoundedDown = (nod % 2) ? nod/2 - .5 : nod/2;
			if (halfRoundedUp == halfRoundedDown) {
				halfRoundedUp = (halfRoundedUp+1);
			}
			var days = new Array(halfRoundedDown,halfRoundedUp);
			for (var j=0; j < days.length;++j) {
				if (j == 0) {
					$("#commission_period").append(
						$("<option></option>").val((i+1)+":1-"+days[j]).html(months[i].substring(0,3)+" 1-"+days[j])
					);
					if (currmonth == month && currday <= days[j]) {
						var selday = currmonth+":1-"+days[j];
					}
				} else {
					if (curryear == year && currmonth == month && currday <= days[j]) {
						// do not add second half of month to dropdown
					} else {
						$("#commission_period").append(
							$("<option></option>").val((i+1)+":"+days[j]+"-"+nod).html(months[i].substring(0,3)+" "+days[j]+"-"+nod)
						);
					}
					if (currmonth == month && currday >= days[j]) {
						var selday = currmonth+":"+days[j]+"-"+nod;
					}
				}
			}
		}
		if ($("#period1").prop("checked") && curryear == $("#commission_year").val()) {
			$("#commission_period option[value='"+selday+"']").prop("selected", true);
		}
	}
}

function loadPeriodDates(period) {
	if (period == 1) {
		$("#period_type").text('Month:');
		populateDates(period,$("#commission_year").val());
	} else if (period == 2) {
		$("#period_type").text('Range:');
		populateDates(period,$("#commission_year").val());
	}
}

// LOAD
$(document).ready(function() {

	// CLOSE MODAL WINDOW
	$("#popupmessage").find(".plain-btn").on("click", function() {
		closeModal();
	});

	// disable dropdowns by default
	$("#commission_year").prop("disabled", true);
	$("#commission_period").prop("disabled", true);
	
	// LOAD PERIOD ON CHANGE
	$("#period2").on("click", function(event) {
		$("#commission_year").prop("disabled", false);
		$("#commission_period").prop("disabled", false);
	});
	$("#period1").on("click", function(event) {
		var now = new Date();
		var curryear = now.getFullYear();
		$("#commission_year option[value='"+curryear+"']").prop("selected", true);
		populateDates($("#the_frequency").val(),curryear);
		$("#commission_year").prop("disabled", true);
		$("#commission_period").prop("disabled", true);
	});
	
	$("#commission_year").on("change", function(event) {
		event.preventDefault();
		// do stuff here
		populateDates($("#the_frequency").val(),$(this).val());
	});

	// HIGHLIGHT MAIN SECTION
	$("#commissions").closest(".main-button").css("background-color","#cccccc");

	// LOAD EMPLOYEES AND UPDATE DROPDOWN
	function updateEmployeeList() {
		$.ajax({
				type: "POST",
				url: "/app/commissions/getEmployeeList",
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
						$("#commission_employees").empty();
						$("#commission_employees").append(
							$("<option></option>").val("").html("- Select -")
						);
						// loop over employees and add each to dropdown
						$.each(data, function(key, value) {
							if (value.user_active == 1) {
								$("#commission_employees").append(
									$("<option></option>").val(value.user_id).html(value.user_first_name+" "+value.user_last_name)
								);
							} else if (value.user_active == 2) {
								$("#commission_employees").append(
									$("<option></option>").val(value.user_id).html("* INACTIVE* ("+value.user_first_name+" "+value.user_last_name+")")
								);
							} else {
								$("#commission_employees").append(
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
	$("#commission_employees").on("change", function(event) {
		event.preventDefault();
		loadUserData($(this).val());
	});
	
	// LOAD EMPLOYEE DATA
	function loadUserData(user_id) {
		if (user_id > 0) {
			var date_range = $("#commission_period").val();
			date_range = date_range+":"+$("#commission_year").val();
			// update employee info into form
			$.ajax({
					type: "GET",
					url: "/app/commissions/getEmployeeCommissionHistory/?eid="+user_id+"&date="+date_range,
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
							// populate form fields with json data
							$.each(data, function(key, value) {
								// populate history
								$("#clifetime").text("$"+value.user_new_lifetime_commission_total.toFixed(2));
								$("#clastyear").text("$"+value.user_new_lastyear_commission_total.toFixed(2));
								$("#clastytd").text("$"+value.user_new_last_ytd_commission_total.toFixed(2));
								$("#ccurrentytd").text("$"+value.user_new_current_ytd_commission_total.toFixed(2));
								$("#clastmonth").text("$"+value.user_new_lastmonth_commission_total.toFixed(2));
								// populate special pay
								$("#bonus_total").text(value.user_bonus.toFixed(2));
								$("#other_total").text(value.user_other.toFixed(2));
								// populate new policy counts
								$("#auto_count_new").text(value.user_new_policy_count_auto);
								$("#fire_count_new").text(value.user_new_policy_count_fire);
								$("#life_count_new").text(value.user_new_policy_count_life);
								$("#health_count_new").text(value.user_new_policy_count_health);
								$("#bank_count_new").text(value.user_new_policy_count_bank);
								var new_policy_count_total = (value.user_new_policy_count_auto+value.user_new_policy_count_fire+value.user_new_policy_count_life+value.user_new_policy_count_health+value.user_new_policy_count_bank);
								$("#new_policy_count_total").text(new_policy_count_total);
								// populate new policy premiums
								$("#auto_premium_new").text(value.user_new_policy_premium_auto.toFixed(2));
								$("#fire_premium_new").text(value.user_new_policy_premium_fire.toFixed(2));
								$("#life_premium_new").text(value.user_new_policy_premium_life.toFixed(2));
								$("#health_premium_new").text(value.user_new_policy_premium_health.toFixed(2));
								$("#bank_premium_new").text(value.user_new_policy_premium_bank.toFixed(2));
								var new_policy_premium_total = (value.user_new_policy_premium_auto+value.user_new_policy_premium_fire+value.user_new_policy_premium_life+value.user_new_policy_premium_health+value.user_new_policy_premium_bank);
								$("#new_policy_premium_total").text(new_policy_premium_total.toFixed(2));
								// populate new policy commissions
								$("#auto_commission_new").text(value.user_new_policy_commission_auto.toFixed(2));
								$("#fire_commission_new").text(value.user_new_policy_commission_fire.toFixed(2));
								$("#life_commission_new").text(value.user_new_policy_commission_life.toFixed(2));
								$("#health_commission_new").text(value.user_new_policy_commission_health.toFixed(2));
								$("#bank_commission_new").text(value.user_new_policy_commission_bank.toFixed(2));
								var new_policy_commission_total = (value.user_new_policy_commission_auto+value.user_new_policy_commission_fire+value.user_new_policy_commission_life+value.user_new_policy_commission_health+value.user_new_policy_commission_bank);
								$("#new_policy_commission_total").text(new_policy_commission_total.toFixed(2));
								// populate renewal counts
								$("#auto_count_renew").text(value.user_renewal_policy_count_auto);
								$("#fire_count_renew").text(value.user_renewal_policy_count_fire);
								var renew_policy_count_total = (value.user_renewal_policy_count_auto+value.user_renewal_policy_count_fire);
								$("#renew_policy_count_total").text(renew_policy_count_total);
								// populate renewal premiums
								$("#auto_premium_renew").text(value.user_renewal_policy_premium_auto.toFixed(2));
								$("#fire_premium_renew").text(value.user_renewal_policy_premium_fire.toFixed(2));
								var renew_policy_premium_total = (value.user_renewal_policy_premium_auto+value.user_renewal_policy_premium_fire);
								$("#renew_policy_premium_total").text(renew_policy_premium_total.toFixed(2));
								// populate renewal commissions
								$("#auto_commission_renew").text(value.user_renewal_policy_commission_auto.toFixed(2));
								$("#fire_commission_renew").text(value.user_renewal_policy_commission_fire.toFixed(2));
								var renew_policy_commission_total = (value.user_renewal_policy_commission_auto+value.user_renewal_policy_commission_fire);
								$("#renew_policy_commission_total").text(renew_policy_commission_total.toFixed(2));
								// populate commissions earned data
								if (!value.user_new_policies){
									$("#new_policies_total").text('0.00');
								} else {
									$("#new_policies_total").text(new_policy_commission_total.toFixed(2));
								}
								if (!value.user_renewals){
									$("#renewals_total").text('0.00');
								} else {
									$("#renewals_total").text(renew_policy_commission_total.toFixed(2));
								}
								if (!value.user_chargebacks) {
									$("#chargebacks_total").text('0.00');
								} else {
									$("#chargebacks_total").text(value.user_chargebacks.toFixed(2));
								}
								var totalcom = ((new_policy_commission_total+renew_policy_commission_total+value.user_bonus+value.user_other)-value.user_chargebacks);
								$("#com_total").text(totalcom.toFixed(2));
								// populate employee info fields
								$("#bonus_employee_id").val(user_id);
								$("#bonus_period").val(date_range);
								$("#other_employee_id").val(user_id);
								$("#other_period").val(date_range);
								$("#emp_default_label").text('');
								$("#emp_first_label").text(value.user_first_name);
								$("#emp_last_label").text(value.user_last_name);
								var fullname = value.user_first_name+" "+value.user_last_name;
								$("#cname").text(fullname);
								if (fullname.length > 24) {
									$("#cname").css('font-size','12px');
								} else {
									$("#cname").removeAttr('style');
								}
								$("#ctitle").text(value.user_job_title);
								if (value.user_hire_date) {
									$("#chired").text(sqlToJsDate(value.user_hire_date));
								} else {
									$("#chired").text('');
								}								
								$("#commissions_bonus").val(value.user_bonus.toFixed(2));
								$("#com_bonus_description").val(value.user_bonus_desc);
								$("#commissions_other").val(value.user_other.toFixed(2));
								$("#com_other_description").val(value.user_other_desc);
								var totalspecial = (value.user_bonus+value.user_other);
								$("#special_total").text(totalspecial.toFixed(2));
								// update report period title	
								$("#com_range").text($("#commission_period option:selected").text());
								$("#com_year").text($("#commission_year").val());
								// ENABLE BONUS BUTTONS
								$("#update-com-bonus").removeClass();
								$("#update-com-bonus").addClass("update-com-bonus");
								$("#update-com-bonus").prop("disabled", false);
								$("#update-com-other").removeClass();
								$("#update-com-other").addClass("update-com-other");
								$("#update-com-other").prop("disabled", false);
								// ENABLE BONUS FIELDS
								$("#commissions_bonus").prop("disabled", false);
								$("#com_bonus_description").prop("disabled", false);
								$("#commissions_other").prop("disabled", false);
								$("#com_other_description").prop("disabled", false);
								// POPULATE CHART
								var trailing_totals = value.user_new_current_ytd_commission_trailing;
								var currtime = new Date();
								var thismonth = currtime.getMonth();
								var currmo = trailing_totals[thismonth];
								trailing_totals.push.apply(trailing_totals,trailing_totals.splice(0,thismonth));
								trailing_totals.push(totalcom);
								popChart(abrvmonths,trailing_totals);
							});
						}	
					},
					error: function (request, status, error) {
							console.log(error);
					}
			});
		} else {
			// DISABLE BONUS BUTTONS
			$("#update-com-bonus").switchClass("update-com-bonus","update-com-bonus-disabled");
			$("#update-com-bonus").prop("disabled", true);
			$("#update-com-other").switchClass("update-com-other","update-com-other-disabled");
			$("#update-com-other").prop("disabled", true);
			// DISABLE BONUS FIELDS
			$("#commissions_bonus").prop("disabled", true);
			$("#com_bonus_description").prop("disabled", true);
			$("#commissions_other").prop("disabled", true);
			$("#com_other_description").prop("disabled", true);
			var empty_val = 0;
			var clifetime_default = '$'+empty_val.toFixed(2);
			var clastyear_default = '$'+empty_val.toFixed(2);
			var clastytd_default = '$'+empty_val.toFixed(2);
			var ccurrentytd_default = '$'+empty_val.toFixed(2);
			var clastmonth_default = '$'+empty_val.toFixed(2);
			// clear fields with data
			$("#emp_default_label").text('No Employee Selected');
			$("#emp_first_label").text('');
			$("#emp_last_label").text('');
			$("#cname").text('');
			$("#ctitle").text('');
			$("#chired").text('');
			$("#clifetime").text(clifetime_default);
			$("#clastyear").text(clastyear_default);
			$("#clastytd").text(clastytd_default);
			$("#ccurrentytd").text(ccurrentytd_default);
			$("#clastmonth").text(clastmonth_default);
			$("#bonus_employee_id").val(-2);
			$("#bonus_period").val('');
			$("#bonus_total").text('0.00');
			$("#other_employee_id").val(-2);
			$("#other_period").val('');
			$("#other_total").text('0.00');
			$("#commissions_bonus").val('');
			$("#com_bonus_description").val('');
			$("#commissions_other").val('');
			$("#com_other_description").val('');
			// clear commissions earned data
			$("#new_policies_total").text('0.00');
			$("#renewals_total").text('0.00');
			$("#chargebacks_total").text('0.00');
			$("#com_total").text('0.00');
			// clear new policy counts
			$("#auto_count_new").text('0');
			$("#fire_count_new").text('0');
			$("#life_count_new").text('0');
			$("#health_count_new").text('0');
			$("#bank_count_new").text('0');
			$("#new_policy_count_total").text('0');
			// clear new policy premiums
			$("#auto_premium_new").text('0.00');
			$("#fire_premium_new").text('0.00');
			$("#life_premium_new").text('0.00');
			$("#health_premium_new").text('0.00');
			$("#bank_premium_new").text('0.00');
			$("#new_policy_premium_total").text('0.00');
			// clear new policy commissions
			$("#auto_commission_new").text('0.00');
			$("#fire_commission_new").text('0.00');
			$("#life_commission_new").text('0.00');
			$("#health_commission_new").text('0.00');
			$("#bank_commission_new").text('0.00');
			$("#new_policy_commission_total").text('0.00');
			// clear renewal counts
			$("#auto_count_renew").text('0');
			$("#fire_count_renew").text('0');
			$("#renew_policy_count_total").text('0');
			// clear renewal premiums
			$("#auto_premium_renew").text('0.00');
			$("#fire_premium_renew").text('0.00');
			$("#renew_policy_premium_total").text('0.00');
			// clear renewal commissions
			$("#auto_commission_renew").text('0.00');
			$("#fire_commission_renew").text('0.00');
			$("#renew_policy_commission_total").text('0.00');
			// clear out chart
			popChart(abrvmonths,0,0,0,0,0,0,0,0,0,0,0,0,0);
		}
	}
	
	// UPDATE SPECIAL BONUS
	$("#update-com-bonus").on("click", function(event) {
		event.preventDefault();
		$("#com_update_special_bonus").submit();
	});
	
	// UPDATE BONUS SUBMIT ACTION
	$("#com_update_special_bonus").submit(function(event) {
		if ($("#bonus_employee_id").val() > 0) {
			$.ajax({
					type: "POST",
					url: "/app/commissions/putSpecialBonus",
					data: $(this).serialize(),
					dataType: "json",
					cache: false,
        			//async: true,
					success: function (data) {
						console.log(data);
						if (data.error == true) {
							// show returned error msg here
							openModal('error',data.msg);
							//$("#employee_email").focus();
						} else {
							//loadUserData('');
							// show success message...
							openModal('info',data.msg);
						}	
					},
					error: function (request, status, error) {
        					console.log(error);
					}
			});
		} else {
			var msg = "<strong>ERROR</strong>, Invalid employee or no employee was selected.";
			// show error message...
			openModal('info',msg);
		}
		event.preventDefault();
	});
	
	// UPDATE SPECIAL OTHER
	$("#update-com-other").on("click", function(event) {
		event.preventDefault();
		$("#com_update_special_other").submit();
	});
	
	// UPDATE OTHER SUBMIT ACTION
	$("#com_update_special_other").submit(function(event) {
		if ($("#other_employee_id").val() > 0) {
			$.ajax({
					type: "POST",
					url: "/app/commissions/putSpecialOther",
					data: $(this).serialize(),
					dataType: "json",
					cache: false,
        			//async: true,
					success: function (data) {
						console.log(data);
						if (data.error == true) {
							// show returned error msg here
							openModal('error',data.msg);
							//$("#employee_email").focus();
						} else {
							//loadUserData('');
							// show success message...
							openModal('info',data.msg);
						}	
					},
					error: function (request, status, error) {
        					console.log(error);
					}
			});
		} else {
			var msg = "<strong>ERROR</strong>, Invalid employee or no employee was selected.";
			// show error message...
			openModal('info',msg);
		}
		event.preventDefault();
	});
	
	// do submit action when search button is clicked
	$("#dosubmit2").on("click", function(event) {
		event.preventDefault();
		loadUserData($("#commission_employees option:selected").val());
	});
	
	// LOAD EMPLOYEES
	updateEmployeeList();
	
	// LOAD INFO TABLE
	loadUserData(0);
	
	// POPULATE SEARCH DROP DOWNS
	loadPeriodDates($("#the_frequency").val());
	
	$("#com_range").text($("#commission_period option:selected").text());
	$("#com_year").text($("#commission_year").val());
	
	function popChart(theMonths,trailing_totals) {

		// CLEAR CANVAS
		$('#compensationChart').replaceWith('<canvas id="compensationChart" width="620" height="160" style="margin:10px 0 0 30px;width:620px; height:160px;"></canvas>');
		
		// POPULATE CHART
		var data = {
			labels: theMonths,
			datasets: [
				{
					label: "Monthly",
					fillColor: "#ba0000",
					data: trailing_totals
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
		
	}
	
	// set order of trailing months
	var currtime = new Date();
	var thismonth = currtime.getMonth();
	var currmo = abrvmonths[thismonth];
	abrvmonths.push.apply(abrvmonths,abrvmonths.splice(0,thismonth));
	abrvmonths.push(currmo); 

	// set defaults for chart
	var trailing_totals = new Array(0,0,0,0,0,0,0,0,0,0,0,0,0);
	
	popChart(abrvmonths,trailing_totals);
	

});

/* ]]> */