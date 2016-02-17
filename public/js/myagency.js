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

// OPEN/CLOSE POPUP WINDOW
function openWindow(type,message,id,fname,lname,jobtitle) {

	$("#myagency-window").hide();

	var winh = $(window).height();
	var doch = $(document).height();
	if (winh > doch) {
		$("#myagency-popup").height(winh);
	} else {
		$("#myagency-popup").height(doch);
	}
	$("#myagency-popup").fadeIn();
				
	var winw = $(window).width();
	var neww = (winw/2)-398;
	var scrolled_val = $(document).scrollTop().valueOf();
	var newh = (scrolled_val+25);
	
	$("#myagency-window").css({ "margin-left": neww+"px", "margin-top": "-175px" });
	$("#myagency-window").fadeIn("fast");
	$(".myagency-message").fadeIn("fast");
	$(".myagency-message").text(message);
	
	if (type == 'edit') {
		$("#myagency-delete").hide();
		$("#myagency-undelete").hide();
		$("#employee-invite").fadeIn();
	}
	
	if (type == 'delete') {
		// LOAD TRANSFER EMPLOYEES
		updateEmployeeTransferList(id);
		$("#employee-invite").hide();
		$("#myagency-undelete").hide();
		$("#myagency-delete").fadeIn();
		$("#myagency-delete #delid").val(id);
		$("#myagency-delete").find("p").text('');
		$("#myagency-delete").find("p").html('<em>Employee Preview</em><br /><br /><div class="delete-table-container"><div class="delete-table-row"><div class="edit-col"><strong>Employee Name:</strong></div><div class="delete-col">'+fname+'&nbsp;'+lname+'</div></div><div class="delete-table-row"><div class="edit-col"><strong>Job Title:</strong></div><div class="delete-col">'+jobtitle+'</div></div></div>');
	}
	
	if (type == 'undelete') {
		$("#employee-invite").hide();
		$("#myagency-delete").hide();
		$("#myagency-undelete").fadeIn();
		$("#myagency-undelete #udelid").val(id);
		$("#myagency-undelete").find("p").text('');
		$("#myagency-undelete").find("p").html('<em>Employee Preview</em><br /><br /><div class="delete-table-container"><div class="delete-table-row"><div class="edit-col"><strong>Employee Name:</strong></div><div class="delete-col">'+fname+'&nbsp;'+lname+'</div></div><div class="delete-table-row"><div class="edit-col"><strong>Job Title:</strong></div><div class="delete-col">'+jobtitle+'</div></div></div>');
	}

}

function closeWindow() {
	$("#myagency-popup").fadeOut("fast");
	$("#myagency-window").fadeOut("fast");
	$(".myagency-message").fadeOut("fast");
	$("#employee-invite").fadeOut("fast");
	$("#myagency-text").fadeOut("fast");
	$("#myagency-delete").fadeOut("fast");
}

// LOAD TRANSFER EMPLOYEES AND UPDATE DROPDOWN
function updateEmployeeTransferList(removeid) {
	$.ajax({
			type: "POST",
			url: "/app/myagency/getEmployeeTransferList",
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
					// update was successful refresh/populate employee drop down
					$("#swapid").empty();
					$("#swapid").append(
						$("<option></option>").val("").html("- Select -")
					);
					// loop over employees and add each to dropdown
					$.each(data, function(key, value) {
						if (value.user_id != removeid) {
							$("#swapid").append(
								$("<option></option>").val(value.user_id).html(value.user_first_name+" "+value.user_last_name)
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

// INVITE EMPLOYEE
function openInviteWindow() {
	openWindow('edit','Invite Employee','','','','');
}

// DELETE EMPLOYEE
function doEmployeeDelete(id,first,last) {
	openWindow('delete','Remove Employee',id,first,last);
}

// LOAD
$(document).ready(function() {

	// CLOSE MODAL WINDOW
	$("#popupmessage").find(".plain-btn").on("click", function() {
		closeModal();
	});

	// HIGHLIGHT MAIN SECTION
	$("#myagency").closest(".main-button").css("background-color","#cccccc");

	// INFO *Default
	$("#info").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/myagency";
	});
	
	// SETTINGS
	$("#agencysettings").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/myagency/agencysettings";
	});
	
	// EMPLOYEES
	$("#employees").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/myagency/employees";
	});

	// BILLING
	$("#billing").on("click", function(event) {
		event.preventDefault();
		window.location.href = "/app/myagency/billing";
	});
	
	// LOAD EMPLOYEE DATA ON CHANGE
	$("#agency_employees").on("change", function(event) {
		event.preventDefault();
		loadUserData($(this).val());
	});
	
	$("#agency_info_save").on("click", function(event) {
		event.preventDefault();
		$('#update_agency_info_form').submit();
	});
	
	// INFO SUBMIT ACTION
	$("#update_agency_info_form").submit(function(event) {
		$.ajax({
					type: "POST",
					url: "/home/saveAgencySetup",
					data: $(this).serialize(),
					dataType: "json",
					cache: false,
        				async: true,
					success: function (data) {
						console.log(data);
						if (data.error == true) {
							// show returned error msg here
							openModal('error',data.msg);
							//$("#agency_name").focus();
						} else {
							// show success message...
							openModal('info',data.msg);
						}	
					},
					error: function (request, status, error) {
        					console.log(error);
					}
		});
		event.preventDefault();
	});
	
	// LOAD FREQUENCY DATA
	function loadFrequency() {
			// get agency frequency
			$.ajax({
					type: "GET",
					url: "/app/myagency/getSettings",
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
								$("#agency_frequency option[value="+value.period_frequency+"]").prop("selected", true);
							});
						}	
					},
					error: function (request, status, error) {
							console.log(error);
					}
			});
	}
	
	$("#agency_settings_save").on("click", function(event) {
		event.preventDefault();
		$('#agency_settings_form').submit();
	});
	
	// SETTINGS SUBMIT ACTION
	$('#agency_settings_form').submit(function(event) {
        		$.ajax({
					type: 'POST',
					url: '/app/myagency/saveSettings',
					data: $(this).serialize(),
					dataType: 'json',
					cache: false,
        			//async: true,
				success: function (data) {
						console.log(data);
						if (data.error == true) {
							// show returned error msg here
							openModal('error',data.msg);
						} else {
							// show success message...
							openModal('info',data.msg);
						}	
				},
					error: function (request, status, error) {
        					console.log(error);
				}
                });
		event.preventDefault();
	});
	
	$("#invite-employee").on("click", function(event) {
		event.preventDefault();
		$("#employee_first_name").val("");
		$("#employee_last_name").val("");
		$("#employee_email").val("");
		$("#employee_email_verify").val("");
		$("#employee_type").val("").change();
		openInviteWindow();
	});
	
	// INVITE SUBMIT ACTION
	$("#agency_invite_employee").submit(function(event) {
		$.ajax({
					type: "POST",
					url: "/home/inviteEmployeeSetup",
					data: $(this).serialize(),
					dataType: "json",
					cache: false,
        				async: true,
					success: function (data) {
						console.log(data);
						if (data.error == true) {
							// show returned error msg here
							openModal('error',data.msg);
							//$("#employee_email").focus();
						} else {
							// invite was successful, clear fields...
							$("#employee_first_name").val("");
							$("#employee_last_name").val("");
							$("#employee_email").val("");
							$("#employee_email_verify").val("");
							$("#employee_type").val("").change();
							// tuen on update button
							$("#agency_employee_save").removeClass();
							$("#agency_employee_save").addClass("plain-btn");
							$("#agency_employee_save").prop("disabled", false);
							// update user drop down
							updateEmployeeList();
  							// auto select added employee and auto populate data into form
							loadUserData(data.id);
							closeWindow();
							// show success message...
							openModal('info',data.msg);
						}	
					},
					error: function (request, status, error) {
        					console.log(error);
					}
		});
		event.preventDefault();
	});
	
	$("#resend-invite-employee").on("click", function(event) {
		event.preventDefault();
		$('#reinvite_employee').submit();
	});
	
	// REINVITE EMPLOYEE SUBMIT ACTION
	$("#reinvite_employee").submit(function(event) {
		if ($("#reinvite_employee_id").val() > 0) {
			$.ajax({
					type: "POST",
					url: "/home/resendInvite",
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
	
	$("#remove-invite-employee").on("click", function(event) {
		event.preventDefault();
		$('#remove_employee').submit();
	});
	
	// REMOVE EMPLOYEE SUBMIT ACTION
	$("#remove_employee").submit(function(event) {
		if ($("#remove_employee_id").val() > 0) {
			$.ajax({
					type: "POST",
					url: "/app/myagency/removeEmployee",
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
							// show success message...
							openModal('info',data.msg);
							// update user drop down
							updateEmployeeList();
  							// auto select added employee and auto populate data into form
							loadUserData(data.id);
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
	
	// LOAD EMPLOYEES AND UPDATE DROPDOWN
	function updateEmployeeList(action) {
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
						if (!action) {
							// DISABLE BUTTONS
							$("#agency_employee_save").switchClass("plain-btn","plain-btn-disabled");
							$("#agency_employee_save").prop("disabled", true);
							$("#agency_employee_erase").switchClass("plain-btn-erase","plain-btn-erase-disabled");
							$("#agency_employee_erase").prop("disabled", true);
							$("#agency_employee_restore").switchClass("plain-btn-erase","plain-btn-erase-disabled");
							$("#agency_employee_restore").prop("disabled", true);
						}
						// update was successful refresh/populate employee drop down
						$("#agency_employees").empty();
						$("#agency_employees").append(
							$("<option></option>").val("").html("- Select -")
						);
						// loop over employees and add each to dropdown
						$.each(data, function(key, value) {
							if (value.user_active == 1) {
								$("#agency_employees").append(
									$("<option></option>").val(value.user_id).html(value.user_first_name+" "+value.user_last_name)
								);
							} else if (value.user_active == 2) {
								$("#agency_employees").append(
									$("<option></option>").val(value.user_id).html("* INACTIVE* ("+value.user_first_name+" "+value.user_last_name+")")
								);
							} else {
								$("#agency_employees").append(
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
	
	$("#close-add-employee-btn").on("click", function(event) {
		event.preventDefault();
		closeWindow();
	});
	
	$("#add-employee-btn").on("click", function(event) {
		event.preventDefault();
		$('#agency_invite_employee').submit();
	});
	
	// LOAD EMPLOYEE DATA
	function loadUserData(user_id) {
		if (user_id > 0) {
			// update employee info into form
			$.ajax({
					type: "GET",
					url: "/app/myagency/getEmployeeData/?eid="+user_id,
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
							$("#agency_employee_erase").hide();
							$("#agency_employee_restore").hide();
							$("#resend-invite-employee").hide();
							$("#remove-invite-employee").hide();
							$("#employee_type_field option[value='3']").remove();
							$("#employee_type_field").prop("disabled", false);
							// populate form fields with json data
							$.each(data, function(key, value) {
								// fill out fields with data
								$("#emp_default_label").text('');
								$("#emp_first_label").text(value.user_first_name);
								$("#emp_last_label").text(value.user_last_name);
								$("#employee_id").val(user_id);
								$("#employee_first_name_field").val(value.user_first_name);
								$("#employee_last_name_field").val(value.user_last_name);
								$("#employee_email_field").val(value.user_email);
								$("#employee_email_verify_field").val(value.user_email);
								$("#employee_job_title_field").val(value.user_job_title);
								$("#employee_zip_code_field").val(value.user_zip_code);
								$("#employee_phone_field").val(value.user_phone);
								$("#employee_mobile_field").val(value.user_mobile);
								$("#employee_username_field").val(value.user_name);
								if (value.user_hire_date) {
									$("#employeehiredate").val(sqlToJsDate(value.user_hire_date));
								} else {
									$("#employeehiredate").val('');
								}
								if (value.user_level == 3) {
									$("#employee_type_field").append($("<option></option>").val("3").html("Owner"));
									$("#agency_update_employee").prepend('<input type="hidden" name="employee_type" value="3" />');
									$("#employee_type_field").prop("disabled", true);
								}
								$("#employee_type_field option[value="+value.user_level+"]").prop("selected", true);
								$("#employee_auto_new").val(value.commission_auto_new);
								$("#employee_auto_added").val(value.commission_auto_add);
								$("#employee_auto_reinstated").val(value.commission_auto_reinstate);
								$("#employee_auto_transferred").val(value.commission_auto_transfer);
								$("#employee_auto_renewal").val(value.commission_auto_renew);
								$("#employee_fire_new").val(value.commission_fire_new);
								$("#employee_fire_added").val(value.commission_fire_add);
								$("#employee_fire_reinstated").val(value.commission_fire_reinstate);
								$("#employee_fire_transferred").val(value.commission_fire_transfer);
								$("#employee_fire_renewal").val(value.commission_fire_renew);
								$("#employee_life_new").val(value.commission_life_new);
								//$("#employee_life_increase").val(value.commission_life_increase);
								$("#employee_life_policy").val(value.commission_life_dollar);
								$("#employee_health_new").val(value.commission_health_new);
								$("#employee_health_policy").val(value.commission_health_dollar);
								$("#employee_bank_deposit_product").val(value.commission_deposit_product);
								$("#employee_bank_loan_product").val(value.commission_loan_product);
								$("#employee_bank_fund_product").val(value.commission_fund_product);
								if (value.user_active == 1) {
									$("#agency_employee_erase").fadeIn();
									$("#agency_employee_erase").removeClass();
									$("#agency_employee_erase").addClass("plain-btn-erase");
									$("#agency_employee_erase").prop("disabled", false);
								} else if (value.user_active == 2) {
									$("#agency_employee_restore").fadeIn();
									$("#agency_employee_restore").removeClass();
									$("#agency_employee_restore").addClass("plain-btn-erase");
									$("#agency_employee_restore").prop("disabled", false);
								} else {
									$("#reinvite_employee_id").val(user_id);
									$("#resend-invite-employee").css("display","inline");
									$("#remove_employee_id").val(user_id);
									$("#remove-invite-employee").css("display","inline");
									$("#agency_employee_erase").fadeIn();
									$("#agency_employee_erase").switchClass("plain-btn-erase","plain-btn-erase-disabled");
									$("#agency_employee_erase").prop("disabled", true);
								}
								if (value.user_level == 3) {									
									$("#agency_employee_erase").switchClass("plain-btn-erase","plain-btn-erase-disabled");
									$("#agency_employee_erase").prop("disabled", true);
								}
								$("#agency_employee_save").removeClass();
								$("#agency_employee_save").addClass("plain-btn");
								$("#agency_employee_save").prop("disabled", false);
							});
						}	
					},
					error: function (request, status, error) {
							console.log(error);
					}
			});
		} else {
			// clear fields with data
			$("#employee_id").val(-2);
			$("#emp_default_label").text('No Employee Selected');
			$("#emp_first_label").text('');
			$("#emp_last_label").text('');
			$("#employee_first_name_field").val('');
			$("#employee_last_name_field").val('');
			$("#employee_email_field").val('');
			$("#employee_email_verify_field").val('');
			$("#employee_job_title_field").val('');
			$("#employee_zip_code_field").val('');
			$("#employee_phone_field").val('');
			$("#employee_mobile_field").val('');
			$("#employee_username_field").val('');
			$("#employee_type_field option[value='']").prop("selected", true);
			$("#employeehiredate").val('');
			$("#employee_auto_new").val('');
			$("#employee_auto_added").val('');
			$("#employee_auto_reinstated").val('');
			$("#employee_auto_transferred").val('');
			$("#employee_auto_renewal").val('');
			$("#employee_fire_new").val('');
			$("#employee_fire_added").val('');
			$("#employee_fire_reinstated").val('');
			$("#employee_fire_transferred").val('');
			$("#employee_fire_renewal").val('');
			$("#employee_life_new").val('');
			//$("#employee_life_increase").val('');
			$("#employee_life_policy").val('');
			$("#employee_health_new").val('');
			$("#employee_health_policy").val('');
			$("#employee_bank_deposit_product").val('');
			$("#employee_bank_loan_product").val('');
			$("#employee_bank_fund_product").val('');
			// DISABLE BUTTONS
			$("#agency_employee_save").switchClass("plain-btn","plain-btn-disabled");
			$("#agency_employee_save").prop("disabled", true);
			$("#agency_employee_erase").switchClass("plain-btn-erase","plain-btn-erase-disabled");
			$("#agency_employee_erase").prop("disabled", true);
			$("#agency_employee_restore").switchClass("plain-btn-erase","plain-btn-erase-disabled");
			$("#agency_employee_restore").prop("disabled", true);
			$("#resend-invite-employee").hide();
			$("#remove-invite-employee").hide();
			
		}
	}
	
	$("#agency_employee_save").on("click", function(event) {
		event.preventDefault();
		$('#agency_update_employee').submit();
	});
	
	// SAVE EMPLOYEE SUBMIT ACTION
	$("#agency_update_employee").submit(function(event) {
		if ($("#employee_id").val() > 0) {
			$.ajax({
					type: "POST",
					url: "/app/myagency/putEmployeeData",
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
							updateEmployeeList(1);
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
	
	$("#agency_employee_erase").on("click", function(event) {
		event.preventDefault();
		deleteEmployee($("#employee_id").val(),$("#employee_first_name_field").val(),$("#employee_last_name_field").val(),$("#employee_job_title_field").val());
	});
	
	// DEACTIVATE EMPLOYEE
	function deleteEmployee(user_id,fname,lname,jobtitle) {
		$("#myagency_undelete").hide();
		if (user_id > 0) {
			openWindow('delete','Deactivate Employee',user_id,fname,lname,jobtitle);
		} else {
			var msg = "<strong>ERROR</strong>, Invalid employee or no employee was selected.";
			// show error message...
			openModal('info',msg);
		}
	}
	
	$("#agency_employee_restore").on("click", function(event) {
		event.preventDefault();
		undeleteEmployee($("#employee_id").val(),$("#employee_first_name_field").val(),$("#employee_last_name_field").val(),$("#employee_job_title_field").val());
	});
	
	// REACTIVATE EMPLOYEE
	function undeleteEmployee(user_id,fname,lname,jobtitle) {
		if (user_id > 0) {
			openWindow('undelete','Reactivate Employee',user_id,fname,lname,jobtitle);
		} else {
			var msg = "<strong>ERROR</strong>, Invalid employee or no employee was selected.";
			// show error message...
			openModal('info',msg);
		}
	}
	
	$(".plain-btn-close").on("click", function(event) {
		event.preventDefault();
		closeWindow();
	});
	
	$("#employee_delete").on("click", function(event) {
		event.preventDefault();
		$('#employee_delete_form').submit();
	});
	
	$('#employee_delete_form').submit(function(event) {
        		$.ajax({
					type: 'POST',
					url: '/app/myagency/deleteEmployee',
					data: $(this).serialize(),
					dataType: 'json',
					cache: false,
        			//async: true,
				success: function (data) {
						console.log(data);
						if (data.error == true) {
							// show returned error msg here
							openModal('error',data.msg);
						} else {
							updateEmployeeList();
							loadUserData('');
							closeWindow();
							// show success message...
							openModal('info',data.msg);
						}	
				},
					error: function (request, status, error) {
        					console.log(error);
				}
                });
		event.preventDefault();
	});

	$("#employee_undelete").on("click", function(event) {
		event.preventDefault();
		$('#employee_undelete_form').submit();
	});
	
	$('#employee_undelete_form').submit(function(event) {
        		$.ajax({
					type: 'POST',
					url: '/app/myagency/undeleteEmployee',
					data: $(this).serialize(),
					dataType: 'json',
					cache: false,
        			//async: true,
				success: function (data) {
						console.log(data);
						if (data.error == true) {
							// show returned error msg here
							openModal('error',data.msg);
						} else {
							updateEmployeeList();
							loadUserData('');
							closeWindow();
							// show success message...
							openModal('info',data.msg);
						}	
				},
					error: function (request, status, error) {
        					console.log(error);
				}
                });
		event.preventDefault();
	});
	
	// LOAD FREQUENCY
	loadFrequency();
	
	// LOAD EMPLOYEES
	updateEmployeeList();
	
	// load employee date picker
	$("#employeehiredate").datepicker({ dateFormat: 'mm/dd/yy', constrainInput: false });

});

/* ]]> */