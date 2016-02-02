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

// setup month array
var months = new Array("January","February","March","April","May","June","July","August","September","October","November","December");

function populateDates(period,year) {
	var now = new Date();
	var currmonth = now.getMonth()+1;
	var currday = now.getDate();
	$("#commission_period").empty();
	if (period == 1) {
		// fill dropdown with months based on year
		for (var i=0; i < months.length;++i) {
			var month = (i+1);
			var nod = numberOfDays(year,month);
			$("#commission_period").append(
				$("<option></option>").val((i+1)+":1-"+nod).html(months[i])
			);
		}
		$("#commission_period option[value="+currmonth+"]").prop("selected", true);
	} else if (period == 2) {
		// fill dropdown with bi-months based on year
		for (var i=0; i < months.length;++i) {
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
				} else {
					$("#commission_period").append(
						$("<option></option>").val((i+1)+":"+days[j]+"-"+nod).html(months[i].substring(0,3)+" "+days[j]+"-"+nod)
					);	
				}
				if (currday <= days[j]) {
					var selday = "1-"+days[j];
				} else if (currday >= days[j]) {
					selday = days[j]+"-"+nod;
				}
			}
		}
		var preselday = currmonth+":"+selday;
		$("#commission_period option[value='"+preselday+"']").prop("selected", true);	
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
		populateDates($("#the_frequency").val(),curryear);
		$("#commission_year option[value='"+curryear+"']").prop("selected", true);
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
								// fill out fields with data
								$("#bonus_employee_id").val(user_id);
								$("#other_employee_id").val(user_id);
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
								$("#commissions_bonus").val(value.user_bonus);
								$("#com_bonus_description").val(value.user_bonus_desc);
								$("#commissions_other").val(value.user_other);
								$("#com_other_description").val(value.user_other_desc);
								$("#update-com-bonus").removeClass();
								$("#update-com-bonus").addClass("update-com-bonus");
								$("#update-com-bonus").prop("disabled", false);
								$("#update-com-other").removeClass();
								$("#update-com-other").addClass("update-com-other");
								$("#update-com-other").prop("disabled", false);
							});
						}	
					},
					error: function (request, status, error) {
							console.log(error);
					}
			});
		} else {
			// DISABLE BUTTONS
			$("#update-com-bonus").switchClass("update-com-bonus","update-com-bonus-disabled");
			$("#update-com-bonus").prop("disabled", true);
			$("#update-com-other").switchClass("update-com-other","update-com-other-disabled");
			$("#update-com-other").prop("disabled", true);
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
			$("#other_employee_id").val(-2);
			$("#commissions_bonus").val('');
			$("#com_bonus_description").val('');
			$("#commissions_other").val('');
			$("#com_other_description").val('');
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
		alert("do period search");
	});
	
	
	// LOAD EMPLOYEES
	updateEmployeeList();
	
	// LOAD INFO TABLE
	loadUserData(0);
	
	loadPeriodDates($("#the_frequency").val());
	
	$("#com_range").text($("#commission_period option:selected").text());
	$("#com_year").text($("#commission_year").val());
	

});

/* ]]> */