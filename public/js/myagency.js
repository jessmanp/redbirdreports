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
	var scrolled_val = $(document).scrollTop().valueOf();
	var newh = (scrolled_val-170);
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
							// setup was successful, send to menu screen
							//window.location = "/app/myagency";
						}	
					},
					error: function (request, status, error) {
        					console.log(error);
					}
		});
		event.preventDefault();
	});

});

/* ]]> */