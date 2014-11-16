// login
// do load
$(document).ready(function() {

	// MODAL WINDOW
	$("#popupmessage").find(".plain-btn").on("click", function() {
		closeModal();
	});

	// ABOUT -> goes to homepage
	$("header").find("img").on("click", function(event) {
		event.preventDefault();
		window.location.href = "http://www.agencynerd.com";
	});

});