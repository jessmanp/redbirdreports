// do load
$(document).ready(function() {

	// animate progress meter
	function animateMeter() {
			$(".meter > span").each(function() {
				$(this)
					.data("origWidth", $(this).width())
					.width(0)
					.animate({
						width: $(this).data("origWidth")
					}, 1200);
			});
	}

	//animateMeter(); *NOT USED*

	// MODAL WINDOW
	$("#popupmessage").find(".plain-btn").on("click", function() {
		closeModal();
	});

	// ABOUT
	$("header").find("img").on("click", function(event) {
		event.preventDefault();
		//window.location.href = "/about";
		window.location.href = "http://www.agencynerd.com";
	});

	// NAVIGATION
	$("#menu-link").on("click", function(event) {
		event.preventDefault();
		window.location = "/menu";
	});
	$("#logout-link").on("click", function(event) {
		event.preventDefault();
		window.location = "/login/?logout";
	});
	
	// SLIDE OUT MENUS	
	$(".button-right").on("click", function() {
		var state = parseInt($("#user-panel").css("right"),10) > -250;
		$("#user-panel").animate({"right": (state ? -250: 0)});
		$("#menu-panel").animate({"left": "-250px"});
	});
	
	// REGISTER FORM	
	$("#register-btn").on("click", function() {
		$("#registerform").submit();
	});
	
	// PRE VALIDATION
	$("#registerform").submit(function() {
		var valid = true;
		$("div.error", this).remove();
		// pre validatation
		if (!$("#user_name").val()) {
			valid = false;
			$('<div class="error">Please enter a Username</div>').insertBefore($("#user_name").prev());
		}
		if (!$("#user_email").val()) {
			valid = false;
			$('<div class="error">Please enter an Email Address</div>').insertBefore($("#user_email").prev());
		} else if (echeck($("#user_email").val()) == false) {
			valid = false;
			$('<div class="error">Please enter a Valid Email</div>').insertBefore($("#user_email").prev());
		}
		if (!$("#user_password_new").val()) {
			valid = false;
			$('<div class="error">Please enter a Password</div>').insertBefore($("#user_password_new").prev());
		}
		if (!$("#user_password_repeat").val()) {
			valid = false;
			$('<div class="error">Please re-enter the Password</div>').insertBefore($("#user_password_repeat").prev());
		} else if ($("#user_password_repeat").val() != $("#user_password_new").val()) {
			valid = false;
			$('<div class="error">Please re-enter the Same Password</div>').insertBefore($("#user_password_repeat").prev());
		}
		if (!$("#captcha").val()) {
			valid = false;
			$('<div class="error">Please enter the Captcha Code</div>').insertBefore($("#captcha").prev());
		}
		return valid;
	});

	// #1 SLIDE BAR CLICK
	$(".signup-header").on("click", function() {
		if($(this).find("#setup-arrow").hasClass("arrow-down")) {
			$(this).find("#setup-arrow").removeClass("arrow-down").addClass("arrow-up");
		} else {
			$(this).find("#setup-arrow").removeClass("arrow-up").addClass("arrow-down");
		}
		$(".signup-middle").find("#setup-arrow").removeClass("arrow-up").addClass("arrow-down");
		$(".signup-footer").find("#setup-arrow").removeClass("arrow-up").addClass("arrow-down");
		$("#signup-agency").slideToggle();
		$("#signup-employees").slideUp();
		$("#signup-compensation").slideUp();
		$("#signup-commission").slideUp();
		$("#signup-footer").removeClass("signup-middle").addClass("signup-footer");
	});

	// 1ST NEXT BUTTON
	$("#next-step1").on("click", function() {
		if($(".signup-middle").find("#setup-arrow").hasClass("arrow-down")) {
			$(".signup-middle").find("#setup-arrow").removeClass("arrow-down").addClass("arrow-up");
		} else {
			$(".signup-middle").find("#setup-arrow").removeClass("arrow-up").addClass("arrow-down");
		}
		$(".signup-header").find("#setup-arrow").removeClass("arrow-up").addClass("arrow-down");
		$("#signup-footer").find("#setup-arrow").removeClass("arrow-up").addClass("arrow-down");
		$("#signup-employees").slideToggle();
		$("#signup-agency").slideUp();
		$("#signup-compensation").slideUp();
		$("#signup-commission").slideUp();
		$("#signup-footer").removeClass("signup-middle").addClass("signup-footer");
	});

	// #2 SLIDE BAR CLICK
	$(".signup-middle").on("click", function() {
		if($(this).find("#setup-arrow").hasClass("arrow-down")) {
			$(this).find("#setup-arrow").removeClass("arrow-down").addClass("arrow-up");
		} else {
			$(this).find("#setup-arrow").removeClass("arrow-up").addClass("arrow-down");
		}
		$(".signup-header").find("#setup-arrow").removeClass("arrow-up").addClass("arrow-down");
		$("#signup-footer").find("#setup-arrow").removeClass("arrow-up").addClass("arrow-down");
		$("#signup-employees").slideToggle();
		$("#signup-agency").slideUp();
		$("#signup-compensation").slideUp();
		$("#signup-commission").slideUp();
		$("#signup-footer").removeClass("signup-middle").addClass("signup-footer");
	});

	// 2ND NEXT BUTTON
	$("#next-step2").on("click", function() {
		if($("#signup-footer").find("#setup-arrow").hasClass("arrow-down")) {
			$("#signup-footer").find("#setup-arrow").removeClass("arrow-down").addClass("arrow-up");
		} else {
			$("#signup-footer").find("#setup-arrow").removeClass("arrow-up").addClass("arrow-down");
		}
		$(".signup-header").find("#setup-arrow").removeClass("arrow-up").addClass("arrow-down");
		$(".signup-middle").find("#setup-arrow").removeClass("arrow-up").addClass("arrow-down");
		$("#signup-compensation").slideToggle();
		$("#signup-employees").slideUp();
		$("#signup-agency").slideUp();
		$("#signup-commission").slideUp();
		if($("#signup-footer").hasClass("signup-footer")) {
			$("#signup-footer").removeClass("signup-footer").addClass("signup-middle");
		} else {
			$("#signup-footer").removeClass("signup-middle").addClass("signup-footer");
		}
	});

	// #3 SLIDE BAR CLICK
	$("#signup-footer").on("click", function(e) {
		if($(this).find("#setup-arrow").hasClass("arrow-down")) {
			$(this).find("#setup-arrow").removeClass("arrow-down").addClass("arrow-up");
		} else {
			$(this).find("#setup-arrow").removeClass("arrow-up").addClass("arrow-down");
		}
		$(".signup-header").find("#setup-arrow").removeClass("arrow-up").addClass("arrow-down");
		$(".signup-middle").find("#setup-arrow").removeClass("arrow-up").addClass("arrow-down");
		$("#signup-compensation").slideToggle();
		$("#signup-employees").slideUp();
		$("#signup-agency").slideUp();
		$("#signup-commission").slideUp();
		if($(this).hasClass("signup-footer")) {
			$(this).removeClass("signup-footer").addClass("signup-middle");
		} else {
			$(this).removeClass("signup-middle").addClass("signup-footer");
		}
	});

	// 3RD NEXT BUTTON
	$("#next-step3").on("click", function() {
		if($("#signup-footer").find("#setup-arrow").hasClass("arrow-down")) {
			$("#signup-footer").find("#setup-arrow").removeClass("arrow-down").addClass("arrow-up");
		} else {
			$("#signup-footer").find("#setup-arrow").removeClass("arrow-up").addClass("arrow-down");
		}
		$(".signup-header").find("#setup-arrow").removeClass("arrow-up").addClass("arrow-down");
		$(".signup-middle").find("#setup-arrow").removeClass("arrow-up").addClass("arrow-down");
		$("#signup-compensation").slideToggle();
		$("#signup-employees").slideUp();
		$("#signup-agency").slideUp();
		$("#signup-commission").slideUp();
		if($("#signup-footer").hasClass("signup-footer")) {
			$("#signup-footer").removeClass("signup-footer").addClass("signup-middle");
		} else {
			$("#signup-footer").removeClass("signup-middle").addClass("signup-footer");
		}
	});


////////////////////////////////////////////////////////////////////////////////////////////////////////////

	var ddstate = false;
	$(".main-select-after").on("click", function() {
		//$(this).closest("select").prop("size", state ? $("option").length : 1);
    	//$(this).closest("select").trigger("click");
		//elem = $(this).attr("data");
		// NEED TO FIGURE HOW TO TRIGGER DROPDOWN
		ddstate = !ddstate;
    	$(this).closest("select").prop("size", ddstate ? $("option").length : 1);

	});

	// FINAL SUBMIT ACTION
	$("#signup_agency_info").submit(function(event) {
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
							$("#agency_name").focus();
						} else {
							// setup was successful, send to menu screen
							window.location = "/menu";
						}	
					},
					error: function (request, status, error) {
        					console.log(error);
					}
		});
		event.preventDefault();
	});

	// STEP #2 SUBMIT ACTION
	$("#setup_invite_employee").submit(function(event) {
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
							$("#employee_email").focus();
						} else {
							// invite was successful, clear fields...
							$("#employee_first_name").val("");
							$("#employee_last_name").val("");
							$("#employee_email").val("");
							$("#employee_email_verify").val("");
							$("#employee_type").val("").change();
							// update user drop down in step 3...
							updateEmployeeList();
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

	// LOAD EMPLOYEES AND UPDATE PROGRESS
	function updateEmployeeList() {
		$.ajax({
					type: "POST",
					url: "/home/updateEmployeeList",
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
							// loop over array old school way for IE clear if the status existed before
							for (var i=progressMessages.length-1; i>=0; i--) {
								// search array for previous agency name
    								if (progressMessages[i].search('Invited:') >= 0) {
        								progressMessages.splice(i, 1);
    								}
							}
							// update was successful populate drop down with json data
							$.each(data, function(key, value) {
								var user_level = 'General';
								if (value.user_level == 0) {
									user_level = 'Employee';
								} else if (value.user_level == 1) {
									user_level = 'Manager';
								} else if (value.user_level == 2) {
									user_level = 'Admin';
								}
								progressMessages.push('<div class="progress-rule"></div><span class="progress-info"><strong>'+user_level+' Invited:</strong><br />'+value.user_first_name+' '+value.user_last_name+'&nbsp;</span><br />');
								$("#employees_compensation option[value="+value.user_id+"]").remove();
    								$("#employees_compensation").append(
        								$("<option></option>").val(value.user_id).html(value.user_first_name+" "+value.user_last_name+" ("+user_level+")")
    								);
  							});
							updateProgress(3);
						}	
					},
					error: function (request, status, error) {
        					console.log(error);
					}
		});
	}

	// STEP #3 SUBMIT ACTION
	$("#setup_employee_compensation").submit(function(event) {
		$.ajax({
					type: "POST",
					url: "/home/updateEmployeeCompensation",
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
							// show success message...
							openModal('info',data.msg);
							checkEmployeeSetup();
						}	
					},
					error: function (request, status, error) {
        					console.log(error);
					}
		});
		event.preventDefault();
	});

	// LOAD SETUP AND UPDATE PROGRESS
	function checkEmployeeSetup() {
		$.ajax({
					type: "POST",
					url: "/home/checkEmployeeSetup",
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
							// loop over array old school way for IE
							for (var i=progressMessages.length-1; i>=0; i--) {
								// search array for previous agency name
    								if (progressMessages[i].search('Setup:') >= 0) {
        								progressMessages.splice(i, 1);
    								}
							}
							// update was successful populate drop down with json data
							$.each(data, function(key, value) {
								var user_level = 'General';
								if (value.user_level == 0) {
									user_level = 'Employee';
								} else if (value.user_level == 1) {
									user_level = 'Manager';
								} else if (value.user_level == 2) {
									user_level = 'Admin';
								}
								progressMessages.push('<div class="progress-rule"></div><span class="progress-info"><strong>'+user_level+' Setup:</strong><br />'+value.user_first_name+' '+value.user_last_name+'&nbsp;</span><br />');
								//$("#progress").append('<span class="progress-info"><strong>Employee Setup:</strong> '+value.user_first_name+' '+value.user_last_name+'&nbsp;</span><br />');
								//$(".meter span").css("width","100%");
  							});
							updateProgress(4);
						}	
					},
					error: function (request, status, error) {
        					console.log(error);
					}
		});
	}

	$("#save_setup").on("click", function() {
		//do agency info form submit
		$("#signup_agency_info").submit();
		event.preventDefault();
	});

	
	$("#compensation_type1").on("click", function() {
		if ($(this).val() == 1) {
			// change display text
			$("#rate-text").text("per hour");
		}
	});

	$("#compensation_type2").on("click", function() {
		if ($(this).val() == 2) {
			// change display text
			$("#rate-text").text("per month");
		}
	});

	$("#update_employee").on("click", function() {
		//do agency info form submit
		$("#setup_employee_compensation").submit();
		event.preventDefault();
	});

	// LOAD EMPLOYEES AND UPDATE STATUS
	$("#employees_compensation").on("change", function() {
		var eid = $(this).val();
		if (eid != '') {
			// update employee info into form
			$.ajax({
					type: "GET",
					url: "/home/getEmployeeCompensation/?eid="+eid,
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
							// show success message...
							openModal('info','Employee loaded. Please edit the employee&rsquo;s compensation information.');
							// update was successful populate form fields with json data
							$.each(data, function(key, value) {
								//check compensation_type1 or compensation_type2
								if (value.rate_type == 1) {
									$("#compensation_type1").prop("checked", true);
									// change display text
									$("#rate-text").text("per hour");
								} else if (value.rate_type == 2) {
									$("#compensation_type2").prop("checked", true);
									// change display text
									$("#rate-text").text("per month");
								}
								//compensation_draw on or off
								if (value.draw == 1) {
									$("#compensation_draw").prop("checked", true);
								} else {
									$("#compensation_draw").prop("checked", false);
								}
								// fill out fields with data
        							$("#compensation_rate").val(value.rate);
        							$("#compensation_other").val(value.other);
        							$("#commission_auto_new").val(value.commission_auto_new);
        							$("#commission_auto_renew").val(value.commission_auto_renew);
        							$("#commission_fire_new").val(value.commission_fire_new);
        							$("#commission_fire_renew").val(value.commission_fire_renew);
        							$("#commission_life").val(value.commission_life);
        							$("#commission_life_renew").val(value.commission_life_renew);
        							$("#commission_health").val(value.commission_health);
        							$("#commission_health_renew").val(value.commission_health_renew);
  							});
						}	
					},
					error: function (request, status, error) {
        					console.log(error);
					}
			});
		}
	});

	// LOAD AGENCY INFO AND UPDATE PROGRESS
	function loadAgencyInfo() {
		$.ajax({
					type: "POST",
					url: "/home/preloadAgencyInfo",
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
							// show success message...
							if (data[0].agency_name) {
								//openModal('info','Agency information found. Please verify your information.');
								// data does exists populate fields...
								$.each(data, function(key, value) {
									$("#agency_name").val(value.agency_name);
									$("#agency_address").val(value.agency_address);
									$("#agency_city").val(value.agency_city);
									$("#agency_state").val(value.agency_state);
									$("#agency_zip_code").val(value.agency_zip);
									$("#agency_phone").val(value.agency_phone);
								});
							}
						}	
					},
					error: function (request, status, error) {
        					console.log(error);
					}
		});
		event.preventDefault();
	}

	// UPDATE PROGRESS WHEN AGENCY NAME IS ENTERED
	$("#agency_name").on("blur", function() {
		if ($("#agency_name").val() != '') {
			// loop over array old school way for IE
			for (var i=progressMessages.length-1; i>=0; i--) {
				// search array for previous agency name
    				if (progressMessages[i].search('Agency Name:') >= 0) {
        				progressMessages.splice(i, 1);
        				break;
    				}
			}
			progressMessages.push('<div class="progress-rule"></div><span class="progress-info"><strong>Agency Name:</strong><br />'+$("#agency_name").val()+' &nbsp;</span><br />');
			updateProgress(2);
		}
	});

	// PROGRESS INFO WINDOW DRAG CONTROL
	$("#info-window").draggable({ 
                containment: '#glassbox', 
                scroll: false
         }).mousemove(function(){
                var coord = $(this).position();
                //$("p:last").text( "left: " + coord.left + ", top: " + coord.top );
         }).mouseup(function(){ 
                var coords=[];
                var coord = $(this).position();
                var item={ coordTop:  coord.left, coordLeft: coord.top  };
                coords.push(item);
             /*
			   var order = { coords: coords };
                $.post('updatecoords.php', 'data='+$.toJSON(order), function(response){
                        if(response=="success")
                            $("#respond").html('<div class="success">X and Y Coordinates Saved!</div>').hide().fadeIn(1000);
                            setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
                        }); 
                });
			*/
                         
	});

	// PROGRESS INFO WINDOW CLICK ACTION
	$("#info-window").on("click", function() {
		if($(this).find("#info-arrow").hasClass("arrow-down-dark")) {
			$(this).find("#info-arrow").removeClass("arrow-down-dark").addClass("arrow-up-dark");
			$(this).find("#progress").slideToggle();
		} else {
			$(this).find("#info-arrow").removeClass("arrow-up-dark").addClass("arrow-down-dark");
			$(this).find("#progress").slideToggle();
		}
	});

	// PREPARE ARRAY FOR PROGRESS MESSAGES
	var progressMessages = [];

	function updateProgress(bar) {
		$("#progress").empty();
		for (var i in progressMessages) {
			// update progress window with array items
			$("#progress").append(progressMessages[i]);
		}
		// update progress bar width
		var w = (bar*25);
		$(".meter span").css("width",w+"%");
	}

	// LOAD INITIAL PROGRESS
	function preUpdateProgress() {
		$.ajax({
					type: "POST",
					url: "/home/preUpdateProgress",
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
							// populate progress window with status
							progressMessages.push(data);
							updateProgress(1);
							// update employee dropdown and update progress window
							updateEmployeeList();
							// load any saved agency info
							loadAgencyInfo();
						}	
					},
					error: function (request, status, error) {
        					console.log(error);
					}
		});

	}

	// run initial setup on load only if on setup page
	if(document.URL.search("/setup") != -1) {
		preUpdateProgress();
	}

});



