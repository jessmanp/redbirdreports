// login
// OPEN/CLOSE MESSAGE WINDOW
function openModal(type,message) {	

	var winh = $(window).height();
	var doch = $(document).height();
	if (winh > doch) {
		$("#modal").height(winh);
	} else {
		$("#modal").height(doch);
	}
	$("#modal").delay(300).fadeIn();
			
	var winw = $(window).width();
	var neww = (winw/2)-298;
	var scrolled_val = $(document).scrollTop().valueOf();
	var newh = (scrolled_val+25);
	$("#popupmessage").css({ "margin-left": neww+"px", "margin-top": "30px" });
	$("#popupmessage").delay(300).fadeIn();
	$("#message").delay(300).fadeIn();
	$("#message").html(message);
		
}
function closeModal() {
	$("#modal").fadeOut("fast");
	$("#popupmessage").fadeOut("fast");
	$("#message").fadeOut("fast");
}
	
// do load
$(document).ready(function() {

	// MODAL WINDOW
	$("#popupmessage").find(".plain-btn").on("click", function() {
		closeModal();
	});

});