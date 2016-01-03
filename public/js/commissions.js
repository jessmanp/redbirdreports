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

	// LOAD EMPLOYEES AND UPDATE DROPDOWN
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
						// populate employee drop down
						$("#commission_employees").empty();
						$("#commission_employees").append(
							$("<option></option>").val("").html("- Select -")
						);
						// loop over employees and add each to dropdown
						$.each(data, function(key, value) {
							$("#commission_employees").append(
								$("<option></option>").val(value.user_id).html(value.user_first_name+" "+value.user_last_name)
							);
						});
					}	
				},
				error: function (request, status, error) {
						console.log(error);
				}
		});
	}
	
	// LOAD EMPLOYEES
	updateEmployeeList();

});

/* ]]> */