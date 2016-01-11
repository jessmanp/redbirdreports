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
	var newh = -175;
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

// LOAD
$(document).ready(function() {

	// HIGHLIGHT MAIN SECTION
	$("#commissions").closest(".main-button").css("background-color","#cccccc");
	
	// LOAD FREQUENCY DATA
	function loadFrequency() {
			// get agency frequency
			$.ajax({
					type: "GET",
					url: "/app/commissions/getCommissionFrequency",
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
								if (value.period_frequency == 1) {
									$("#commission_frequency").text('Monthly');
								} else if (value.period_frequency == 1) {
									$("#commission_frequency").text('Bi-Monthly');
								}
							});
						}	
					},
					error: function (request, status, error) {
							console.log(error);
					}
			});
	}

	// LOAD EMPLOYEES AND UPDATE DROPDOWN
	function updateEmployeeList() {
		$.ajax({
				type: "POST",
				url: "/app/myagency/getEmployeeList",
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
							} else {
								$("#commission_employees").append(
									$("<option></option>").val(value.user_id).html("* Inactive User * ("+value.user_first_name+" "+value.user_last_name+")")
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
			// update employee info into form
			$.ajax({
					type: "GET",
					url: "/app/commissions/getEmployeeCommissionHistory/?eid="+user_id,
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
								
							});
						}	
					},
					error: function (request, status, error) {
							console.log(error);
					}
			});
		} else {
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
		}
	}
	
	// LOAD EMPLOYEES
	updateEmployeeList();
	
	// LOAD INFO TABLE
	loadUserData(0);
	
	// LOAD FREQUENCY
	loadFrequency();

});

/* ]]> */